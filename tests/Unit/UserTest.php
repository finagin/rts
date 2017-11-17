<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        foreach (static::range() as $iteration) {
            $total = User::all()
                ->count();

            $rand = rand(5, 15);

            factory(User::class, $rand)->create();

            $this->assertEquals($total + $rand, User::all()
                ->count());
        }

        $this->assertDatabaseHas('users', ['type' => 'manager']);
        $this->assertDatabaseHas('users', ['type' => 'artisan']);
        $this->assertDatabaseMissing('users', ['type' => 'any-type']);
    }
}
