<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class osdoc
 * @package App\Models
 * @version May 18, 2019, 4:35 pm UTC
 *
 * @property integer ID
 * @property integer ID_kar
 * @property string doc_bpsj
 * @property string doc_bpjsk
 * @property string doc_lisensi
 * @property string doc_nomlisensi
 * @property string jangkawaktu
 * @property string kontrakkerja
 */
class osdoc extends Model
{
    use SoftDeletes;

    public $table = 'tblosdoc';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ID',
        'ID_kar',
        'doc_bpsj',
        'doc_bpjsk',
        'doc_lisensi',
        'doc_nomlisensi',
        'jangkawaktu',
        'kontrakkerja'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ID' => 'integer',
        'ID_kar' => 'integer',
        'doc_bpsj' => 'string',
        'doc_bpjsk' => 'string',
        'doc_lisensi' => 'string',
        'doc_nomlisensi' => 'string',
        'jangkawaktu' => 'string',
        'kontrakkerja' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ID' => 'required',
        'ID_kar' => 'required',
        'doc_bpsj' => 'required',
        'doc_bpjsk' => 'required',
        'doc_lisensi' => 'required',
        'doc_nomlisensi' => 'required',
        'jangkawaktu' => 'required',
        'kontrakkerja' => 'required'
    ];

    
}
