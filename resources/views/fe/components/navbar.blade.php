<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('frontend.index') }}" class="logo">
                        {{ $config['app_name'] ?? 'sd' }}
                    </a>-
                    <ul class="nav">
                        <li><a href="{{ route('frontend.index') }}">Beranda</a></li>
                        <li><a href="{{ route('frontend.berita') }}">Berita</a></li>
                    </ul>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->