<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tipekar
 * @package App\Models
 * @version May 18, 2019, 5:02 pm UTC
 *
 * @property string nama_tipekar
 */
class tipekar extends Model
{
    use SoftDeletes;

    public $table = 'tbltipekar';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_tipekar'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama_tipekar' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_tipekar' => 'required'
    ];

    
}
