<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class jabatan
 * @package App\Models
 * @version May 18, 2019, 4:34 pm UTC
 *
 * @property string nama_jabatan
 * @property string syarat_didik
 * @property string syarat_latih
 * @property string syarat_pengalaman
 */
class jabatan extends Model
{
    use SoftDeletes;

    public $table = 'tbljabatan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_jabatan',
        'syarat_didik',
        'syarat_latih',
        'syarat_pengalaman'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'nama_jabatan' => 'string',
        'syarat_didik' => 'string',
        'syarat_latih' => 'string',
        'syarat_pengalaman' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_jabatan' => 'required',
        'syarat_didik' => 'required',
        'syarat_latih' => 'required',
        'syarat_pengalaman' => 'required'
    ];

    
}
