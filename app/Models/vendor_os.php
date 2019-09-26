<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class vendor_os
 * @package App\Models
 * @version June 28, 2019, 2:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nama_vendor
 * @property string email
 * @property string password
 * @property string telepon
 * @property string alamat
 * @property boolean is_active
 */
class vendor_os extends Model
{
    use SoftDeletes;

    public $table = 'tblvendoros';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_vendor',
        'email',
        'password',
        'telepon',
        'alamat',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_vendor' => 'string',
        'email' => 'string',
        'password' => 'string',
        'telepon' => 'string',
        'alamat' => 'string',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_vendor' => 'required',
        'email' => 'required|unique:tblvendoros',
        'password' => 'required|min:6',
        'telepon' => 'required',
        'alamat' => 'required',
        'is_active' => 'required',
        'password_confirmation' => 'required_with:password|same:password|min:6'
    ];

    public static $rulesUpdate = [
        'nama_vendor' => 'required',
        'email' => 'required',
        'telepon' => 'required',
        'alamat' => 'required',
        'is_active' => 'required',
    ];


    public function karyawan_os()
    {
        return $this->hasMany('App\Models\karyawan_os', 'id_vendor', 'id');
    }
    
}
