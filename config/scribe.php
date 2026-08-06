<?php

// Prevent production crash if Scribe package is excluded via composer --no-dev
if (!class_exists(\Knuckles\Scribe\ScribeServiceProvider::class)) {
    return [];
}

return [
    'title' => config('app.name').' API Documentation',

    'description' => '',

    'intro_text' => <<<'INTRO'
            This documentation aims to provide all the information you need to work with our API.

            <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
            You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
        INTRO,

    'base_url' => config('app.url'),

    'routes' => [
        [
            'match' => [
                'prefixes' => ['customer/*', 'admin/*', 'superadmin/*', 'payments/*'],
                'domains' => ['*'],
            ],
            'include' => [],
            'exclude' => [],
        ],
    ],

    'type' => 'laravel',
    'theme' => 'default',

    'static' => [
        'output_path' => 'public/docs',
    ],

    'laravel' => [
        'add_routes' => true,
        'docs_url' => '/docs',
        'assets_directory' => null,
        'middleware' => [],
    ],

    'external' => [
        'html_attributes' => [],
    ],

    'try_it_out' => [
        'enabled' => true,
        'base_url' => null,
        'use_csrf' => false,
        'csrf_url' => '/sanctum/csrf-cookie',
    ],

    'auth' => [
        'enabled' => false,
        'default' => false,
        'in' => class_exists(\Knuckles\Scribe\Config\AuthIn::class) ? \Knuckles\Scribe\Config\AuthIn::BEARER->value : 'bearer',
        'name' => 'key',
        'use_value' => env('SCRIBE_AUTH_KEY'),
        'placeholder' => '{YOUR_AUTH_KEY}',
        'extra_info' => 'You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.',
    ],

    'example_languages' => [
        'bash',
        'javascript',
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [],
    ],

    'openapi' => [
        'enabled' => true,
        'version' => '3.0.3',
        'overrides' => [],
        'generators' => [],
    ],

    'groups' => [
        'default' => 'Endpoints',
        'order' => [],
    ],

    'logo' => false,
    'last_updated' => 'Last updated: {date:F j, Y}',

    'examples' => [
        'faker_seed' => 1234,
        'models_source' => ['factoryCreate', 'factoryMake', 'databaseFirst'],
    ],

    'strategies' => [
        'metadata' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::METADATA_STRATEGIES,
        ] : [],
        'headers' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::HEADERS_STRATEGIES,
            \Knuckles\Scribe\Extracting\Strategies\StaticData::withSettings(data: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]),
        ] : [],
        'urlParameters' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::URL_PARAMETERS_STRATEGIES,
        ] : [],
        'queryParameters' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::QUERY_PARAMETERS_STRATEGIES,
        ] : [],
        'bodyParameters' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::BODY_PARAMETERS_STRATEGIES,
        ] : [],
        'responses' => (function_exists('Knuckles\Scribe\Config\configureStrategy') && class_exists(\Knuckles\Scribe\Config\Defaults::class)) ? \Knuckles\Scribe\Config\configureStrategy(
            \Knuckles\Scribe\Config\Defaults::RESPONSES_STRATEGIES,
            \Knuckles\Scribe\Extracting\Strategies\Responses\ResponseCalls::withSettings(
                only: ['GET *'],
                config: [
                    'app.debug' => false,
                ]
            )
        ) : [],
        'responseFields' => class_exists(\Knuckles\Scribe\Config\Defaults::class) ? [
            ...\Knuckles\Scribe\Config\Defaults::RESPONSE_FIELDS_STRATEGIES,
        ] : [],
    ],

    'database_connections_to_transact' => [config('database.default')],

    'fractal' => [
        'serializer' => null,
    ],
];