<?php namespace Tests\Repositories;

use App\Models\klsjabatan;
use App\Repositories\klsjabatanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeklsjabatanTrait;
use Tests\ApiTestTrait;

class klsjabatanRepositoryTest extends TestCase
{
    use MakeklsjabatanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var klsjabatanRepository
     */
    protected $klsjabatanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->klsjabatanRepo = \App::make(klsjabatanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_klsjabatan()
    {
        $klsjabatan = $this->fakeklsjabatanData();
        $createdklsjabatan = $this->klsjabatanRepo->create($klsjabatan);
        $createdklsjabatan = $createdklsjabatan->toArray();
        $this->assertArrayHasKey('id', $createdklsjabatan);
        $this->assertNotNull($createdklsjabatan['id'], 'Created klsjabatan must have id specified');
        $this->assertNotNull(klsjabatan::find($createdklsjabatan['id']), 'klsjabatan with given id must be in DB');
        $this->assertModelData($klsjabatan, $createdklsjabatan);
    }

    /**
     * @test read
     */
    public function test_read_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $dbklsjabatan = $this->klsjabatanRepo->find($klsjabatan->id);
        $dbklsjabatan = $dbklsjabatan->toArray();
        $this->assertModelData($klsjabatan->toArray(), $dbklsjabatan);
    }

    /**
     * @test update
     */
    public function test_update_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $fakeklsjabatan = $this->fakeklsjabatanData();
        $updatedklsjabatan = $this->klsjabatanRepo->update($fakeklsjabatan, $klsjabatan->id);
        $this->assertModelData($fakeklsjabatan, $updatedklsjabatan->toArray());
        $dbklsjabatan = $this->klsjabatanRepo->find($klsjabatan->id);
        $this->assertModelData($fakeklsjabatan, $dbklsjabatan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $resp = $this->klsjabatanRepo->delete($klsjabatan->id);
        $this->assertTrue($resp);
        $this->assertNull(klsjabatan::find($klsjabatan->id), 'klsjabatan should not exist in DB');
    }
}
