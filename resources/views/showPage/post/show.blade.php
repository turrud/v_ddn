@extends('layout.main')

@section('title', 'News')


@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $post->gambar }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $post->nama }}</h5>
                    <p style="text-align: justify" class="card-text">{{ $post->deskripsi }}</p>
                    <p class="text-end card-text"><small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-end berubah mx-2">
        <a class="berubah" href="/news"><i class="bi bi-box-arrow-left"></i></a>
    </div>
</div>
@endsection
