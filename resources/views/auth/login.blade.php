@extends('layouts.app')
@section('content')
<body class="">
    <main class="main-content mt-0">
      <section>
        <div class="page-header min-vh-75">
          <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                  <div class="card-header pb-0 text-left bg-transparent">
                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                    <p class="mb-0">Enter your email and password to sign in</p>
                  </div>
                  <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="text-danger text-center text-bold">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" class="md-float-material">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email" id="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" id="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Log in</button>
                        </div>
                    </form>
                  </div>
                  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                      Don't have an account?
                      <a href="{{route('register')}}" class="text-info text-gradient font-weight-bold">Sign up</a>
                    </p>
                    <p>
                      <a class="font-bold" href=" ">Forgot password?</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                  <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../asetbaru/assets/img/curved-images/curved6.jpg')"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-4 mx-auto text-center">
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Company</a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">About Us</a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Team</a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Products</a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Blog</a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">Pricing</a>
          </div>
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-dribbble"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-twitter"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-instagram"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-pinterest"></span>
            </a>
            <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
              <span class="text-lg fab fa-github"></span>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>document.write(new Date().getFullYear())</script> Soft by Creative Tim.
            </p>
          </div>
        </div>
      </div>
    </footer>

@endsection
