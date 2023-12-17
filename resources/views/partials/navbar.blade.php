<nav class="navbar navbar-expand-lg bg-light border-bottom ">
    <div class="container py-1">
        <a class="navbar-brand text-primary fw-bold" href="/"><i class="bi bi-trello"></i>MyTasks</a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-primary" href="/">HOME</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        BOARDS
                    </a>
                    
                    <ul class="dropdown-menu">
                        @forelse (Auth::user()->boards as $board)
                            <li><a href="/board/{{ $board->slug }}" class="dropdown-item text-decoration-none">{{ $board->title }}</a></li>
                        @empty
                            <li><a class="dropdown-item text-decoration-none" href="#">No boards available</a></li>
                        @endforelse
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/make_new_board">Create new Board</a></li>
                    </ul>
                </li>
                
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Starred
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </li> --}}
            </ul>
            @endauth
        
            <div class="d-flex ms-auto"> <!-- Use ms-auto to push the content to the right -->
                @guest
                    <a href="/login" class="btn btn-primary rounded-pill px-4 py-2">Login</a>
                    
                @else
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="btn btn-primary rounded-pill px-4 py-2">Logout</a>
                </form>
                @endguest
            </div>
        </div>
    </div>
</nav>