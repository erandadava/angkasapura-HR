<?php

namespace App\Repositories;

use App\Models\osdoc;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class osdocRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:35 pm UTC
 *
 * @method osdoc findWithoutFail($id, $columns = ['*'])
 * @method osdoc find($id, $columns = ['*'])
 * @method osdoc first($columns = ['*'])
*/
class osdocRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return osdoc::class;
    }
}
