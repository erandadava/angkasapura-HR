<?php

namespace App\Repositories;

use App\Models\fungsi_os;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class fungsi_osRepository
 * @package App\Repositories
 * @version June 28, 2019, 2:51 am UTC
 *
 * @method fungsi_os findWithoutFail($id, $columns = ['*'])
 * @method fungsi_os find($id, $columns = ['*'])
 * @method fungsi_os first($columns = ['*'])
*/
class fungsi_osRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_fungsi'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return fungsi_os::class;
    }
}
