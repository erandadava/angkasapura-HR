<?php

namespace App\Repositories;

use App\Models\fungsi;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class fungsiRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:31 pm UTC
 *
 * @method fungsi findWithoutFail($id, $columns = ['*'])
 * @method fungsi find($id, $columns = ['*'])
 * @method fungsi first($columns = ['*'])
*/
class fungsiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_fungsi',
        'jml_butuh'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return fungsi::class;
    }
}
