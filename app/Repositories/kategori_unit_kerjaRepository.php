<?php

namespace App\Repositories;

use App\Models\kategori_unit_kerja;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class kategori_unit_kerjaRepository
 * @package App\Repositories
 * @version July 31, 2019, 7:21 am UTC
 *
 * @method kategori_unit_kerja findWithoutFail($id, $columns = ['*'])
 * @method kategori_unit_kerja find($id, $columns = ['*'])
 * @method kategori_unit_kerja first($columns = ['*'])
*/
class kategori_unit_kerjaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_kategori_uk'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return kategori_unit_kerja::class;
    }
}
