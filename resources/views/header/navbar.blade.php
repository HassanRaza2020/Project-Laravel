<meta http-equiv="Content-Security-Policy" content="script-src 'self' 'wasm-unsafe-eval' 'inline-speculation-rules' chrome-extension://c396d347-023a-4f99-a045-d63d8f281cbb;">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="#">
      <img src="https://cdn.pixabay.com/photo/2012/04/02/16/13/question-24851_640.png" alt="Brand Logo">
    </a>

    <!-- Button for toggling the navbar in mobile view -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active anchorColor" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>

        @if(session('username'))
          <!-- Display username and logout when logged in -->
           
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"> {{ session('username') }} Logout</a>
          </li>
          @csrf
        @else
          <!-- Show login and signup when logged out -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('signup') }}">Sign Up</a>
          </li>
        @endif

        @if(session('username'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('askquestion') }}">Ask A Question</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ route('latestquestion') }}">Latest Questions</a>
        </li>
      </ul>
    </div>

    <form class="d-flex" action="{{ route('searchquestion') }}" method="GET">
      <input class="form-control-nav" name="search_bar" type="search" placeholder="Search questions">
      <button class="btn-outline-success" name="search" type="submit">Search</button>
    </form>
  </div>
</nav>
