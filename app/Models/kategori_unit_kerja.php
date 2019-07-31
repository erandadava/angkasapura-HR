<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class kategori_unit_kerja
 * @package App\Models
 * @version July 31, 2019, 7:21 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nama_kategori_uk
 */
class kategori_unit_kerja extends Model
{
    use SoftDeletes;

    public $table = 'tblkategoriunitkerja';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_kategori_uk'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_kategori_uk' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_kategori_uk' => 'required'
    ];

    public function unit_kerja()
    {
        return $this->hasMany('App\Models\unitkerja', 'id_kategori_unit_kerja_fk', 'id');
    }
    
}
