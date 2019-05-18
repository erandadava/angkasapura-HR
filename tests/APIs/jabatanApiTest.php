<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakejabatanTrait;
use Tests\ApiTestTrait;

class jabatanApiTest extends TestCase
{
    use MakejabatanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jabatan()
    {
        $jabatan = $this->fakejabatanData();
        $this->response = $this->json('POST', '/api/jabatans', $jabatan);

        $this->assertApiResponse($jabatan);
    }

    /**
     * @test
     */
    public function test_read_jabatan()
    {
        $jabatan = $this->makejabatan();
        $this->response = $this->json('GET', '/api/jabatans/'.$jabatan->id);

        $this->assertApiResponse($jabatan->toArray());
    }

    /**
     * @test
     */
    public function test_update_jabatan()
    {
        $jabatan = $this->makejabatan();
        $editedjabatan = $this->fakejabatanData();

        $this->response = $this->json('PUT', '/api/jabatans/'.$jabatan->id, $editedjabatan);

        $this->assertApiResponse($editedjabatan);
    }

    /**
     * @test
     */
    public function test_delete_jabatan()
    {
        $jabatan = $this->makejabatan();
        $this->response = $this->json('DELETE', '/api/jabatans/'.$jabatan->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/jabatans/'.$jabatan->id);

        $this->response->assertStatus(404);
    }
}
