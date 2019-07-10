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
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$5.6Y2JGn0jJ2k18GonT6wO3Fx9vJtLj44IyDdFhUotsqRo.saVf1u',
                'remember_token' => '08rBr9q54d8s1Y60buYoboDMrv72UrtEshm1Y2z0kMk2ICcb6q0C1yD96NYm',
                'created_at' => '2019-05-31 03:58:35',
                'updated_at' => '2019-06-25 13:29:12',
                'verified' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'Admin HR',
                'name' => 'Admin HR',
                'email' => 'adminhr@mail.com',
                'password' => '$2y$10$N0fkQ2PUXHz8erIlwVQPTurYL8f/KpHee6PXxBhFXpcIYcDI/OPVq',
                'remember_token' => 'R7hYQZfRpgkmEP1pXZK4fACcsEqadRsg9PopdH8dBXQtoGTEjfTJidNwi9ZR',
                'created_at' => '2019-06-25 13:31:01',
                'updated_at' => '2019-06-25 13:31:01',
                'verified' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'Vendor',
                'name' => 'Vendor',
                'email' => 'vendor@mail.com',
                'password' => '$2y$10$GGmb1kQzUjc0L46gR8ts5.vMaZnhiLORrbRAjjF1Jz2fMizGQu8Ue',
                'remember_token' => NULL,
                'created_at' => '2019-06-25 13:31:23',
                'updated_at' => '2019-06-25 13:31:23',
                'verified' => 0,
            ),
            3 => 
            array (
                'id' => 5,
                'username' => 'management',
                'name' => 'management',
                'email' => 'management@mail.com',
                'password' => '$2y$10$gcWzmtDVVomwqh9LGErNnOfFDYuJng4qJWpbcdIZd5gB/DLPIN5GK',
                'remember_token' => 'BzWhdisZLVLEbIYgcRF8d9WChcVdR0eZoBt9njKNrnaxYmNSJg0g1C3aEe2g',
                'created_at' => '2019-07-05 15:18:49',
                'updated_at' => '2019-07-05 15:18:49',
                'verified' => 0,
            ),
        ));
        
        
    }
}