<div class="container mt-1">
  <div class="row ">
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('architecture') }}" {{ Request::is('architecture') ? 'active' : '' }}">Architecture</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('interiorDesign') }}" {{ Request::is('service/interior-design') ? 'active' : '' }}">Interior Design</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('interiorPublic') }}" {{ Request::is('service/interior-public') ? 'active' : '' }}">Interior Public</a></li>
      </ul>
    </div>
    <div class="col navbar">
      <ul class="list-group navbar-nav">
        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('boothDesign') }}" {{ Request::is('service/booth-design') ? 'active' : '' }}">Booth Design</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('virtualOffice') }}" {{ Request::is('service/virtual-office') ? 'active' : '' }}">Virtual Office</a></li>

        <li class="list-group-item nav-item"><a class="nav-link" href="{{ route('weddingDecoration') }}" {{ Request::is('service/wedding-decoration') ? 'active' : '' }}">Wedding Deccoration</a></li>
      </ul>
    </div>
  </div>
</div>


<hr class="container">
