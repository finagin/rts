<?php

/*
 * This file is part of Laravel AmoCrm.
 *
 * (c) dotzero <mail@dotzero.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Авторизация в системе amoCRM
    |--------------------------------------------------------------------------
    |
    | Эти параметры необходимы для авторизации в системе amoCRM.
    | - Поддомен компании. Приставка в домене перед .amocrm.ru;
    | - Логин пользователя. В качестве логина в системе используется e-mail;
    | - Ключ пользователя, который можно получить на странице редактирования
    |   профиля пользователя.
    |
    */

    'domain' => env('AMO_DOMAIN', env('AMO_DOMAIN')),
    'login' => env('AMO_LOGIN', env('AMO_LOGIN')),
    'hash' => env('AMO_HASH', env('AMO_HASH')),

    /*
    |--------------------------------------------------------------------------
    | Авторизация в системе B2B Family
    |--------------------------------------------------------------------------
    |
    | Эти параметры авторизации необходимо указать если будет использована
    | отправка писем с привязкой к сделке в amoCRM, через сервис B2B Family.
    |
    */

    'b2bfamily' => [

        'appkey' => env('B2B_APPKEY'),
        'secret' => env('B2B_SECRET'),
        'email' => env('B2B_EMAIL'),
        'password' => env('B2B_PASSWORD'),

    ],

    'catalog' => [
        'artisans' => env('AMO__CATALOG__ARTISANS', 1530),
    ],

    'custom_fields' => [
        'artisans' => [
            'id' => env('AMO__CUSTOM_FIELDS__ARTISAN__ID',378946),
            'skills' => env('AMO__CUSTOM_FIELDS__ARTISAN__SKILLS', 390646),
            'cities' => env('AMO__CUSTOM_FIELDS__ARTISAN__CITIES', 114800),
        ]
    ],

];
