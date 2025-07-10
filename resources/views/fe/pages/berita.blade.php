@extends('fe.layouts.app')

@section('title')
    Berita
@endsection

@section('content')
<section class="meetings-page" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Berita Terbaru</h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row">
          @foreach ($berita as $item)
          <div class="col-lg-4 mb-4">
            <div class="meeting-item">
              <div class="thumb">
                <a href="{{ route('frontend.berita-detail', $item->slug) }}">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('sd') . '/assets/images/meeting-01.jpg' }}" alt="{{ $item->judul }}">
                </a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('M') }} <span>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d') }}</span></h6>
                </div>
                <a href="{{ route('frontend.berita-detail', $item->slug) }}"><h4>{{ $item->judul }}</h4></a>
                <p>{{ Str::limit(strip_tags($item->isi), 100) }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="pagination d-flex justify-content-center">
              {{ $berita->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection