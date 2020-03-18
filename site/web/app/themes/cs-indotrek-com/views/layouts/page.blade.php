<!doctype html>
<html @php(language_attributes())>
    <head>
        @include('partials.core.head')
        @header
    </head>
    <body class="loading" @php(body_class())>
        <div id="app">
            {{-- <div class="loading__overlay">
                <cs-loader ref="loader" id="loader" color="hsl(0, 0%, 0%)" width="1px"></cs-loader>
            </div> --}}
            <div ref="layout" id="layout" style="opacity: 1">
                @include('partials.core.navigation')
                <main class="page">	
                    @yield('content')
                </main>
                @include('partials.core.footer')
            </div>
        </div>
            <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
            @footer
            @yield('footerScripts')                    
    </body>
</html>