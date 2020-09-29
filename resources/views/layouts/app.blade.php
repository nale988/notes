<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.0/css/halfmoon-variables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/styles/default.min.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.2.0/styles/github.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/highlight.min.js"></script>

    <script src="{{ asset('js/summernote-ext-addclass.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Notes') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
</head>

<body>
    <div id="app">
        <div class="page-wrapper with-navbar with-sidebar">
        <nav class="navbar justify-content-between">
            <div class="navbar-content">
                <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-action" type="button"  onclick="halfmoon.toggleSidebar()" data-placement="right" data-toggle="tooltip" data-title="Sakrij menu" data-target-breakpoint="md" >
                  <i class="fa fa-bars" aria-hidden="true"></i>
                  <span class="sr-only">Toggle sidebar</span> <!-- sr-only = show only on screen readers -->
                </button>
                <button class="btn btn-action ml-2" type="button" onclick="toggleDM()" data-placement="right" data-toggle="tooltip" data-title="Tamni mod" data-target-breakpoint="md" >
                    <i class="fa fa-moon-o" aria-hidden="true"></i>
                    <span class="sr-only">Switch mode</span>
                </button>
                </div>
            </div>
            <a href="{{ url('/') }}" class="navbar-brand">
                Notes
            </a>
            <div class="dropdown with-arrow">
                <button class="btn" data-toggle="dropdown" type="button" id="navbar-dropdown-toggle-btn-1">
                    @auth
                    {{ substr(explode(" ", Auth::user()->name)[0], 0, 1) }}{{ substr(explode(" ", Auth::user()->name)[1], 0, 1) }}
                    @endauth
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="navbar-dropdown-toggle-btn-1"> <!-- w-200 = width: 20rem (200px) -->
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('/') }}">Otvori novo</a>
                  <div class="dropdown-content">
                    <small class="float-right" title="Page reply speed">Page reply: {{ round(microtime(true) - LARAVEL_START, 2) }}s</small>
                  </div>
                </div>
              </div>
            </nav>
            @auth
            <div class="sidebar">
                @include('sidebarhm')
            </div>
            <div class="content-wrapper">
                <div class="container-fluid">
                @yield('content')
                </div>
            </div>
            @else
            <div class="content-wrapper">
                <div class="content">
                @yield('content')
                </div>
            </div>
            @endauth
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.0/js/halfmoon.min.js"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        addclass: {
            debug: false,
            classTags: ["text-success", "text-primary", "text-info", "text-danger", "text-muted", "alert alert-primary", "alert alert-success", "alert alert-danger", "alert alert-info", "text-jusitfy", "text-monospace", "border", "border border-primary", "border border-danger", "sticky-top", "shadow-sm p-3 mb-5 bg-white rounded", "shadow p-3 mb-5 bg-white rounded", "shadow-lg p-3 mb-5 bg-white rounded"]
        },
        height: 300,                 // set editor height
        minHeight: 200,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true,                 // set focus to editable area after initializing summernote
        lineHeights: ['0.8', '0.9', '1.0', '1.2', '1.4', '2.0', '3.0', '4.0'],
        toolbar: [
            // [groupName, [list of button]]
            //['style', ['bold', 'italic', 'underline', 'clear', 'height', 'hr', 'addclass']],
            ['color', ['color']],
            ['style', ['hr', 'addclass']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'table']],
            ['view', ['fullscreen', 'codeview']]
        ],
    });
});
</script>

<script type="text/javascript">
    function toggleDM() {
      halfmoon.toggleDarkMode();
    }
</script>

<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>
