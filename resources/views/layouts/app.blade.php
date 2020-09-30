<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.2.0/styles/github.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/highlight.min.js"></script>


    <script src="{{ asset('js/summernote-ext-addclass.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Notes') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
            <div class="container">
                <button type="button" id="closeSidebarButton" class="btn btn-light btn-sm pr-2 mr-2">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 12.796L11.481 8 6 3.204v9.592zm.659.753l5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                    </svg>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Notes') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="my-2">
                            <small class="nav-item text-muted">Page: {{ round(microtime(true) - LARAVEL_START, 2) }}s</small>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ substr(explode(" ", Auth::user()->name)[0], 0, 1) }}{{ substr(explode(" ", Auth::user()->name)[1], 0, 1) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if ($errors->any())
                <div class="container">
                    <div class="alert alert-danger alert-dismissible text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                @if (Session::has('message'))
                <div class="container">
                    <div class="alert alert-info alert-dismissible text-center" role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                @if (Session::has('warning'))
                <div class="container">
                    <div class="alert alert-warning alert-dismissible text-center" role="alert">
                        {{ Session::get('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                @if (Session::has('alert'))
                <div class="container">
                    <div class="alert alert-danger alert-dismissible text-center" role="alert">
                        {{ Session::get('alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif
                @auth
                <div class="row">
                    <div class="col-sm-12 col-md-3 mt-3" id="sidebar">
                        @include('sidebar')
                    </div>
                    <div class="col-sm-12 col-md-9 mt-3" id="maincontent">
                        @yield('content')
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
                @endauth
            </div>
        </main>
    </div>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        addclass: {
            debug: false,
            classTags: ["text-success", "text-primary", "text-info", "text-danger", "text-muted", "alert alert-primary", "alert alert-success", "alert alert-danger", "alert alert-info", "text-jusitfy", "text-monospace", "border", "border border-primary", "border border-danger", "sticky-top", "shadow-sm p-3 mb-5 bg-white rounded", "shadow p-3 mb-5 bg-white rounded", "shadow-lg p-3 mb-5 bg-white rounded"]
        },
        minHeight: 500,
        maxHeight: null,
        focus: true,
        lineHeights: ['0.8', '0.9', '1.0', '1.2', '1.4', '2.0', '3.0', '4.0'],
        toolbar: [
            ['color', ['color']],
            ['style', ['hr', 'addclass']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'table']],
            ['view', ['fullscreen', 'codeview']]
        ],
    });

    $("#closeSidebarButton").click(
        function(){
            $("#sidebar").toggleClass("d-none");
            $("#maincontent").toggleClass("col-sm-12 col-md-12 col-lg-12 mt-3");
    });

    $(document).attr("title", "{{ isset($note) ? 'n: '.$note -> title : 'nNotes' }}");
});
</script>

<script>hljs.initHighlightingOnLoad();</script>

</body>

</body>
</html>
