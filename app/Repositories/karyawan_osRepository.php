<?php

namespace App\Repositories;

use App\Models\karyawan_os;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class karyawan_osRepository
 * @package App\Repositories
 * @version June 14, 2019, 4:40 am UTC
 *
 * @method karyawan_os findWithoutFail($id, $columns = ['*'])
 * @method karyawan_os find($id, $columns = ['*'])
 * @method karyawan_os first($columns = ['*'])
*/
class karyawan_osRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'id_fungsi',
        'id_unitkerja',
        'tgl_lahir',
        // 'usia',
        'gender',
        'no_bpjs_tk',
        'doc_no_bpjs_tk',
        'no_bpjs_kesehatan',
        'doc_no_bpjs_kesehatan',
        'lisensi',
        'doc_lisensi',
        'no_lisensi',
        // 'doc_no_lisensi',
        // 'jangka_waktu',
        'doc_jangka_waktu',
        'no_kontrak_kerja',
        'doc_no_kontrak_kerja',
        'is_active',
        'tmt_awal_kontrak',
        'tmt_akhir_kontrak'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return karyawan_os::class;
    }
}
