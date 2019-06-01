<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$aHWlbVB9Vsi7VpybX/x7oONtfNZAjlsf1PlDiOyuwZMdB1khP/F9S',
                'remember_token' => NULL,
                'created_at' => '2019-05-31 03:58:35',
                'updated_at' => '2019-05-31 03:58:35',
                'verified' => 0,
            ),
        ));
        
        
    }
}