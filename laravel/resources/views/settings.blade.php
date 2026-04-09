@extends('layouts.admin')
@section('admincontent')

  <div class="main-content" style="min-height: 586px;">
    <section class="section">
      <div class="section-header">
        <h1>General Settings</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">General Settings</div>
        </div>
      </div>

      <div class="section-body">

        <p class="section-title">Adjust all general settings here.</p>

        <div id="output-status"></div>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4>Jump To</h4>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item"><a href="/admin/settings" class="nav-link active">General</a></li>
                  <li class="nav-item"><a href="/admin/feeupdate" class="nav-link">Fee Amount</a></li>

                </ul>
              </div>
            </div>
          </div>
          @if (!$settings)
            <div class="col-md-8">
              <form action="/admin/settings" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>General Settings</h4>
                  </div>
                  <div class="card-body">
                    <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                    <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                      <div class="col-sm-6 col-md-9">
                        <input type="text" name="site_title" class="form-control" id="site-title">
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site
                        Description</label>
                      <div class="col-sm-6 col-md-9">
                        <textarea class="form-control" name="site_description" id="site-description"></textarea>
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                      <div class="col-sm-6 col-md-9">
                        <div class="custom-file">
                          <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                          <label class="custom-file-label">Choose File</label>
                        </div>
                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                      <div class="col-sm-6 col-md-9">
                        <div class="custom-file">
                          <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
                          <label class="custom-file-label">Choose File</label>
                        </div>
                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-control-label col-sm-3 mt-3 text-md-right">Google Analytics Code</label>
                      <div class="col-sm-6 col-md-9">
                        <textarea class="form-control codeeditor" name="google_analytics_code"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Save Changes</button>

                  </div>
                </div>
              </form>
            </div>

          @else
            <div class="col-md-8">
              <form action="/admin/settings" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card" id="settings-card">
                  <div class="card-header">
                    <h4>General Settings</h4>
                  </div>
                  <div class="card-body">
                    <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                    <div class="form-group row align-items-center">
                      <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                      <div class="col-sm-6 col-md-9">
                        <input type="text" name="site_title" class="form-control" id="site-title"
                          value="{{ $settings->title }}">
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site
                        Description</label>
                      <div class="col-sm-6 col-md-9">
                        <textarea class="form-control" name="site_description"
                          id="site-description">{{ $settings->description }}</textarea>
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <div class="col-12">
                        <img src="{{ asset('storage/blogassets/' . $settings->logo ?? '') }}" alt="logo" class="img-fluid">
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                      <div class="col-sm-6 col-md-9">
                        <div class="custom-file">
                          <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                          <label class="custom-file-label">Choose File</label>
                        </div>
                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <div class="col-12">
                        <img src="{{ asset('storage/blogassets/' . $settings->favicon ?? '') }}" alt="favicon"
                          class="img-fluid">
                      </div>
                    </div>
                    <div class="form-group row align-items-center">
                      <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                      <div class="col-sm-6 col-md-9">
                        <div class="custom-file">
                          <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
                          <label class="custom-file-label">Choose File</label>
                        </div>
                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-control-label col-sm-3 mt-3 text-md-right">Google Analytics Code</label>
                      <div class="col-sm-6 col-md-9">
                        <textarea class="form-control codeeditor"
                          name="google_analytics_code">{{ $settings->gacode }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-whitesmoke text-md-right">
                    <button class="btn btn-primary" id="save-btn">Save Changes</button>

                  </div>
                </div>
              </form>
            </div>
          @endif
        </div>
      </div>



  </div>
  </section>
  </div>

  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Ooisolutions</a>
    </div>
    <div class="footer-right">
      2.3.0
    </div>
  </footer>
  </div>
  </div>





@endsection