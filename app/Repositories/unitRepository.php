<?php

namespace App\Repositories;

use App\Models\unit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class unitRepository
 * @package App\Repositories
 * @version May 18, 2019, 5:02 pm UTC
 *
 * @method unit findWithoutFail($id, $columns = ['*'])
 * @method unit find($id, $columns = ['*'])
 * @method unit first($columns = ['*'])
*/
class unitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_unit'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return unit::class;
    }
}
