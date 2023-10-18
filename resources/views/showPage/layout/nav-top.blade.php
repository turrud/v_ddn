<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img class="img-fluid " loading="lazy" src="{{ asset('images/icon-logo/logo.png') }}" alt="logo-danajaya-design" width="80" height="80">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link  {{ Request::is('/') ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about') }}" class="nav-link {{ Request::is('about*') ? 'active' : '' }}">About</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('store') }}" class="nav-link {{ Request::is('store*') ? 'active' : '' }}">Store</a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ route('service') }}/architecture" class="nav-link {{ Request::is('service*') ? 'active' : '' }}">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('news*') ? 'active' : '' }}" href="/news">News</a>
          </li>
        <li class="nav-item">
          <a href="{{ route('contact') }}/service" class="nav-link {{ Request::is('contact*') ? 'active' : '' }}">Contact Us</a>
        </li> --}}
      </ul>
    </div>
  </div>
</nav>

