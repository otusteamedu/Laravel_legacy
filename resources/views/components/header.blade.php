<nav class="cyan">
    <div class="container">
        <div class="row nav-wrapper">
            <div class="col s12">
                <a href="/" class="brand-logo">Logo</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ route('master.record.list') }}">Записи</a></li>
                <li><a href="{{ route('master.user.list') }}">Клиенты</a></li>
            </ul>

            <a href="#" data-target="slide-out" class="sidenav-trigger right">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li>
        <a href="{{ route('master.record.list') }}" class="collapsible-header waves-effect waves-blue">
            <i class="material-icons">people</i>
            Записи
        </a>
    </li>
    <li>
        <a href="{{ route('master.user.list') }}" class="collapsible-header waves-effect waves-blue">
            <i class="material-icons">format_list_bulleted</i>
            Клиенты
        </a>
    </li>
</ul>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        M.Sidenav.init(
            document.querySelectorAll('.sidenav'),
            {'edge': 'right'}
        );
    });
</script>
