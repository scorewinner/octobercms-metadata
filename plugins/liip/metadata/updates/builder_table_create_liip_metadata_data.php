<?php namespace Liip\Metadata\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLiipMetadataData extends Migration
{
    public function up()
    {
        Schema::create('liip_metadata_metadatas', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();
            $table->string('file')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('liip_metadata_metadatas');
    }
}