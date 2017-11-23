<?php

namespace App\Listeners;

use App\Events\ArtisanSaved;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;

class ArtisanSyncAmo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArtisanSaved  $event
     * @return void
     */
    public function handle(ArtisanSaved $event)
    {
        $user = $event->getUser();
        $client = AmoCrm::getClient();

        $artisan_old = $client->catalog_element->apiList([
            'catalog_id' => config('amocrm.catalog.artisans'),
            'term' => 'ID:'.$user->id,
        ]);

        $element = $client->catalog_element;
        $element['catalog_id'] = config('amocrm.catalog.artisans');

        $element['name'] = $user->name;

        $element->addCustomField(config('amocrm.custom_fields.artisans.id'), 'ID:'.$user->id);

        $skills = $user->skills->map(function ($skill) {
            return [$skill->slug, $skill->id];
        });
        if ($skills->isNotEmpty()) {
            $element->addCustomField(config('amocrm.custom_fields.artisans.skills'), $skills->toArray(), true);
        }

        $cities = $user->cities->map(function ($city) {
            return [$city->title, $city->id];
        });
        if ($cities->isNotEmpty()) {
            $element->addCustomField(config('amocrm.custom_fields.artisans.cities'), $cities->toArray(), true);
        }

        if (! empty($artisan_old)) {
            $element->apiUpdate((int) $artisan_old[0]['id']);
        } else {
            $element->apiAdd();
        }
    }
}
