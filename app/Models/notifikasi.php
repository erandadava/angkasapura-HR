<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class notifikasi
 * @package App\Models
 * @version August 22, 2019, 11:43 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer user_id
 * @property integer konten_id
 * @property string link_id
 * @property string pesan
 * @property string status
 * @property boolean status_baca
 */
class notifikasi extends Model
{
    use SoftDeletes;

    public $table = 'notifikasi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'konten_id',
        'link_id',
        'pesan',
        'status',
        'status_baca'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'konten_id' => 'integer',
        'link_id' => 'string',
        'pesan' => 'string',
        'status' => 'string',
        'status_baca' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status_baca' => 'required'
    ];

    
}
