<?php namespace Liip\Metadata;

use Event;
use Illuminate\Support\Facades\DB;
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
        Event::listen('media.file.move', function($widget, $path, $dest) {
            if (basename($dest) != "") {
                $newPath = $dest . '/' . basename($path);
            } else {
                $newPath = '/' . basename($path);
            }
            DB::table('liip_metadata_metadatas')->where('file', $path)->update(['file' => $newPath]);
        });
        Event::listen('media.file.delete', function($widget, $path) {
            DB::table('liip_metadata_metadatas')->where('file', $path)->update(['deleted' => true]);
        });

    }
}
