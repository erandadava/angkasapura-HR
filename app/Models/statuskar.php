<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class statuskar
 * @package App\Models
 * @version May 18, 2019, 4:37 pm UTC
 *
 * @property string nama_stat
 */
class statuskar extends Model
{
    use SoftDeletes;

    public $table = 'tblstatuskar';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_stat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'nama_stat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ID' => 'required',
        'nama_stat' => 'required'
    ];

    
}
