<?php

namespace Seeds\Local;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt(env('MASTER_PASSWORD', '12345678'));

        User::firstOrCreate([
            'email' => 'Igor@Finag.in',
        ], [
            'name' => 'Igor Finagin',
            'password' => $password,
            'type' => 'manager',
        ]);

        $skills = Skill::all();

        factory(User::class, 50)
            ->create()
            ->each(function ($user) use ($skills) {
                if ($user->type == 'artisan') {
                    $user->skills()
                        ->sync($skills->random(random_int(2, 7)));
                }
            });
    }
}
