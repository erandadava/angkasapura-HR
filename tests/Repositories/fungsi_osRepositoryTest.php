<?php namespace Tests\Repositories;

use App\Models\fungsi_os;
use App\Repositories\fungsi_osRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makefungsi_osTrait;
use Tests\ApiTestTrait;

class fungsi_osRepositoryTest extends TestCase
{
    use Makefungsi_osTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var fungsi_osRepository
     */
    protected $fungsiOsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fungsiOsRepo = \App::make(fungsi_osRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_fungsi_os()
    {
        $fungsiOs = $this->fakefungsi_osData();
        $createdfungsi_os = $this->fungsiOsRepo->create($fungsiOs);
        $createdfungsi_os = $createdfungsi_os->toArray();
        $this->assertArrayHasKey('id', $createdfungsi_os);
        $this->assertNotNull($createdfungsi_os['id'], 'Created fungsi_os must have id specified');
        $this->assertNotNull(fungsi_os::find($createdfungsi_os['id']), 'fungsi_os with given id must be in DB');
        $this->assertModelData($fungsiOs, $createdfungsi_os);
    }

    /**
     * @test read
     */
    public function test_read_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $dbfungsi_os = $this->fungsiOsRepo->find($fungsiOs->id);
        $dbfungsi_os = $dbfungsi_os->toArray();
        $this->assertModelData($fungsiOs->toArray(), $dbfungsi_os);
    }

    /**
     * @test update
     */
    public function test_update_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $fakefungsi_os = $this->fakefungsi_osData();
        $updatedfungsi_os = $this->fungsiOsRepo->update($fakefungsi_os, $fungsiOs->id);
        $this->assertModelData($fakefungsi_os, $updatedfungsi_os->toArray());
        $dbfungsi_os = $this->fungsiOsRepo->find($fungsiOs->id);
        $this->assertModelData($fakefungsi_os, $dbfungsi_os->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $resp = $this->fungsiOsRepo->delete($fungsiOs->id);
        $this->assertTrue($resp);
        $this->assertNull(fungsi_os::find($fungsiOs->id), 'fungsi_os should not exist in DB');
    }
}
