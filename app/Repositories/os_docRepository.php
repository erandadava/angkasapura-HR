<?php

namespace App\Repositories;

use App\Models\os_doc;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class os_docRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:20 am UTC
 *
 * @method os_doc findWithoutFail($id, $columns = ['*'])
 * @method os_doc find($id, $columns = ['*'])
 * @method os_doc first($columns = ['*'])
*/
class os_docRepository extends BaseRepository
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
        return os_doc::class;
    }
}
