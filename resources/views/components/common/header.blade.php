<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? "Costanza" }}</title>




    @php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), TRUE);
    rsort($manifest);
    @endphp

    @production
    @foreach ($manifest as $item)
    @if (str($item["file"])->endsWith("css"))
    <link rel="stylesheet" href="/build/{{ $item["file"]  }}" />
    @elseif (str($item["file"])->endsWith("js"))
    <script type="module" src="/build/{{ $item["file"] }}"></script>
    @endif
    @endforeach
    @else
    @vite([
    'resources/sass/app.scss',
    'resources/css/app.css',
    'resources/js/app.js'
    ])
    @endproduction



    <meta name="title" content="{{ $title ?? 'Costanza' }}" />
    <meta name="description" content="Costanza (Co-Stanza) is an AI assisted poetry generator." />
    <!-- <meta name="twitter:card" content="summary_large_image" /> -->
    <meta name="og:title" content="{{ $title ?? 'Costanza' }}" />
    <meta name="og:description" content="Costanza (Co-Stanza) is an AI assisted poetry generator" />
    <!-- <meta name="og:image" content="/img/og_image.jpg" /> -->

    <link rel="icon" type="image/png" href="/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/img/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Costanza" />
    <link rel="manifest" href="/img/favicon/site.webmanifest" />



</head>

<body>

    <header>
     
            <nav class="navbar  sticky-top navbar-expand  navbar-light bg-light " role="navigation">
                <div class=" container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="/svg/masthead.svg" alt="COSTANZA: Uncanny AI Poetry" id="masthead" />
                    </a>
                    <ul class="navbar-nav text-nowrap text-muted justify-content-end">
                        <li class="nav-item">
                            <a class=" nav-link text-reset" href="/poetry">Poetry</a>
                        </li>
                        <li class="nav-item">
                            <a class="  nav-link" href="/api">API</a>
                        </li>
                        <li class="nav-item">
                            <a class=" nav-link" href="/about">About</a>
                        </li>
                    </ul>

                </div>
            </nav>
    
    </header>