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
    protected $appends = ['Lowongan','Kekuatansdm'];


    public $fillable = [
        'nama_uk',
        'jml_formasi',
        'jml_existing',
        'id_kategori_unit_kerja_fk'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
        'nama_uk' => 'required',
        'jml_formasi' => 'required',
        'jml_existing' => 'required'
    ];

    public function getLowonganAttribute()
    {
        return (int) $this->jml_formasi - (int) $this->jml_existing;
    }

    public function getKekuatansdmAttribute()
    {
        if((int) $this->jml_formasi>0){
            return round(((int) $this->jml_existing / (int) $this->jml_formasi)*100)."%";
        }
        return "0%";
        
    }
    
    public function karyawan()
    {
        return $this->hasMany('App\Models\karyawan', 'id_unitkerja', 'id');
    }

    public function log_karyawan()
    {
        return $this->hasMany('App\Models\log_karyawan', 'id_unitkerja', 'id')->where('is_active',1)->latest();
    }

    public function karyawan_os()
    {
        return $this->hasMany('App\Models\karyawan_os', 'id_unitkerja', 'id');
    }

    public function kategori_unit_kerja()
    {
        return $this->hasOne('App\Models\kategori_unit_kerja', 'id', 'id_kategori_unit_kerja_fk');
    }
}
