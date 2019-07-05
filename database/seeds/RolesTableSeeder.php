<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => '2019-06-25 13:27:52',
                'updated_at' => '2019-06-25 13:27:52',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2019-06-25 13:28:11',
                'updated_at' => '2019-06-25 13:28:11',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Vendor',
                'guard_name' => 'web',
                'created_at' => '2019-06-25 13:28:25',
                'updated_at' => '2019-06-25 13:28:25',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'management',
                'guard_name' => 'web',
                'created_at' => '2019-07-05 15:18:33',
                'updated_at' => '2019-07-05 15:18:33',
            ),
        ));
        
        
    }
}