<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\QueryException;
use AmoCRM\Exception as AmoCRMException;
use Illuminate\Queue\InteractsWithQueue;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AmoArtisansSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $artisan;

    /**
     * Create a new job instance.
     *
     * @param array $artisan
     *
     * @return void
     */
    public function __construct($artisan)
    {
        $this->artisan = $artisan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->store();
    }

    protected function store()
    {
        $stored = false;
        foreach ($this->artisan['custom_fields'] as $custom_field) {
            if (! $stored && $custom_field['id'] == config('amocrm.custom_fields.artisans.id')) {
                if (preg_match('/^ID:(\d+)$/', $custom_field['values'][0]['value'], $matches)) {
                    try {
                        $user = User::findOrFail($matches[1]);
                        $stored = true;
                    } catch (ModelNotFoundException $e) {
                    }
                }
            }
        }

        if (! $stored) {
            $bool = true;
            $suffix = '@rts.ru';
            $fillable = [
                'name' => $this->artisan['name'],
            ];

            do {
                $random = str_random(15);
                $fillable['email'] = $random.$suffix;
                $fillable['password'] = $random;

                try {
                    $user = User::create($fillable);

                    try {
                        $client = AmoCrm::getClient();

                        $element = $client->catalog_element;
                        $element['catalog_id'] = config('amocrm.catalog.artisans');
                        $element->offsetSet('name', $this->artisan['name']);
                        $element->addCustomField(config('amocrm.custom_fields.artisans.id'), 'ID:'.$user->id);
                        $element->apiUpdate((int) $this->artisan['id']);
                    } catch (AmoCRMException $e) {
                    }

                    $bool = false;
                } catch (QueryException $e) {
                }
            } while ($bool);
        }

        foreach ($this->artisan['custom_fields'] as $custom_field) {
            if ($custom_field['id'] == config('amocrm.custom_fields.artisans.skills')) {
                $skills = collect($custom_field['values'])->pluck('enum');

                $user->skills()->sync($skills);
            } elseif ($custom_field['id'] == config('amocrm.custom_fields.artisans.cities')) {
                $cities = collect($custom_field['values'])->pluck('enum');

                $user->cities()->sync($cities);
            }
        }
    }
}
