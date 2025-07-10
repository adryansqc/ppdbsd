@extends('fe.layouts.app')

@section('title')
    {{ $berita->judul }}
@endsection

@section('content')
<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="meeting-single-item">
                    <div class="thumb">
                        <div class="date">
                            <h6>{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('M') }} <span>{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d') }}</span></h6>
                        </div>
                        <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('sd') . '/assets/images/meeting-01.jpg' }}" alt="{{ $berita->judul }}">
                    </div>
                    <div class="down-content">
                        <h4>{{ $berita->judul }}</h4>
                        <p class="description">
                            {!! $berita->isi !!}
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ url('/berita') }}" class="btn btn-primary">Kembali ke Daftar Berita</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related News Section --}}
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Berita Lainnya</h2>
                </div>
            </div>
            @foreach($berita->where('id', '!=', $berita->id)->take(3)->get() as $related)
            <div class="col-lg-4">
                <div class="meeting-item">
                    <div class="thumb">
                        <a href="{{ route('frontend.berita-detail', $related->slug) }}">
                            <img src="{{ $related->gambar ? asset('storage/' . $related->gambar) : asset('sd') . '/assets/images/meeting-01.jpg' }}" alt="{{ $related->judul }}">
                        </a>
                    </div>
                    <div class="down-content">
                        <div class="date">
                            <h6>{{ \Carbon\Carbon::parse($related->tanggal_publikasi)->format('M') }} <span>{{ \Carbon\Carbon::parse($related->tanggal_publikasi)->format('d') }}</span></h6>
                        </div>
                        <a href="{{ route('frontend.berita-detail', $related->slug) }}"><h4>{{ $related->judul }}</h4></a>
                        <p>{{ Str::limit(strip_tags($related->isi), 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection