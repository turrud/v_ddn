@extends('showPage.layout.main')

@section('title', 'About - people')

@section('content')
@include('showPage.layout.nav-about')
<!-- Team Start -->
    <div class="container py-5 text-center">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title ">Team Members</h4>
                <h1 class="display-5 mb-4 ">Turning Dreams into Homes Your Vision, Our Expertise</h1>
            </div>
            <div class="row g-0 team-items justify-content-center">
                @foreach ($people as $people)
                <div class="col-md-2 wow fadeInUp mx-1 mb-1" data-wow-delay="0.1s">

                    <div class="team-item position-relative">
                        <a href="/abs">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ $people->image }}" alt="image-team">
                            </div>
                        </a>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2 fo">{{ $people->name }}</h3>
                            <span class=" j">{{ $people->jabatan }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
<!-- Team End -->
@endsection
