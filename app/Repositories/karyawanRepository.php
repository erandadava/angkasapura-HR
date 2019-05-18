<?php

namespace App\Repositories;

use App\Models\karyawan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class karyawanRepository
 * @package App\Repositories
 * @version May 18, 2019, 4:17 am UTC
 *
 * @method karyawan findWithoutFail($id, $columns = ['*'])
 * @method karyawan find($id, $columns = ['*'])
 * @method karyawan first($columns = ['*'])
*/
class karyawanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'gender',
        'tgl_lahir',
        'id_kj',
        'id_jabatan',
        'id_status1',
        'id_status2',
        'id_unitkerja',
        'rencana_mpp',
        'rencana_pensiun',
        'pend_diakui',
        'id_org',
        'id_posisi',
        'id_tipe_kar',
        'entry_date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return karyawan::class;
    }
}
