<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SoClose</title>
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>

<body>
  <!-- /* Please ❤ this if you like it! 😊 */ -->

  <!-- Portfolio Section Start -->
  <section class="portfolio overflow-hidden">
    <div class="container">
      <div class="row">
        <!-- Portfolio Section Heading -->
        <div class="portfolio__heading text-center col-12">
          <h1 class="portfolio__title fw-bold mb-5">Our Portfolio</h1>
        </div>
        <!-- Portfolio Navigation Buttons List -->
        <div class="col-12">
          <ul class="portfolio__nav nav justify-content-center mb-4">
            <li class="nav-item">
              <button class="portfolio__nav__btn position-relative bg-transparent border-0 active"
                data-filter="*">All</button>
            </li>
            <li class="nav-item">
              <button class="portfolio__nav__btn position-relative bg-transparent border-0"
                data-filter=".vehicle">Vehicle</button>
            </li>
            <li class="nav-item">
              <button class="portfolio__nav__btn position-relative bg-transparent border-0"
                data-filter=".animal">Animal</button>
            </li>
            <li class="nav-item">
              <button class="portfolio__nav__btn position-relative bg-transparent border-0"
                data-filter=".work-station">Work Station</button>
            </li>

            @auth
              <li>
                <div class="dropdown ">
                  <button class="dropdown-toggle btn btn-success" type="button" data-toggle="dropdown"
                    aria-expanded="false">
                    {{ Auth::user()->name }}
                  </button>
                  <div class="dropdown-menu ">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                      {{ __('Logout') }}

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </div>
              </li>
            @else
              @if (Route::has('login'))
                <li class="" style="margin-right: 5px">
                  <a class="btn btn-success " href="{{ route('login') }}">Login</a>
                </li>
              @endif

              @if (Route::has('register'))
                <li class="scroll-to-section">
                  <a class="btn btn-success " href="{{ route('register') }}">Register</a>
                </li>
              @endif
            @endauth
          </ul>
        </div>
      </div>
      <!-- Portfolio Cards Container -->

      <div class="row grid">
        {{-- @foreach ($allPortfolios as $portfolio)
          <div class="grid-item col-lg-4 col-sm-6 *">
            <a href="#!" class="portfolio__card position-relative d-inline-block w-100">
              <img src="{{ asset('storage/portfolio/' . $portfolio->photo) }}" alt="Random Image" class="w-100">
            </a>
          </div>
        @endforeach    --}}
        
        
        @foreach ($vehicles as $vehicle)
        <div class="grid-item col-lg-4 col-sm-6 vehicle">
          <a href="#!" class="portfolio__card position-relative d-inline-block w-100">
            
							<img src="{{ asset('storage/portfolio/' . $vehicle->photo) }}" alt="Random Image" class="w-100">
						
          </a>
        </div>
				@endforeach
        @foreach ($animals as $animal)
          
        <div class="grid-item col-lg-4 col-sm-6 animal">
          <a href="#!" class="portfolio__card position-relative d-inline-block w-100">
            <img src="{{ asset('storage/portfolio/' . $animal->photo) }}" alt="Random Image" class="w-100">
          </a>
        </div>
        @endforeach
        @foreach ($workstations as $workstation)          
        <div class="grid-item col-lg-4 col-sm-6 work-station">
          <a href="#!" class="portfolio__card position-relative d-inline-block w-100">
            <img src="{{ asset('storage/portfolio/' . $workstation->photo) }}" alt="Random Image" class="w-100">
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Portfolio Section End -->
  <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
</body>

</html>
