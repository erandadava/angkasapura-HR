<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class karyawan
 * @package App\Models
 * @version May 18, 2019, 4:35 pm UTC
 *
 * @property string nama
 * @property string gender
 * @property string|\Carbon\Carbon tgl_lahir
 * @property integer id_kj
 * @property integer id_jabatan
 * @property integer id_status1
 * @property integer id_status2
 * @property integer id_unitkerja
 * @property string|\Carbon\Carbon rencana_mpp
 * @property string|\Carbon\Carbon rencana_pensiun
 * @property string pend_diakui
 * @property integer id_org
 * @property integer id_posisi
 * @property integer id_tipe_kar
 * @property string|\Carbon\Carbon entry_date
 */
class karyawan extends Model
{
    use SoftDeletes;

    public $table = 'tblkaryawan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = ['Age'];

    public $fillable = [
        'nama',
        'gender',
        'tgl_lahir',
        'id_jabatan',
        'id_status1',
        'id_status2',
        'id_unitkerja',
        'rencana_mpp',
        'rencana_pensiun',
        'pend_diakui',
        'id_org',
        'id_posisi',
        'id_tipe_kar',
        'entry_date',
        'id_fungsi',
        'nik',
        'id_klsjabatan',
        'id_unit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'gender' => 'string',
        'tgl_lahir' => 'date',
        'id_jabatan' => 'integer',
        'id_status1' => 'integer',
        'id_status2' => 'integer',
        'id_unitkerja' => 'integer',
        'rencana_mpp' => 'date',
        'rencana_pensiun' => 'date',
        'pend_diakui' => 'string',
        'id_org' => 'integer',
        'id_posisi' => 'integer',
        'id_tipe_kar' => 'integer',
        'entry_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'gender' => 'required',
        'tgl_lahir' => 'required',
        'id_jabatan' => 'required',
        'id_status1' => 'required',
        'id_status2' => 'required',
        'id_unitkerja' => 'required',
        'rencana_mpp' => 'required',
        'rencana_pensiun' => 'required',
        'pend_diakui' => 'required',
        'id_org' => 'required',
        'id_posisi' => 'required',
        'id_tipe_kar' => 'required',
        'entry_date' => 'required'
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

    public function getAgeAttribute()
    {
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $m = date('-m-d', strtotime($this->attributes['tgl_lahir']));
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->year.$m.' 9:30:34');
        $sisa = $to->diffInDays($from);
        $umur =  \Carbon\Carbon::parse($this->attributes['tgl_lahir'])->age;
        if($umur == 55 && $sisa < 60 && $sisa > 0){
            return 1;
        }elseif($umur < 55 || $sisa > 60){
            return 0;
        }else{
            return 2;
        }
    }
}
