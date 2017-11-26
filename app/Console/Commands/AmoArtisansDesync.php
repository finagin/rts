<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;
use App\Traits\Console\Commands\AmoArtisansEach;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AmoArtisansDesync extends Command
{
    use AmoArtisansEach;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisans:amo:desync
                            {--y|yes : Automatic yes to prompts; assume "yes" as answer to all prompts and run non-interactively.}
                            {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desync AmoCRM Artisans';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        static::each(function ($artisan) {
            $client = AmoCrm::getClient();

            foreach ($artisan['custom_fields'] as $custom_field) {
                if ($custom_field['id'] == 378946) {
                    if (preg_match('/^ID:(\d+)$/', $custom_field['values'][0]['value'], $matches)) {
                        try {
                            User::findOrFail($matches[1])
                                ->delete();
                        } catch (ModelNotFoundException $e) {
                        }
                    }
                }
            }

            $element = $client->catalog_element;
            $element['catalog_id'] = config('amocrm.catalog.artisans');
            $element->offsetSet('name', $artisan['name']);
            $element->addCustomField(config('amocrm.custom_fields.artisans.id'), null);
            $element->apiUpdate((int) $artisan['id']);
        });
    }
}
