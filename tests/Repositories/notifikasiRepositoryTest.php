<?php namespace Tests\Repositories;

use App\Models\notifikasi;
use App\Repositories\notifikasiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class notifikasiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var notifikasiRepository
     */
    protected $notifikasiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->notifikasiRepo = \App::make(notifikasiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_notifikasi()
    {
        $notifikasi = factory(notifikasi::class)->make()->toArray();

        $creatednotifikasi = $this->notifikasiRepo->create($notifikasi);

        $creatednotifikasi = $creatednotifikasi->toArray();
        $this->assertArrayHasKey('id', $creatednotifikasi);
        $this->assertNotNull($creatednotifikasi['id'], 'Created notifikasi must have id specified');
        $this->assertNotNull(notifikasi::find($creatednotifikasi['id']), 'notifikasi with given id must be in DB');
        $this->assertModelData($notifikasi, $creatednotifikasi);
    }

    /**
     * @test read
     */
    public function test_read_notifikasi()
    {
        $notifikasi = factory(notifikasi::class)->create();

        $dbnotifikasi = $this->notifikasiRepo->find($notifikasi->id);

        $dbnotifikasi = $dbnotifikasi->toArray();
        $this->assertModelData($notifikasi->toArray(), $dbnotifikasi);
    }

    /**
     * @test update
     */
    public function test_update_notifikasi()
    {
        $notifikasi = factory(notifikasi::class)->create();
        $fakenotifikasi = factory(notifikasi::class)->make()->toArray();

        $updatednotifikasi = $this->notifikasiRepo->update($fakenotifikasi, $notifikasi->id);

        $this->assertModelData($fakenotifikasi, $updatednotifikasi->toArray());
        $dbnotifikasi = $this->notifikasiRepo->find($notifikasi->id);
        $this->assertModelData($fakenotifikasi, $dbnotifikasi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_notifikasi()
    {
        $notifikasi = factory(notifikasi::class)->create();

        $resp = $this->notifikasiRepo->delete($notifikasi->id);

        $this->assertTrue($resp);
        $this->assertNull(notifikasi::find($notifikasi->id), 'notifikasi should not exist in DB');
    }
}
