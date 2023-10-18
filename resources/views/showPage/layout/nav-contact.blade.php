<div class="container mt-1">
  <div class="row ">
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('c-service') }}" {{ Request::is('service') ? 'active' : '' }}">Service</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('partner') }}" {{ Request::is('contact/partner') ? 'active' : '' }}">Partner</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('invest') }}" {{ Request::is('contact/invest') ? 'active' : '' }}">Invest Us</a></li>
      </ul>
    </div>
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('course') }}" {{ Request::is('contact/course') ? 'active' : '' }}">Courses</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('freelance') }}" {{ Request::is('contact/freelance') ? 'active' : '' }}">Freelance</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('donation') }}" {{ Request::is('contact/donation') ? 'active' : '' }}">Donation</a></li>
      </ul>
    </div>
  </div>
</div>


<hr class="container">
