<?php

namespace App\Repositories;

use App\Models\statuskar;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class statuskarRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:21 am UTC
 *
 * @method statuskar findWithoutFail($id, $columns = ['*'])
 * @method statuskar find($id, $columns = ['*'])
 * @method statuskar first($columns = ['*'])
*/
class statuskarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_stat'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return statuskar::class;
    }
}
