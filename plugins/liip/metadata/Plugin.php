<?php namespace Liip\Metadata;

use Event;
use Liip\Metadata\Models\Metadata;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    // Custom twig filters
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'metadata' => [$this, 'showMetadata']
            ],
        ];
    }

    // Function for twig Filter
    public function showMetadata($path){
            return Metadata::where(['file' => '/' . $path])->first();
    }

    // Event listeners to listen to events from Media Manager
    public function boot()
    {
        Event::listen('media.file.upload', function($widget, $filePath) {
            if (dirname($filePath) == "/") {
                $filePath = '/' . basename($filePath);
            }
            Metadata::firstOrCreate(['file' => $filePath]);
            Metadata::where(['file' => $filePath])->update(['deleted' => false]);
        });
        Event::listen('media.file.rename', function($widget, $originalPath, $newPath) {
            if (dirname($newPath) == "/") {
                $newPath = '/' . basename($newPath);
            }
            Metadata::where('file', $originalPath)->update(['file' => $newPath]);
        });
        Event::listen('media.file.move', function($widget, $path, $dest) {
            if (basename($dest) != "") {
                $newPath = $dest . '/' . basename($path);
            } else {
                $newPath = '/' . basename($path);
            }
            Metadata::where('file', $path)->update(['file' => $newPath]);
        });
        Event::listen('media.file.delete', function($widget, $path) {
            Metadata::where('file', $path)->update(['deleted' => true]);
        });

    }
}
