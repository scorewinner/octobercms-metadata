<?php namespace Liip\Metadata\Models;

use Model;

/**
 * Model
 */
class Metadata extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


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