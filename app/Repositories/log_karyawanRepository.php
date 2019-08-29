<?php

namespace App\Repositories;

use App\Models\log_karyawan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class log_karyawanRepository
 * @package App\Repositories
 * @version August 27, 2019, 12:59 pm UTC
 *
 * @method log_karyawan findWithoutFail($id, $columns = ['*'])
 * @method log_karyawan find($id, $columns = ['*'])
 * @method log_karyawan first($columns = ['*'])
*/
class log_karyawanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_karyawan_fk',
        'id_jabatan',
        'id_status1',
        'id_status2',
        'id_unitkerja',
        'id_org',
        'id_posisi',
        'id_tipe_kar',
        'id_fungsi',
        'id_klsjabatan',
        'id_unit',
        'entry_date',
        'update_date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return log_karyawan::class;
    }
}
