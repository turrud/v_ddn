<div class="container mt-1">
  <div class="row ">
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('3d-furniture') }}" {{ Request::is('store/3d-furniture') ? 'active' : '' }}">3D Furniture</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('3d-architecture') }}" {{ Request::is('store/3d-architecture') ? 'active' : '' }}">3D Architecture</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('3d-booth') }}" {{ Request::is('store/3d-booth') ? 'active' : '' }}">3D Booth</a></li>
      </ul>
    </div>
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('furniture') }}" {{ Request::is('store/furniture') ? 'active' : '' }}">Furniture</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('decoration') }}" {{ Request::is('store/decoration') ? 'active' : '' }}">Decoration</a></li>
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('florist') }}" {{ Request::is('store/florist') ? 'active' : '' }}">Florist</a></li>
      </ul>
    </div>
  </div>
</div>


<hr class="container">
