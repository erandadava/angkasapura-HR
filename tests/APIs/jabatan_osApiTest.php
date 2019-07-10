<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makejabatan_osTrait;
use Tests\ApiTestTrait;

class jabatan_osApiTest extends TestCase
{
    use Makejabatan_osTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jabatan_os()
    {
        $jabatanOs = $this->fakejabatan_osData();
        $this->response = $this->json('POST', '/api/jabatanOs', $jabatanOs);

        $this->assertApiResponse($jabatanOs);
    }

    /**
     * @test
     */
    public function test_read_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $this->response = $this->json('GET', '/api/jabatanOs/'.$jabatanOs->id);

        $this->assertApiResponse($jabatanOs->toArray());
    }

    /**
     * @test
     */
    public function test_update_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $editedjabatan_os = $this->fakejabatan_osData();

        $this->response = $this->json('PUT', '/api/jabatanOs/'.$jabatanOs->id, $editedjabatan_os);

        $this->assertApiResponse($editedjabatan_os);
    }

    /**
     * @test
     */
    public function test_delete_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $this->response = $this->json('DELETE', '/api/jabatanOs/'.$jabatanOs->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/jabatanOs/'.$jabatanOs->id);

        $this->response->assertStatus(404);
    }
}
