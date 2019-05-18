<?php

namespace App\Repositories;

use App\Models\tipekar;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tipekarRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:21 am UTC
 *
 * @method tipekar findWithoutFail($id, $columns = ['*'])
 * @method tipekar find($id, $columns = ['*'])
 * @method tipekar first($columns = ['*'])
*/
class tipekarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_tipekar'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tipekar::class;
    }
}
