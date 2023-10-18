<div class="container mt-1">
  <div class="row ">
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('profile') }}" {{ Request::is('about/profile') ? 'active' : '' }}">Profile</a></li>
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('people') }}" {{ Request::is('about/people') ? 'active' : '' }}">People</a></li>
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('design-method') }}" {{ Request::is('about/design-method') ? 'active' : '' }}">Design Method</a></li>
      </ul>
    </div>
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('event') }}" {{ Request::is('about/event') ? 'active' : '' }}">Event</a></li>
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('client') }}" {{ Request::is('about/client') ? 'active' : '' }}">Client</a></li>
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('award') }}" {{ Request::is('about/award') ? 'active' : '' }}">Award</a></li>
      </ul>
    </div>
  </div>
</div>


<hr class="container">
