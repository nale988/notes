<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.0/css/halfmoon-variables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- include libraries(jQuery, bootstrap) -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="{{ asset('js/summernote-ext-addclass.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Notes') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    {{-- <div class="page-wrapper with-navbar with-sidebar"> --}}
        <div class="page-wrapper with-navbar with-sidebar" data-sidebar-type="overlayed-all">
        <div class="sidebar-overlay" onclick="halfmoon.toggleSidebar()"></div>
        <nav class="navbar justify-content-between">
            <div class="navbar-content">
                <button class="btn btn-action" type="button"  onclick="halfmoon.toggleSidebar()">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                  <span class="sr-only">Toggle sidebar</span> <!-- sr-only = show only on screen readers -->
                </button>
            </div>
            <a href="{{ url('/') }}" class="navbar-brand">
                Notes
            </a>

            <div class="dropdown with-arrow">
                <button class="btn" data-toggle="dropdown" type="button" id="navbar-dropdown-toggle-btn-1">
                    {{ substr(explode(" ", Auth::user()->name)[0], 0, 1) }}{{ substr(explode(" ", Auth::user()->name)[1], 0, 1) }}
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
                  <div class="dropdown-content">
                    <small class="float-right" title="Page reply speed">Page reply: {{ round(microtime(true) - LARAVEL_START, 2) }}s</small>
                  </div>
                </div>
              </div>
        </nav>
        <!-- Sidebar (immediate child of the page wrapper) -->
        <div class="sidebar">
            @include('sidebarhm')
        </div>
        <div class="content-wrapper">
            @yield('content')
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

</body>
</html>
