<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="/images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">David Grey. H</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        @foreach($menu as $item)
            <li class="nav-item">
                <a class="nav-link" href="{{$item->url}}">
                    <span class="menu-title">{{$item->title}}</span>
                    <i class="mdi {{$item->cssClass}} menu-icon"></i>
                </a>
            </li>
        @endforeach

        <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <a href="{{route('lang-constructor-type-edit')}}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ {{trans('menu.add-constr')}}</a>
              </span>
        </li>
    </ul>
</nav>
