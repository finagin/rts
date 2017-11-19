<?php

namespace Seeds\Local;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Skill::class, 50)->create();
    }
}
