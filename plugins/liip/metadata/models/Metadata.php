<?php namespace Liip\Metadata\Models;

use Model;

/**
 * Model
 */
class Metadata extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    /**
     * added Translate Plugin to Model
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['title', 'alt', 'caption'];

    protected $dates = ['deleted_at'];
    protected $fillable = ['file'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'liip_metadata_metadatas';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
