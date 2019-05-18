<?php namespace Tests\Repositories;

use App\Models\unitkerja;
use App\Repositories\unitkerjaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeunitkerjaTrait;
use Tests\ApiTestTrait;

class unitkerjaRepositoryTest extends TestCase
{
    use MakeunitkerjaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var unitkerjaRepository
     */
    protected $unitkerjaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->unitkerjaRepo = \App::make(unitkerjaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unitkerja()
    {
        $unitkerja = $this->fakeunitkerjaData();
        $createdunitkerja = $this->unitkerjaRepo->create($unitkerja);
        $createdunitkerja = $createdunitkerja->toArray();
        $this->assertArrayHasKey('id', $createdunitkerja);
        $this->assertNotNull($createdunitkerja['id'], 'Created unitkerja must have id specified');
        $this->assertNotNull(unitkerja::find($createdunitkerja['id']), 'unitkerja with given id must be in DB');
        $this->assertModelData($unitkerja, $createdunitkerja);
    }

    /**
     * @test read
     */
    public function test_read_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $dbunitkerja = $this->unitkerjaRepo->find($unitkerja->id);
        $dbunitkerja = $dbunitkerja->toArray();
        $this->assertModelData($unitkerja->toArray(), $dbunitkerja);
    }

    /**
     * @test update
     */
    public function test_update_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $fakeunitkerja = $this->fakeunitkerjaData();
        $updatedunitkerja = $this->unitkerjaRepo->update($fakeunitkerja, $unitkerja->id);
        $this->assertModelData($fakeunitkerja, $updatedunitkerja->toArray());
        $dbunitkerja = $this->unitkerjaRepo->find($unitkerja->id);
        $this->assertModelData($fakeunitkerja, $dbunitkerja->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $resp = $this->unitkerjaRepo->delete($unitkerja->id);
        $this->assertTrue($resp);
        $this->assertNull(unitkerja::find($unitkerja->id), 'unitkerja should not exist in DB');
    }
}
