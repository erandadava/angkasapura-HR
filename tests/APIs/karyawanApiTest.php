<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakekaryawanTrait;
use Tests\ApiTestTrait;

class karyawanApiTest extends TestCase
{
    use MakekaryawanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_karyawan()
    {
        $karyawan = $this->fakekaryawanData();
        $this->response = $this->json('POST', '/api/karyawans', $karyawan);

        $this->assertApiResponse($karyawan);
    }

    /**
     * @test
     */
    public function test_read_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $this->response = $this->json('GET', '/api/karyawans/'.$karyawan->id);

        $this->assertApiResponse($karyawan->toArray());
    }

    /**
     * @test
     */
    public function test_update_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $editedkaryawan = $this->fakekaryawanData();

        $this->response = $this->json('PUT', '/api/karyawans/'.$karyawan->id, $editedkaryawan);

        $this->assertApiResponse($editedkaryawan);
    }

    /**
     * @test
     */
    public function test_delete_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $this->response = $this->json('DELETE', '/api/karyawans/'.$karyawan->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/karyawans/'.$karyawan->id);

        $this->response->assertStatus(404);
    }
}
