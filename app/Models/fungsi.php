<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class fungsi
 * @package App\Models
 * @version May 18, 2019, 4:31 pm UTC
 *
 * @property string nama_fungsi
 * @property integer jml_butuh
 */
class fungsi extends Model
{
    use SoftDeletes;

    public $table = 'tblfungsi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_fungsi',
        'jml_butuh'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_fungsi' => 'string',
        'jml_butuh' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_fungsi' => 'required',
        'jml_butuh' => 'required'
    ];

    public function karyawan(){
        return $this->hasMany('App\Models\karyawan', 'id_fungsi', 'id');
    }
}
