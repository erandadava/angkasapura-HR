<?php namespace Tests\Repositories;

use App\Models\fungsi;
use App\Repositories\fungsiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakefungsiTrait;
use Tests\ApiTestTrait;

class fungsiRepositoryTest extends TestCase
{
    use MakefungsiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var fungsiRepository
     */
    protected $fungsiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fungsiRepo = \App::make(fungsiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_fungsi()
    {
        $fungsi = $this->fakefungsiData();
        $createdfungsi = $this->fungsiRepo->create($fungsi);
        $createdfungsi = $createdfungsi->toArray();
        $this->assertArrayHasKey('id', $createdfungsi);
        $this->assertNotNull($createdfungsi['id'], 'Created fungsi must have id specified');
        $this->assertNotNull(fungsi::find($createdfungsi['id']), 'fungsi with given id must be in DB');
        $this->assertModelData($fungsi, $createdfungsi);
    }

    /**
     * @test read
     */
    public function test_read_fungsi()
    {
        $fungsi = $this->makefungsi();
        $dbfungsi = $this->fungsiRepo->find($fungsi->id);
        $dbfungsi = $dbfungsi->toArray();
        $this->assertModelData($fungsi->toArray(), $dbfungsi);
    }

    /**
     * @test update
     */
    public function test_update_fungsi()
    {
        $fungsi = $this->makefungsi();
        $fakefungsi = $this->fakefungsiData();
        $updatedfungsi = $this->fungsiRepo->update($fakefungsi, $fungsi->id);
        $this->assertModelData($fakefungsi, $updatedfungsi->toArray());
        $dbfungsi = $this->fungsiRepo->find($fungsi->id);
        $this->assertModelData($fakefungsi, $dbfungsi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_fungsi()
    {
        $fungsi = $this->makefungsi();
        $resp = $this->fungsiRepo->delete($fungsi->id);
        $this->assertTrue($resp);
        $this->assertNull(fungsi::find($fungsi->id), 'fungsi should not exist in DB');
    }
}
