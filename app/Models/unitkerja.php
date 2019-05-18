<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class unitkerja
 * @package App\Models
 * @version May 18, 2019, 5:02 pm UTC
 *
 * @property string nama_uk
 * @property integer jml_formasi
 * @property integer jml_existing
 */
class unitkerja extends Model
{
    use SoftDeletes;

    public $table = 'tblunitkerja';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_uk',
        'jml_formasi',
        'jml_existing'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'nama_uk' => 'string',
        'jml_formasi' => 'integer',
        'jml_existing' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ID' => 'required',
        'nama_uk' => 'required',
        'jml_formasi' => 'required',
        'jml_existing' => 'required'
    ];

    
}
