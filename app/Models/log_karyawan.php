<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class log_karyawan
 * @package App\Models
 * @version August 27, 2019, 12:59 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer id_karyawan_fk
 * @property integer id_jabatan
 * @property integer id_status1
 * @property integer id_status2
 * @property integer id_unitkerja
 * @property integer id_org
 * @property integer id_posisi
 * @property integer id_tipe_kar
 * @property integer id_fungsi
 * @property integer id_klsjabatan
 * @property integer id_unit
 * @property string|\Carbon\Carbon entry_date
 * @property string|\Carbon\Carbon update_date
 */
class log_karyawan extends Model
{
    use SoftDeletes;

    public $table = 'tbllogkaryawan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_karyawan_fk',
        'id_jabatan',
        'id_status1',
        'id_status2',
        'id_unitkerja',
        'id_org',
        'id_posisi',
        'id_tipe_kar',
        'id_fungsi',
        'id_klsjabatan',
        'id_unit',
        'entry_date',
        'update_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_karyawan_fk' => 'integer',
        'id_jabatan' => 'integer',
        'id_status1' => 'integer',
        'id_status2' => 'integer',
        'id_unitkerja' => 'integer',
        'id_org' => 'integer',
        'id_posisi' => 'integer',
        'id_tipe_kar' => 'integer',
        'id_fungsi' => 'integer',
        'id_klsjabatan' => 'integer',
        'id_unit' => 'integer',
        'entry_date' => 'datetime',
        'update_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_karyawan_fk' => 'required',
        'id_jabatan' => 'required',
        'id_unitkerja' => 'required',
        'entry_date' => 'required',
        'update_date' => 'required'
    ];

    public function fungsi(){
        return $this->hasOne('App\Models\fungsi', 'id', 'id_fungsi');
    }

    public function jabatan(){
        return $this->hasOne('App\Models\jabatan', 'id', 'id_jabatan');
    }

    public function unitkerja(){
        return $this->hasOne('App\Models\unitkerja', 'id', 'id_unitkerja');
    }

    public function tipekar(){
        return $this->hasOne('App\Models\tipekar', 'id', 'id_tipe_kar');
    }

    public function unit(){
        return $this->hasOne('App\Models\unit', 'id', 'id_unit');
    }

    public function klsjabatan(){
        return $this->hasOne('App\Models\klsjabatan', 'id', 'id_klsjabatan');
    }
}
