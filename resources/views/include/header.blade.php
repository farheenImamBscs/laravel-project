<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
{{--                without credentials, login sain phlain jo user dekh skhain woh guest mai--}}
                @guest()
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('register')}}">Registration</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('login')}}">login</a>
                    </li>
                @endguest

                @auth()
                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="POST">
                            <button class="btn btn-link nav-link" type="submit">logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
