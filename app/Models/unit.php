<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class unit
 * @package App\Models
 * @version May 18, 2019, 4:22 am UTC
 *
 * @property string nama_unit
 */
class unit extends Model
{
    use SoftDeletes;

    public $table = 'tblunit';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_unit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'nama_unit' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ID' => 'required',
        'nama_unit' => 'required'
    ];

    
}
