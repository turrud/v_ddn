@extends('layout.main')

@section('title', 'News')

@section('content')
  <div class="container">
    <div class="display-5 text-center mb-5">
        <h4 class="section-title ">"Breaking News"</h4>
        <h1 class="display-6 mb-4 ">Turning Dreams into Homes - Your Vision, Our Expertise</h1>
    </div>
    <div class="row">
        @foreach ($posts as $post )
        <div class="col-md-4 ">
            <div class="card-group wow fadeInUp" data-wow-delay="0.1s">
                <div class=" mb-3">
                    <a href="/news/{{ $post->id }}">
                        <img src="{{ $post->gambar }}" class="card-img-top" alt="{{ $post->nama }}">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title mb-4 mt-2">{{ $post->nama }}</h5>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center mb-5">
                        <div>
                            <small class="text-body-secondary">Last updated {{ $post->updated_at->diffForHumans() }}</small>
                        </div>
                        <div class="berubah">
                            <a class="berubah" href="/news/{{ $post->id }}">
                                <i class="bi bi-book-half"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
@endsection
