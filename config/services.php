<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'openai' => [
        "organization"  => env("OPENAI_ORGANIZATION"),
        "project"       => env("OPENAI_PROJECT"),
        "token"         =>  env("OPENAI_TOKEN"),
        'base_url'      => 'https://api.openai.com',
        // I had trained a custom "costanza poetry request" JSON format and response, but the model was hallucinating
        // when requests were made through the API. So, every request now just has this prompt for the system: 
        'instruction' => [
                "Please generate a poem with the following qualities: ", // preamble
                ". Your response must include 'title', 'lineation', and an optional 'authors-note', in a very simple XML format.",
                "Example: <xml><title>My Favorite Poem</title><lineation>This is my poem\nIt is great\n\nThe end</lineation></xml>"
        ]
        
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
