<?php

namespace App\Repositories;

use App\Models\jabatan_os;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class jabatan_osRepository
 * @package App\Repositories
 * @version July 5, 2019, 4:11 pm UTC
 *
 * @method jabatan_os findWithoutFail($id, $columns = ['*'])
 * @method jabatan_os find($id, $columns = ['*'])
 * @method jabatan_os first($columns = ['*'])
*/
class jabatan_osRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_jabatan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return jabatan_os::class;
    }
}
