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
                'metadataTitle' => [$this, 'showMetadataTitle'],
                'metadataAlt' => [$this, 'showMetadataAlt'],
                'metadataCaption' => [$this, 'showMetadataCaption']
            ],
        ];
    }

    private function getMetadataOfFile($path)
    {
        return Metadata::where(['file' => '/' . $path])->first();
    }
    public function showMetadataTitle($path)
    {
        return $this->getMetadataOfFile($path)->title;
    }

    public function showMetadataAlt($path)
    {
        return $this->getMetadataOfFile($path)->alt;
    }

    public function showMetadataCaption($path)
    {
        return $this->getMetadataOfFile($path)->caption;
    }

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
