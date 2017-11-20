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
        $SkillsTableSeeder = 'Seeds\\'.$env.'\\SkillsTableSeeder';
        $CitiesTableSeeder = 'Seeds\\'.$env.'\\CitiesTableSeeder';

        $this->call($SkillsTableSeeder);
        $this->call($CitiesTableSeeder);
        $this->call($UsersTableSeeder);
    }
}
