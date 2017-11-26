<?php

namespace App\Traits\Console\Commands;

use Dotzero\LaravelAmoCrm\Facades\AmoCrm;

trait AmoArtisansEach
{
    protected function each(callable $callable = null)
    {
        if ($this->option('yes') || $this->confirm('Are you sure?')) {
            $client = AmoCrm::getClient();

            $page = 0;
            $artisans = collect([]);

            do {
                $page++;
                $response = $client->catalog_element->apiList([
                    'catalog_id' => config('amocrm.catalog.artisans'),
                    'PAGEN_1' => $page,
                ]);

                $artisans = $artisans->merge($response);
            } while (count($response) > 0);

            $count = intval($this->option('count') ?? count($artisans)) - 1;

            $bar = $this->output->createProgressBar($count);

            foreach ($artisans as $iteration => $artisan) {
                if ($iteration > $count) {
                    break;
                }

                if (! is_null($callable)) {
                    $callable($artisan, $iteration);
                }

                $bar->advance();
            }

            $bar->finish();
        }
    }
}
