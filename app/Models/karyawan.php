<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


    public $fillable = [
        'nama',
        'gender',
        'tgl_lahir',
        'id_kj',
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
        'entry_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'nama' => 'string',
        'gender' => 'string',
        'tgl_lahir' => 'datetime',
        'id_kj' => 'integer',
        'id_jabatan' => 'integer',
        'id_status1' => 'integer',
        'id_status2' => 'integer',
        'id_unitkerja' => 'integer',
        'rencana_mpp' => 'datetime',
        'rencana_pensiun' => 'datetime',
        'pend_diakui' => 'string',
        'id_org' => 'integer',
        'id_posisi' => 'integer',
        'id_tipe_kar' => 'integer',
        'entry_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ID' => 'required',
        'nama' => 'required',
        'gender' => 'required',
        'tgl_lahir' => 'required',
        'id_kj' => 'required',
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

    
}
