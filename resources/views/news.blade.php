<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>World Time</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="{{asset('')}}world-time/assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="{{asset('')}}world-time/assets/vendors/aos/dist/aos.css/aos.css" />

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="{{asset('')}}world-time/assets/images/favicon.png" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('')}}world-time/assets/css/style.css">
    <!-- endinject -->
      <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('')}}adminlte/plugins/fontawesome-free/css/all.min.css">
  <style>
    a {
      text-decoration: none;
      color: inherit
    }
    a:link {
        text-decoration: none;
        scroll-behavior: smooth;
    }
    a:hover {
        text-decoration: none;
    }
  </style>
  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        <header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="navbar-top">
              </div>
              <div class="navbar-bottom">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <a class="navbar-brand" href="{{url('/')}}"
                      ><img src="{{asset('')}}world-time/assets/images/logo.svg" alt=""
                    /></a>
                  </div>
                  <div>
                    <button
                      class="navbar-toggler"
                      type="button"
                      data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent"
                      aria-expanded="false"
                      aria-label="Toggle navigation"
                    >
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                      class="navbar-collapse justify-content-center collapse"
                      id="navbarSupportedContent"
                    >
                      <ul
                        class="navbar-nav d-lg-flex justify-content-between align-items-center"
                      >
                        <li>
                          <button class="navbar-close">
                            <i class="mdi mdi-close"></i>
                          </button>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        @foreach ($category as $item)
                          <li class="nav-item">
                            <a class="nav-link" href="#{{$item->category}}">{{$item->category}}</a>
                          </li>
                        @endforeach 
                      </ul>
                    </div>
                  </div>
                  <ul class="social-media">
                    <li>
                      @if (!Auth::check())
                      <a href="{{route('login')}}">
                        <i class="far fa-user"></i>
                      </a>
                      @endif
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </header>

        <div class="content-wrapper">
          <div class="container">
            <div class="row" data-aos="fade-up">
              <div class="col-xl-8 stretch-card grid-margin">
                <div class="position-relative">
                  <img
                    src="{{asset($recent->image)}}"
                    alt="banner"
                    class="img-fluid"
                  />
                  <div class="banner-content">
                    @foreach (unserialize($recent->category) as $item)
                      <div class="badge badge-info fs-12 font-weight-bold mb-3">
                        {{$item}}
                      </div>
                    @endforeach
                    <a href="{{url('read/'.$recent->id)}}">
                      <h1 class="mb-2">
                        {{$recent->title}}
                      </h1>
                    </a>
                    <div class="fs-12">
                      <span class="mr-2">{{date('D, d-M-Y', strtotime($recent->created_at))}} </span>{{date('h:i', strtotime($recent->created_at))}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 stretch-card grid-margin">
                <div class="card bg-dark text-white">
                  <div class="card-body">
                    <h2>Latest news</h2>
                    @foreach ($latest as $item)
                    <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                      <div class="pr-3">
                        <a href="{{url('read/'.$item->id)}}">
                          <h5>{{$item->title}}</h5>
                        </a>
                        <div class="fs-12">
                          <span class="mr-2">{{date('D, d-M-Y', strtotime($item->created_at))}} </span>{{date('h:i', strtotime($item->created_at))}}
                        </div>
                      </div>
                      <div class="rotate-img">
                        <img
                          src="{{asset($item->image)}}"
                          alt="thumb"
                          class="img-fluid img-lg"
                        />
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-lg-3 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h2>Category</h2>
                    <ul class="vertical-menu">
                      @foreach ($category as $item)
                        <li><a href="#{{$item->category}}">{{$item->category}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-9 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h2>Most Viewed</h2>
                    @foreach ($view as $item)
                      <div class="row">
                        <div class="col-sm-4 grid-margin">
                          <div class="position-relative">
                            <div class="rotate-img">
                              <img
                                src="{{asset($item->image)}}"
                                alt="thumb"
                                class="img-fluid"
                              />
                            </div>
                            <div class="badge-positioned">
                              @foreach (unserialize($item->category) as $cat)
                              <span class="badge badge-info font-weight-bold">{{$cat}}</span>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-8  grid-margin">
                          <a href="{{url('read/'.$item->id)}}">
                            <h2 class="mb-2 font-weight-600">
                              {{$item->title}}
                            </h2>
                          </a>
                          <div class="fs-13 mb-2">
                            <span class="mr-2">{{date('D, d-M-Y', strtotime($item->created_at))}} </span>{{date('h:i', strtotime($item->created_at))}}
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <?php $row = 0?>
            @foreach ($allCat as $item)
                @if ($row == 0)
                <div class="row mt-5" data-aos="fade-up">
                  <div class="col-sm-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                @endif

                <div class="col-lg-4" id="{{$item->category}}">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title">
                      {{$item->category}}
                    </div>
                  </div>
                  <?php $count = 0?>
                  @foreach ($content as $con)
                    <?php $found = false?>
                      @foreach (unserialize($con->category) as $unCat)
                        @if ($unCat == $item->category)
                            <?php $found = true?>
                        @endif   
                      @endforeach

                      @if (($found) && ($count < 5))
                          <?php $count++?>
                          <div class="d-flex justify-center align-items-center border-bottom pb-2">
                            <div class="div-w-80 mr-3">
                              <div class="rotate-img">
                                <img
                                  src="{{asset($con->image)}}"
                                  alt="thumb"
                                  class="img-fluid"
                                />
                              </div>
                            </div>
                            <div class="">
                              <a href="{{url('read/'.$con->id)}}">
                                <p class="fs-16 font-weight-600 mb-0">
                                  {{$con->title}}
                                </p>
                              </a>
                              <p class="fs-13 text-muted mb-0">
                                <span class="mr-2">{{date('D, d-M-Y', strtotime($con->created_at))}} </span>{{date('h:i', strtotime($con->created_at))}}
                              </p>
                            </div>
                          </div>
                      @endif
                  @endforeach
                </div>

                <?php $row++?>

                @if ($row == 3)
                    <?php $row = 0?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endforeach
            @if ($row <= 3)
                <?php $row = 0?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

          </div>
        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
        <footer>
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-sm-5">
                  <img src="{{asset('')}}world-time/assets/images/logo.svg" class="footer-logo" alt="" />
                  <h5 class="font-weight-normal mt-4 mb-5">
                    Newspaper is your news, entertainment, music fashion website. We
                    provide you with the latest breaking news and videos straight from
                    the entertainment industry.
                  </h5>
                </div>
                <div class="col-sm-4">
                  <h3 class="font-weight-bold mb-3">RECENT POSTS</h3>
                  @foreach ($latest as $item)
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="footer-border-bottom pb-2">
                        <div class="row">
                          <div class="col-3">
                            <img
                              src="{{asset($item->image)}}"
                              alt="thumb"
                              class="img-fluid"
                            />
                          </div>
                          <div class="col-9">
                            <a href="{{url('read/'.$item->id)}}">
                              <h5 class="font-weight-600">
                                {{$item->title}}
                              </h5>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <div class="col-sm-3">
                  <h3 class="font-weight-bold mb-3">CATEGORIES</h3>
                  <?php $catCount = 0?>
                  @foreach ($allCat as $item)
                      @if ($catCount < 5)
                        <a href="#{{$item->category}}" class="">
                          <div class="footer-border-bottom pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                              <h5 class="mb-0 font-weight-600">{{$item->category}}</h5>
                            </div>
                          </div>
                        </a>
                      @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </footer>

        <!-- partial -->
      </div>
    </div>
    <!-- inject:js -->
    <script src="{{asset('')}}world-time/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{asset('')}}world-time/assets/vendors/aos/dist/aos.js/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{asset('')}}world-time/assets/js/demo.js"></script>
    <script src="{{asset('')}}world-time/assets/js/jquery.easeScroll.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
  