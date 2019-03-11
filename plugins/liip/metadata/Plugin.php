<?php namespace Liip\Metadata;

use Event;
use Illuminate\Support\Facades\DB;
use Liip\Metadata\Models\Metadata;
use Log;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Event::listen('media.file.upload', function($widget, $filePath) {
            DB::table('liip_metadata_metadatas')->insert(['file' => $filePath]);
        });
        Event::listen('media.file.rename', function($widget, $originalPath, $newPath) {
            if (dirname($newPath) == "/") {
                $newPath = '/' . basename($newPath);
            }
            DB::table('liip_metadata_metadatas')->where('file', $originalPath)->update(['file' => $newPath]);
        });
    }
}
