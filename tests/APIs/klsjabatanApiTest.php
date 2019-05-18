<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeklsjabatanTrait;
use Tests\ApiTestTrait;

class klsjabatanApiTest extends TestCase
{
    use MakeklsjabatanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_klsjabatan()
    {
        $klsjabatan = $this->fakeklsjabatanData();
        $this->response = $this->json('POST', '/api/klsjabatans', $klsjabatan);

        $this->assertApiResponse($klsjabatan);
    }

    /**
     * @test
     */
    public function test_read_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $this->response = $this->json('GET', '/api/klsjabatans/'.$klsjabatan->id);

        $this->assertApiResponse($klsjabatan->toArray());
    }

    /**
     * @test
     */
    public function test_update_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $editedklsjabatan = $this->fakeklsjabatanData();

        $this->response = $this->json('PUT', '/api/klsjabatans/'.$klsjabatan->id, $editedklsjabatan);

        $this->assertApiResponse($editedklsjabatan);
    }

    /**
     * @test
     */
    public function test_delete_klsjabatan()
    {
        $klsjabatan = $this->makeklsjabatan();
        $this->response = $this->json('DELETE', '/api/klsjabatans/'.$klsjabatan->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/klsjabatans/'.$klsjabatan->id);

        $this->response->assertStatus(404);
    }
}
