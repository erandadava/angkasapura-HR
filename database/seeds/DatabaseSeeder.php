<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(TbljabatanTableSeeder::class);
        $this->call(TblklsjabatanTableSeeder::class);
        $this->call(TblstatuskarTableSeeder::class);
        $this->call(TbltipekarTableSeeder::class);
        $this->call(TblunitTableSeeder::class);
        $this->call(TblunitkerjaTableSeeder::class);
        $this->call(TblkaryawanTableSeeder::class);
        $this->call(TblfungsiTableSeeder::class);
    }
}
