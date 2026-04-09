@extends('layouts.admin')
@section('admincontent')

  <div class="main-content">
    <section class="section">

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Home Page Banner</h4>
            </div>
            <div class="card-body">


              <div>

                <form action="/bannersave" method="post" enctype="multipart/form-data">
                  <!-- Add CSRF Token -->
                  @csrf
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="name" required>
                  </div>
                  <div class="form-group">
                    <input type="file" name="file" required class="form-control">
                  </div>
                  <button class="btn btn-primary" type="submit">Submit</button>
                </form>

              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Users & Tests </h4>
            </div>
            <div class="card-body">
              <img src="{{ asset('storage/banner/' . $banner ?? '') }}" class="banneradmin"></a>
            </div>
          </div>
        </div>


      </div>

    </section>
  </div>
  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; 2020 <div class="bullet"></div> Design By <a href="#">Ooisolutions</a>
    </div>
    <div class="footer-right">

    </div>
  </footer>
  </div>
  </div>

  <script src="{{asset('admin/js/page/index-0.js')}}"></script>

@endsection