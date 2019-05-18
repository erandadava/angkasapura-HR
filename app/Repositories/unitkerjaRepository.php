<?php

namespace App\Repositories;

use App\Models\unitkerja;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class unitkerjaRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:22 am UTC
 *
 * @method unitkerja findWithoutFail($id, $columns = ['*'])
 * @method unitkerja find($id, $columns = ['*'])
 * @method unitkerja first($columns = ['*'])
*/
class unitkerjaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_uk',
        'jml_formasi',
        'jml_existing'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return unitkerja::class;
    }
}
