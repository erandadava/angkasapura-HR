<?php

namespace App\Repositories;

use App\Models\Osperformance;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OsperformanceRepository
 * @package App\Repositories
 * @version June 15, 2019, 11:44 am UTC
 *
 * @method Osperformance findWithoutFail($id, $columns = ['*'])
 * @method Osperformance find($id, $columns = ['*'])
 * @method Osperformance first($columns = ['*'])
*/
class OsperformanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tanggal_pelaporan',
        'keluhan',
        'file_pelaporan',
        'tanggal_penyelesaian',
        'hasil',
        'file_penyelesaian'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Osperformance::class;
    }
}
