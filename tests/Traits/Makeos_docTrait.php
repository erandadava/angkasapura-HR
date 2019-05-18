<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\os_doc;
use App\Repositories\os_docRepository;

trait Makeos_docTrait
{
    /**
     * Create fake instance of os_doc and save it in database
     *
     * @param array $osDocFields
     * @return os_doc
     */
    public function makeos_doc($osDocFields = [])
    {
        /** @var os_docRepository $osDocRepo */
        $osDocRepo = \App::make(os_docRepository::class);
        $theme = $this->fakeos_docData($osDocFields);
        return $osDocRepo->create($theme);
    }

    /**
     * Get fake instance of os_doc
     *
     * @param array $osDocFields
     * @return os_doc
     */
    public function fakeos_doc($osDocFields = [])
    {
        return new os_doc($this->fakeos_docData($osDocFields));
    }

    /**
     * Get fake data of os_doc
     *
     * @param array $osDocFields
     * @return array
     */
    public function fakeos_docData($osDocFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'ID' => $fake->randomDigitNotNull,
            'ID_kar' => $fake->randomDigitNotNull,
            'doc_bpsj' => $fake->text,
            'doc_bpjsk' => $fake->text,
            'doc_lisensi' => $fake->text,
            'doc_nomlisensi' => $fake->text,
            'jangkawaktu' => $fake->text,
            'kontrakkerja' => $fake->text
        ], $osDocFields);
    }
}
