@extends('showPage.layout.main')

@section('title', '3D Furniture')

@section('content')
@include('showPage.layout.nav-store')
@include('showPage.layout.nav-store-buttom')

{{-- content --}}
{{-- <div class="container py-5  ">
    <div class="container">
        <div class="row g-0 justify-content-center">
            @foreach ($store as $store)
            <div class="col-md-3">
                <div class=" mx-auto">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $store->image ? \Storage::url($store->image) : '' }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ \Storage::url($store->file) }}"><i class="bi bi-arrow-down-circle">&nbsp;</i>Buy</a>
                                </div>
                                <div class="col-6">
                                    <p class="card-text">Price: {{ $store->price }}</p>
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title">{{ $store->name }}</h5>
                            <p class="card-text">{{ $store->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div> --}}

<div class="container py-5">
        <div class="container">
            <div class=" mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-4 ">Your Vision, Our Expertise</h1>
            </div>
            <div class="row g-0 team-items ">
                @foreach ($store as $store)
                <div class="col-md-3 wow fadeInUp mx-1 mb-1" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <a href="/abs">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ $store->image ? \Storage::url($store->image) : '' }}" alt="item">
                            </div>
                        </a>
                        <div class="bg-light  p-4">
                            <h3 class="mt-2 fo">{{ $store->name }}</h3>
                            <span class=" j">{{ $store->description }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>







{{-- end content --}}

@endsection

