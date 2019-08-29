<?php namespace Tests\Repositories;

use App\Models\log_karyawan;
use App\Repositories\log_karyawanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_karyawanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_karyawanRepository
     */
    protected $logKaryawanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logKaryawanRepo = \App::make(log_karyawanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->make()->toArray();

        $createdlog_karyawan = $this->logKaryawanRepo->create($logKaryawan);

        $createdlog_karyawan = $createdlog_karyawan->toArray();
        $this->assertArrayHasKey('id', $createdlog_karyawan);
        $this->assertNotNull($createdlog_karyawan['id'], 'Created log_karyawan must have id specified');
        $this->assertNotNull(log_karyawan::find($createdlog_karyawan['id']), 'log_karyawan with given id must be in DB');
        $this->assertModelData($logKaryawan, $createdlog_karyawan);
    }

    /**
     * @test read
     */
    public function test_read_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();

        $dblog_karyawan = $this->logKaryawanRepo->find($logKaryawan->id);

        $dblog_karyawan = $dblog_karyawan->toArray();
        $this->assertModelData($logKaryawan->toArray(), $dblog_karyawan);
    }

    /**
     * @test update
     */
    public function test_update_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();
        $fakelog_karyawan = factory(log_karyawan::class)->make()->toArray();

        $updatedlog_karyawan = $this->logKaryawanRepo->update($fakelog_karyawan, $logKaryawan->id);

        $this->assertModelData($fakelog_karyawan, $updatedlog_karyawan->toArray());
        $dblog_karyawan = $this->logKaryawanRepo->find($logKaryawan->id);
        $this->assertModelData($fakelog_karyawan, $dblog_karyawan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();

        $resp = $this->logKaryawanRepo->delete($logKaryawan->id);

        $this->assertTrue($resp);
        $this->assertNull(log_karyawan::find($logKaryawan->id), 'log_karyawan should not exist in DB');
    }
}
