<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class karyawan_os
 * @package App\Models
 * @version June 14, 2019, 4:40 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nama
 * @property integer id_fungsi
 * @property integer id_unitkerja
 * @property string tgl_lahir
 * @property integer usia
 * @property string gender
 * @property string no_bpjs_tk
 * @property string doc_no_bpjs_tk
 * @property string no_bpjs_kesehatan
 * @property string doc_no_bpjs_kesehatan
 * @property string lisensi
 * @property string doc_lisensi
 * @property string no_lisensi
 * @property string doc_no_lisensi
 * @property string jangka_waktu
 * @property string doc_jangka_waktu
 * @property string no_kontrak_kerja
 * @property string doc_no_kontrak_kerja
 */
class karyawan_os extends Model
{
    use SoftDeletes;

    public $table = 'tblkaryawanos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = ['Docbpjstk','Docnobpjskesehatan','Doclisensi','Docnolisensi','Docjangkawaktu','Docnokontrakkerja'];


    public $fillable = [
        'nama',
        'id_fungsi',
        'id_vendor',
        'id_unitkerja',
        'tgl_lahir',
        // 'usia',
        'gender',
        'no_bpjs_tk',
        'doc_no_bpjs_tk',
        'no_bpjs_kesehatan',
        'doc_no_bpjs_kesehatan',
        'lisensi',
        'doc_lisensi',
        'no_lisensi',
        'doc_no_lisensi',
        'jangka_waktu',
        'doc_jangka_waktu',
        'no_kontrak_kerja',
        'doc_no_kontrak_kerja',
        'penempatan',
        'is_active',
        'reason_desc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'id_fungsi' => 'integer',
        'id_unitkerja' => 'integer',
        'tgl_lahir' => 'date',
        // 'usia' => 'integer',
        'gender' => 'string',
        'no_bpjs_tk' => 'string',
        'doc_no_bpjs_tk' => 'string',
        'no_bpjs_kesehatan' => 'string',
        'doc_no_bpjs_kesehatan' => 'string',
        'lisensi' => 'string',
        'doc_lisensi' => 'string',
        'no_lisensi' => 'string',
        'doc_no_lisensi' => 'string',
        'jangka_waktu' => 'string',
        'doc_jangka_waktu' => 'string',
        'no_kontrak_kerja' => 'string',
        'doc_no_kontrak_kerja' => 'string',
        'penempatan' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'doc_no_bpjs_tk.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
        'doc_no_bpjs_kesehatan.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
        'doc_lisensi.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
        'doc_no_lisensi.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
        'doc_jangka_waktu.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
        'doc_no_kontrak_kerja.*' => 'mimes:PDF,pdf,jpg,jpeg,png',
    ];

    public function getDocbpjstkAttribute()
    {
        if(isset($this->attributes['doc_no_bpjs_tk'])){
            return unserialize($this->attributes['doc_no_bpjs_tk']);
        }
        return null;
    }
    public function getDocnobpjskesehatanAttribute()
    {
        if(isset($this->attributes['doc_no_bpjs_kesehatan'])){
            return unserialize($this->attributes['doc_no_bpjs_kesehatan']);
        }
        return null;
    }
    public function getDoclisensiAttribute()
    {
        if(isset($this->attributes['doc_lisensi'])){
            return unserialize($this->attributes['doc_lisensi']);
        }
        return null;
    }
    public function getDocnolisensiAttribute()
    {
        if(isset($this->attributes['doc_no_lisensi'])){
            return unserialize($this->attributes['doc_no_lisensi']);
        }
        return null;
    }
    public function getDocjangkawaktuAttribute()
    {
        if(isset($this->attributes['doc_jangka_waktu'])){
            return unserialize($this->attributes['doc_jangka_waktu']);
        }
        return null;
    }
    public function getDocnokontrakkerjaAttribute()
    {
        if(isset($this->attributes['doc_no_kontrak_kerja'])){
            return unserialize($this->attributes['doc_no_kontrak_kerja']);
        }
        return null;
    }
    public function fungsi(){
        return $this->hasOne('App\Models\fungsi_os', 'id', 'id_fungsi');
    }
    public function vendor(){
        return $this->hasOne('App\Models\vendor_os', 'id', 'id_vendor');
    }
    public function unitkerja(){
        return $this->hasOne('App\Models\unitkerja', 'id', 'id_unitkerja');
    }

    public function jabatan_os()
    {
        return $this->hasOne('App\Models\jabatan_os', 'id', 'nama_jabatan');        
    }
    
}
