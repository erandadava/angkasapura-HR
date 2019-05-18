<?php

namespace App\Repositories;

use App\Models\jabatan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class jabatanRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:14 am UTC
 *
 * @method jabatan findWithoutFail($id, $columns = ['*'])
 * @method jabatan find($id, $columns = ['*'])
 * @method jabatan first($columns = ['*'])
*/
class jabatanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_jabatan',
        'syarat_didik',
        'syarat_latih',
        'syarat_pengalaman'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return jabatan::class;
    }
}
