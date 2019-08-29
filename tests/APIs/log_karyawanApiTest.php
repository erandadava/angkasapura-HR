<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_karyawan;

class log_karyawanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_karyawans', $logKaryawan
        );

        $this->assertApiResponse($logKaryawan);
    }

    /**
     * @test
     */
    public function test_read_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/log_karyawans/'.$logKaryawan->id
        );

        $this->assertApiResponse($logKaryawan->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();
        $editedlog_karyawan = factory(log_karyawan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_karyawans/'.$logKaryawan->id,
            $editedlog_karyawan
        );

        $this->assertApiResponse($editedlog_karyawan);
    }

    /**
     * @test
     */
    public function test_delete_log_karyawan()
    {
        $logKaryawan = factory(log_karyawan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_karyawans/'.$logKaryawan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_karyawans/'.$logKaryawan->id
        );

        $this->response->assertStatus(404);
    }
}
