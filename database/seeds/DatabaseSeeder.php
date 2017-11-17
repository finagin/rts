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
        $env = studly_case(env('APP_ENV'));

        $UsersTableSeeder = 'Seeds\\'.$env.'\\UsersTableSeeder';

        $this->call($UsersTableSeeder);
    }
}
