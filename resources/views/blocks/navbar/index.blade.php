<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Recipe book</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('navs.category')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('navs.recipes.value')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.ratings.authors')}}">{{__('navs.authors')}}</a>
                </li>
                <li class="nav-item dropdown ml-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        my menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{route('cms.author.recipes.index','sasha')}}">{{__('navs.recipes.book')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{route('cms.author.index','sasha')}}">{{__('navs.personal-account')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">{{__('navs.logout')}}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{route('cms.author.recipes.create','sasha')}}">{{__('navs.recipes.add')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"
                       href="{{route('cms.auth.login.index')}}">{{__('navs.login')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
