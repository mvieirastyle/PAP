<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-paw"></i> {{__('front_end.header.project_name')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">{{__('front_end.header.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">{{__('front_end.header.about')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/gallery">{{__('front_end.header.adopt')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/relevance">{{__('front_end.header.relevance')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">{{__('front_end.header.contact')}}</a>
                </li>
                @auth
                @if (Auth::user()->admin)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle rounded-pill" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#1c5530">
                        <i class="fas fa-cogs"></i> Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">{{__('front_end.header.edit_profile')}}</a></li>
                        <li><a class="dropdown-item" href="/admin/">Area Reservada</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle rounded-pill" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#3CAE63">
                        <i class="fas fa-user"></i> {{__('front_end.header.hello')}} {{Auth::user()->first_name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">{{__('front_end.header.edit_profile')}}</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
                @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                @endauth
                <li class="nav-item dropdown ms-2">
                    <a href="#" class="nav-link btn btn-lg btn-orange px-2 rounded-pill dropdown" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <x-heroicon-o-language style="width:23px; height:23px;" />
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/language/en">en</a></li>
                        <li><a class="dropdown-item" href="/language/pt">pt</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>