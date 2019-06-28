<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makefungsi_osTrait;
use Tests\ApiTestTrait;

class fungsi_osApiTest extends TestCase
{
    use Makefungsi_osTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_fungsi_os()
    {
        $fungsiOs = $this->fakefungsi_osData();
        $this->response = $this->json('POST', '/api/fungsiOs', $fungsiOs);

        $this->assertApiResponse($fungsiOs);
    }

    /**
     * @test
     */
    public function test_read_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $this->response = $this->json('GET', '/api/fungsiOs/'.$fungsiOs->id);

        $this->assertApiResponse($fungsiOs->toArray());
    }

    /**
     * @test
     */
    public function test_update_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $editedfungsi_os = $this->fakefungsi_osData();

        $this->response = $this->json('PUT', '/api/fungsiOs/'.$fungsiOs->id, $editedfungsi_os);

        $this->assertApiResponse($editedfungsi_os);
    }

    /**
     * @test
     */
    public function test_delete_fungsi_os()
    {
        $fungsiOs = $this->makefungsi_os();
        $this->response = $this->json('DELETE', '/api/fungsiOs/'.$fungsiOs->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/fungsiOs/'.$fungsiOs->id);

        $this->response->assertStatus(404);
    }
}
