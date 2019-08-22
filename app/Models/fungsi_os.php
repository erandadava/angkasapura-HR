<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class fungsi_os
 * @package App\Models
 * @version June 28, 2019, 2:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nama_fungsi
 */
class fungsi_os extends Model
{
    use SoftDeletes;

    public $table = 'tblfungsios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_fungsi'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_fungsi' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_fungsi' => 'required'
    ];

    public function karyawan_os()
    {
        return $this->hasMany('App\Models\karyawan_os', 'id_fungsi', 'id');
    }
}
