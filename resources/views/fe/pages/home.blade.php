@extends('fe.layouts.app')

@section('title')
    Beranda
@endsection

@section('content')
<section class="section main-banner" id="top" data-section="section1">
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('sd') }}/assets/images/profil.mp4" type="video/mp4" />
    </video>
    {{-- <iframe
        id="bg-video"
        width="100%"
        height="100%"
        style=""
        src="https://www.youtube.com/embed/F0d8JJUNkqo?autoplay=1&mute=1&loop=1&playlist=F0d8JJUNkqo&controls=0&showinfo=0&rel=0"
        title="Background Video"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; pointer-events: none;"
    ></iframe> --}}

    <div class="video-overlay header-text">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="caption">
            <h6>Hallo Calon Peserta Didik Baru</h6>
            <h2>{{ $config['main_title'] ?? '-' }}</h2>
            <p>{{ $config['second_title'] ?? '-' }}</p>
            <div class="main-button-red">
                <div><a href="{{ url('/admin/register') }}">Lakukan Pendaftaran</a></div>
            </div>
        </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- ***** Main Banner Area End ***** -->

<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-service-item owl-carousel">

          <div class="item">
            <div class="icon">
              <img src="{{ asset('sd') }}/assets/images/service-icon-01.png" alt="">
            </div>
            <div class="down-content">
              <h4>Kurikulum Yang Baik</h4>
              <p>Kami menyediakan kurikulum terbaik dan metode pengajaran inovatif untuk hasil belajar optimal.</p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{ asset('sd') }}/assets/images/service-icon-02.png" alt="">
            </div>
            <div class="down-content">
              <h4>Tenaga Pendidik Yang Berkualitas</h4>
              <p>Guru-guru kami profesional, berpengalaman, dan berdedikasi dalam membimbing siswa.</p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{ asset('sd') }}/assets/images/service-icon-03.png" alt="">
            </div>
            <div class="down-content">
              <h4>Siswa Berkualitas</h4>
              <p>Mencetak generasi unggul dengan karakter kuat dan prestasi gemilang di berbagai bidang.</p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{ asset('sd') }}/assets/images/service-icon-02.png" alt="">
            </div>
            <div class="down-content">
              <h4>Pembelajaran yang Baik</h4>
              <p>Proses belajar mengajar yang interaktif, menyenangkan, dan berpusat pada kebutuhan siswa.</p>
            </div>
          </div>

          <div class="item">
            <div class="icon">
              <img src="{{ asset('sd') }}/assets/images/service-icon-03.png" alt="">
            </div>
            <div class="down-content">
              <h4>Koneksi Yang Luas</h4>
              {{-- Updated text for Koneksi Yang Luas --}}
              <p>Membangun jaringan kerjasama dengan orang tua, komunitas, dan institusi pendidikan lainnya.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="upcoming-meetings" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Informasi</h2>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="categories">
          <h4>Fasilitas {{ $config['app_name'] ?? 'sd' }}</h4>
          <ul>
            <li><a href="#">Ruang Kelas,</a></li>
            <li><a href="#">Perpustakaan</a></li>
            <li><a href="#">Laboratorium Komputer,</a></li>
            <li><a href="#">Lapangan Olahraga,</a></li>
            <li><a href="#">Mushola</a></li>
          </ul>
          <div class="main-button-red">
            <a href="#">Lihat Semua Fasilitas</a>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          @foreach ($berita as $item)
          <div class="col-lg-6">
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
      </div>
    </div>
  </div>
</section>

<section class="apply-now" id="apply">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="row">
          <div class="col-lg-12">
            <div class="item">
              <h3>Ayo Daftar Sekarang</h3>
              <p>Bergabunglah dengan kami! Segera lakukan pendaftaran untuk menjadi bagian dari keluarga besar {{ $config['app_name'] ?? 'sekolah kami' }}.</p>
              <div class="main-button-red">
                <div class="scroll-to-section"><a href="{{ url('/admin/register') }}">Lakukan Pendaftaran</a></div>
            </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="item">
              <h3>Sudah Punya Akun Ayo Login</h3>
              <p>Jika Anda sudah memiliki akun pendaftaran, silakan masuk untuk melanjutkan proses atau melihat status pendaftaran Anda.</p>
              <div class="main-button-yellow">
                <div class="scroll-to-section"><a href="{{ url('/admin/login') }}">Login</a></div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="accordions is-first-expanded">
          <article class="accordion">
              <div class="accordion-head">
                  <span>Fasilitas Belajar Modern</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Nikmati ruang kelas yang nyaman, perpustakaan dengan koleksi lengkap, dan laboratorium komputer terkini untuk mendukung proses belajar mengajar.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
              <div class="accordion-head">
                  <span>Lingkungan Sekolah Aman & Nyaman</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Kami menyediakan lingkungan yang kondusif dan aman bagi siswa untuk tumbuh dan berkembang, dilengkapi dengan area bermain dan fasilitas pendukung lainnya.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
              <div class="accordion-head">
                  <span>Kegiatan Ekstrakurikuler Beragam</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Siswa dapat mengembangkan bakat dan minat melalui berbagai pilihan ekstrakurikuler seperti seni, olahraga, pramuka, dan klub sains.</p>
                  </div>
              </div>
          </article>
          <article class="accordion last-accordion">
              <div class="accordion-head">
                  <span>Pengembangan Karakter & Moral</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Selain akademis, kami fokus pada pembentukan karakter siswa yang berakhlak mulia, disiplin, dan memiliki rasa tanggung jawab sosial.</p>
                  </div>
              </div>
          </article>
      </div>

      </div>
    </div>
  </div>
</section>

<section class="our-courses" id="courses">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Mata Pelajaran & Kegiatan Unggulan</h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="owl-courses-item owl-carousel">
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-01.jpg" alt="Mata Pelajaran Matematika">
            <div class="down-content">
              <h4>Matematika Menyenangkan</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-02.jpg" alt="Mata Pelajaran Bahasa Indonesia">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Bahasa Indonesia Kreatif</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$250</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-03.jpg" alt="Mata Pelajaran Ilmu Pengetahuan Alam">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Sains & Eksperimen Seru</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$400</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-04.jpg" alt="Kegiatan Olahraga">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Pendidikan Jasmani & Olahraga</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$480</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-01.jpg" alt="Kegiatan Seni Budaya">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Seni & Budaya</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$160</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-02.jpg" alt="Kegiatan Pramuka">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Kegiatan Pramuka</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$160</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-03.jpg" alt="Kegiatan Keagamaan">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Pendidikan Agama & Budi Pekerti</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$160</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-04.jpg" alt="Kegiatan Komputer">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Pengenalan Komputer</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$160</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('sd') }}/assets/images/course-01.jpg" alt="Kegiatan Bahasa Inggris">
            <div class="down-content">
              {{-- Changed course title --}}
              <h4>Bahasa Inggris Dasar</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                   {{-- Removed price span --}}
                  {{-- <div class="col-4">
                     <span>$160</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          {{-- You can add more items here following the same structure --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection