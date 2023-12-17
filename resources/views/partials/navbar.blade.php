<nav class="navbar navbar-expand-lg bg-light border-bottom ">
    <div class="container py-1">
        <a class="navbar-brand text-primary fw-bold" href="/"><i class="bi bi-trello"></i>MyTasks</a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-primary" href="/">HOME</a>
                </li>

                @php
                    $userId = Auth::user()->id
                @endphp
                <li class="nav-item">
                    <a class="nav-link active text-primary" href="/boards/{{ $userId }}">BOARDS</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        STARRED
                    </a>
                    <ul class="dropdown-menu">
                        @php
                            $starredBoards = Auth::user()->boards->where('starred', true);
                        @endphp
                
                        @forelse ($starredBoards as $board)
                            <li><a href="/board/{{ $board->slug }}" class="dropdown-item text-decoration-none">{{ $board->title }}</a></li>
                        @empty
                            <li><a class="dropdown-item text-decoration-none" href="#">No starred boards available</a></li>
                        @endforelse
                    </ul>
                </li>
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