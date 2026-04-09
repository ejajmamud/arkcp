
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
                  <li class="nav-item"><a href="settings.php" class="nav-link">General</a></li>
                  <li class="nav-item"><a href="update-fee.php" class="nav-link active">Fee Amount</a></li>

                </ul>
              </div>
            </div>
          </div>
          @if ( !$feeamount)
         <div class="col-md-8">
            <form action="/admin/feeupdate" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card" id="settings-card">
                <div class="card-header">
                  <h4>Set Exam Fee Price</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="site-feeamount" class="form-control-label col-sm-3 text-md-right">Fee Price45</label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="feeamount" class="form-control" id="site-feeamount">
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
            <form action="/admin/feeupdate" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card" id="settings-card">
                <div class="card-header">
                  <h4>Set Exam Fee Price</h4>
                </div>
                <div class="card-body">
                  <div class="form-group row align-items-center">
                    <label for="site-feeamount" class="form-control-label col-sm-3 text-md-right">Fee Price (USD)</label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="feeamount" class="form-control" id="site-feeamount" value="{{$feeamount}}">
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="site-feerm" class="form-control-label col-sm-3 text-md-right">Fee Price (RM)</label>
                    <div class="col-sm-6 col-md-9">
                      <input type="text" name="feerm" class="form-control" id="site-feerm" value="{{$feerm}}">
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
