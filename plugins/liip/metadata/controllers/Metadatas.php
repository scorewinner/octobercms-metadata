<?php namespace Liip\Metadata\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Metadatas extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
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
}
