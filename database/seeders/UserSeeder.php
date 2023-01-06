<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default DB (mysql)
        User::factory(10)->create();


        
        // Sqlite DB
        $connection = 'sqlite';

        // Only Prepare Data to be saved in the DB
        // Created 10 users BUT NOT saved in the DB YET
        $users = User::factory(10)->make();
        $users->each(function($model) use ($connection)
        {
            // Tell Model (User) that connect to sqlite
            $model->setConnection($connection);

            // Now save User that maked early in the DB
            $model->save();
        });



        /**
         *
         * make() + save() == create()
         */
    }
}
