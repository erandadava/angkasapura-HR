<?php namespace Tests\Repositories;

use App\Models\Osperformance;
use App\Repositories\OsperformanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeOsperformanceTrait;
use Tests\ApiTestTrait;

class OsperformanceRepositoryTest extends TestCase
{
    use MakeOsperformanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OsperformanceRepository
     */
    protected $osperformanceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->osperformanceRepo = \App::make(OsperformanceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_osperformance()
    {
        $osperformance = $this->fakeOsperformanceData();
        $createdOsperformance = $this->osperformanceRepo->create($osperformance);
        $createdOsperformance = $createdOsperformance->toArray();
        $this->assertArrayHasKey('id', $createdOsperformance);
        $this->assertNotNull($createdOsperformance['id'], 'Created Osperformance must have id specified');
        $this->assertNotNull(Osperformance::find($createdOsperformance['id']), 'Osperformance with given id must be in DB');
        $this->assertModelData($osperformance, $createdOsperformance);
    }

    /**
     * @test read
     */
    public function test_read_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $dbOsperformance = $this->osperformanceRepo->find($osperformance->id);
        $dbOsperformance = $dbOsperformance->toArray();
        $this->assertModelData($osperformance->toArray(), $dbOsperformance);
    }

    /**
     * @test update
     */
    public function test_update_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $fakeOsperformance = $this->fakeOsperformanceData();
        $updatedOsperformance = $this->osperformanceRepo->update($fakeOsperformance, $osperformance->id);
        $this->assertModelData($fakeOsperformance, $updatedOsperformance->toArray());
        $dbOsperformance = $this->osperformanceRepo->find($osperformance->id);
        $this->assertModelData($fakeOsperformance, $dbOsperformance->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $resp = $this->osperformanceRepo->delete($osperformance->id);
        $this->assertTrue($resp);
        $this->assertNull(Osperformance::find($osperformance->id), 'Osperformance should not exist in DB');
    }
}
