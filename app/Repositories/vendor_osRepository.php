<?php

namespace App\Repositories;

use App\Models\vendor_os;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class vendor_osRepository
 * @package App\Repositories
 * @version June 28, 2019, 2:51 am UTC
 *
 * @method vendor_os findWithoutFail($id, $columns = ['*'])
 * @method vendor_os find($id, $columns = ['*'])
 * @method vendor_os first($columns = ['*'])
*/
class vendor_osRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_vendor',
        'email',
        'password',
        'telepon',
        'alamat',
        'is_active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return vendor_os::class;
    }
}
