<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
      <!-- Branding -->
      <a class="navbar-brand" href="/">Harbor<span>lights</span></a>

      <!-- Toggler for mobile view -->
      <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#ftco-nav" 
          aria-controls="ftco-nav" 
          aria-expanded="false" 
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
              <li class="nav-item">
                  <a class="nav-link active" href="/">Home</a>
              </li>
              
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('bookings.index') }}">Book Lab</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('my-bookings') }}">My Bookings</a>
              </li>
          </ul>
          <div class="d-flex">
              @auth
                  <div class="dropdown">
                      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" 
                              data-bs-toggle="dropdown" aria-expanded="false">
                          {{ Auth::user()->name }}
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li>
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <button type="submit" class="dropdown-item">Logout</button>
                              </form>
                          </li>
                      </ul>
                  </div>
              @else
                  <a href="{{ route('login') }}" class="btn btn-light me-2">Login</a>
                  <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
              @endauth
          </div>
      </div>
  </div>
</nav>
