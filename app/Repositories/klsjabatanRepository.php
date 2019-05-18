<?php

namespace App\Repositories;

use App\Models\klsjabatan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class klsjabatanRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:35 pm UTC
 *
 * @method klsjabatan findWithoutFail($id, $columns = ['*'])
 * @method klsjabatan find($id, $columns = ['*'])
 * @method klsjabatan first($columns = ['*'])
*/
class klsjabatanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_kj',
        'jml_butuh'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return klsjabatan::class;
    }
}
