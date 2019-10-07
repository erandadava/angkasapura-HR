<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Osperformance
 * @package App\Models
 * @version June 15, 2019, 11:44 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string tanggal_pelaporan
 * @property string keluhan
 * @property string file_pelaporan
 * @property string tanggal_penyelesaian
 * @property string hasil
 * @property string file_penyelesaian
 */
class Osperformance extends Model
{
    use SoftDeletes;

    public $table = 'tblosperformance';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = ['Filepelaporan','Filepenyelesaian'];

    public $fillable = [
        'tanggal_pelaporan',
        'keluhan',
        'file_pelaporan',
        'tanggal_penyelesaian',
        'hasil',
        'id_vendor_fk',
        'file_penyelesaian' 
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_vendor_fk' => 'integer',
        'tanggal_pelaporan' => 'date',
        'keluhan' => 'string',
        'file_pelaporan' => 'string',
        'tanggal_penyelesaian' => 'date',
        'hasil' => 'string',
        'file_penyelesaian' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'file_penyelesaian.*' => 'mimes:PDF,pdf,jpg,jpeg,png,zip,rar',
        'file_pelaporan.*' => 'mimes:PDF,pdf,jpg,jpeg,png,zip,rar',
    ];

    public function getFilepelaporanAttribute()
    {
        if(isset($this->attributes['file_pelaporan'])){
            return unserialize($this->attributes['file_pelaporan']);
        }
        return null;
    }
    public function getFilepenyelesaianAttribute()
    {
        if(isset($this->attributes['file_penyelesaian'])){
            return unserialize($this->attributes['file_penyelesaian']);
        }
        return null;
    }

    public function vendor_os()
    {
        return $this->hasOne('App\Models\vendor_os', 'id', 'id_vendor_fk');
    }
}
