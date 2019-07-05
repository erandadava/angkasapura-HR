<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class jabatan_os
 * @package App\Models
 * @version July 5, 2019, 4:11 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nama_jabatan
 */
class jabatan_os extends Model
{
    use SoftDeletes;

    public $table = 'jabatan_os';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_jabatan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_jabatan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_jabatan' => 'required'
    ];

    
}
