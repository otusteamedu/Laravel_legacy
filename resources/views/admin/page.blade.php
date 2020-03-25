<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head.head')
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.index.index')}}">Admin panel</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{route('logout')}}" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            >Sign out</a>
        </li>
      </ul>
</nav>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            @include('admin.head.nav')
        </div>
        @yield('contentWrap')
    </div>
</div>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
</body>
</html>