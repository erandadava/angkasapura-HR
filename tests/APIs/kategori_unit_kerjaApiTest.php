<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makekategori_unit_kerjaTrait;
use Tests\ApiTestTrait;

class kategori_unit_kerjaApiTest extends TestCase
{
    use Makekategori_unit_kerjaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->fakekategori_unit_kerjaData();
        $this->response = $this->json('POST', '/api/kategoriUnitKerjas', $kategoriUnitKerja);

        $this->assertApiResponse($kategoriUnitKerja);
    }

    /**
     * @test
     */
    public function test_read_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $this->response = $this->json('GET', '/api/kategoriUnitKerjas/'.$kategoriUnitKerja->id);

        $this->assertApiResponse($kategoriUnitKerja->toArray());
    }

    /**
     * @test
     */
    public function test_update_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $editedkategori_unit_kerja = $this->fakekategori_unit_kerjaData();

        $this->response = $this->json('PUT', '/api/kategoriUnitKerjas/'.$kategoriUnitKerja->id, $editedkategori_unit_kerja);

        $this->assertApiResponse($editedkategori_unit_kerja);
    }

    /**
     * @test
     */
    public function test_delete_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $this->response = $this->json('DELETE', '/api/kategoriUnitKerjas/'.$kategoriUnitKerja->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/kategoriUnitKerjas/'.$kategoriUnitKerja->id);

        $this->response->assertStatus(404);
    }
}
