<?php

namespace Seeds\Local;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'title' => 'Великий шаман',

            'children' => [
                [
                    'title' => 'Администратор',

                    'children' => [
                        [
                            'title' => 'Куратор',

                            'children' => [
                                [
                                    'title' => 'Координатор Красноярск 1',

                                ],
                                [
                                    'title' => 'Координатор Красноярск 2',
                                ],
                                [
                                    'title' => 'Координатор Казань 1',
                                ],
                                [
                                    'title' => 'Координатор Казань 2',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
