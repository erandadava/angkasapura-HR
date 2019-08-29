<?php

namespace App\Repositories;

use App\Models\notifikasi;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class notifikasiRepository
 * @package App\Repositories
 * @version August 22, 2019, 11:43 am UTC
 *
 * @method notifikasi findWithoutFail($id, $columns = ['*'])
 * @method notifikasi find($id, $columns = ['*'])
 * @method notifikasi first($columns = ['*'])
*/
class notifikasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'konten_id',
        'link_id',
        'pesan',
        'status',
        'status_baca'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return notifikasi::class;
    }
}
