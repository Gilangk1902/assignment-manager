<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand text-light" href="/">Assigment Manager</a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Boards
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($boards as $board)
                            <li><a href="/board/{{ $board->slug }}" class="dropdown-item text-decoration-none">{{ $board->title }}</a></li>
                        @endforeach

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/make_new_board">Create new Board</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Starred
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex" >
                @guest
                    <a href="/login" class="btn btn-primary me-2">Login</a>
                    <a href="/register" class="btn btn-primary me-2">Register</a>
                @else
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
                </form>
                @endguest
            </div>
            
        </div>
    </div>
</nav>