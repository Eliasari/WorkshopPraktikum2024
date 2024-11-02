
@extends('layouts.app')
@section('content')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Sign Up</h3>
                  <p class="mb-0">Input your data to register to our website.</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_user">Nama</label>
                        <input type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{ old('nama_user') }}" placeholder="Enter Your Name">
                        @error('nama_user')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>

                    <div class="mb-3">
                      <label for="username">Username</label>
                      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Enter Your Username">
                      @error('username')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                      <label for="password">Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Choose Password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-info text-gradient font-weight-bold">Login</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{ asset('asetbaru/assets/img/curved-images/curved6.jpg') }}')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
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
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4"><span class="text-lg fab fa-dribbble"></span></a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4"><span class="text-lg fab fa-twitter"></span></a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4"><span class="text-lg fab fa-instagram"></span></a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4"><span class="text-lg fab fa-pinterest"></span></a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4"><span class="text-lg fab fa-github"></span></a>
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

