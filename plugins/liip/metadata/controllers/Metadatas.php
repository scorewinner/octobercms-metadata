<?php namespace Liip\Metadata\Controllers;

use Backend\Classes\Controller;
use Liip\Metadata\Models\Metadata;
use October\Rain\Support\Facades\Flash;
use System\Classes\MediaLibrary;
use BackendMenu;

class Metadatas extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'liip.metadata.data' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liip.Metadata', 'main-menu-item', 'side-menu-item');
    }
    /**
     * Ajax Function for list refresh button
    **/
    public function onRefresh(){
        $directrories = MediaLibrary::instance()->listAllDirectories();
        $metadatas = Metadata::all();
        $paths = [];
        foreach ($directrories as $directory) {
            $mediaList = MediaLibrary::instance()->
            listFolderContents($folder = $directory, $sortBy = 'title', $filter = null, $ignoreFolders = true);
            foreach ($mediaList as $media){
                Metadata::firstOrCreate(['file' => $media->path]);
                Metadata::where(['file' => $media->path])->update(['deleted' => false]);
                $paths[] = $media->path;
            }
        }
        $metadatas->filter(function ($item) use ($paths) {
            return !in_array($item->file, $paths);
        })->each(function ($item) {
            $item->deleted = true;
            $item->save();
        });

        Flash::success(e(trans('liip.metadata::lang.data.success_flash')));
        return $this->listRefresh();
    }
}
