<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class klsjabatan
 * @package App\Models
 * @version May 18, 2019, 4:35 pm UTC
 *
 * @property string nama_kj
 * @property integer jml_butuh
 */
class klsjabatan extends Model
{
    use SoftDeletes;

    public $table = 'tblklsjabatan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_kj',
        'jml_butuh'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_kj' => 'string',
        'jml_butuh' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_kj' => 'required',
        'jml_butuh' => 'required'
    ];

    public function karyawan(){
        return $this->hasMany('App\Models\karyawan', 'id_klsjabatan', 'id');
    }

    public function log_karyawan()
    {
        return $this->hasMany('App\Models\log_karyawan', 'id_klsjabatan', 'id')->where('is_active',1)->latest();
    }

    
    
}
