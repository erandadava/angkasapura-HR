<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makekaryawan_osTrait;
use Tests\ApiTestTrait;

class karyawan_osApiTest extends TestCase
{
    use Makekaryawan_osTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_karyawan_os()
    {
        $karyawanOs = $this->fakekaryawan_osData();
        $this->response = $this->json('POST', '/api/karyawanOs', $karyawanOs);

        $this->assertApiResponse($karyawanOs);
    }

    /**
     * @test
     */
    public function test_read_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $this->response = $this->json('GET', '/api/karyawanOs/'.$karyawanOs->id);

        $this->assertApiResponse($karyawanOs->toArray());
    }

    /**
     * @test
     */
    public function test_update_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $editedkaryawan_os = $this->fakekaryawan_osData();

        $this->response = $this->json('PUT', '/api/karyawanOs/'.$karyawanOs->id, $editedkaryawan_os);

        $this->assertApiResponse($editedkaryawan_os);
    }

    /**
     * @test
     */
    public function test_delete_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $this->response = $this->json('DELETE', '/api/karyawanOs/'.$karyawanOs->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/karyawanOs/'.$karyawanOs->id);

        $this->response->assertStatus(404);
    }
}
