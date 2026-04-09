
@extends('layouts.admin')
@section('admincontent')

<div class="main-content">
    <section class="section">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card card-statistic-2">

            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Users</h4>
              </div>
              <div class="card-body">
                {{ $users }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card card-statistic-2">

            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Income (USD)</h4>
              </div>
              <div class="card-body">
                {{$income}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card card-statistic-2">

            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-file-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Income (MYR)</h4>
              </div>
              <div class="card-body">
                {{$incomeRm}}
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card card-statistic-2">

            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-file-contract"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Completed Tests</h4>
              </div>
              <div class="card-body">
                {{$completedTests->count()}}
              </div>
            </div>
          </div>
        </div>
        
      </div>

      <div class="row">
        

        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Users </h4>
            </div>
            <div class="card-body">
              <canvas id="usersChart" height="158"></canvas>
            </div>
          </div>
        </div>
        
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Tests </h4>
            </div>
            <div class="card-body">
              <canvas id="testsChart" height="158"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Sales</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart" height="108"></canvas>
            </div>
          </div>
        </div>

      </div>

    <!--  <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Invoices</h4>
              <div class="card-header-action">
                <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    <td><a href="#">INV-87239</a></td>
                    <td class="font-weight-600">Kusnadi</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 19, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-48574</a></td>
                    <td class="font-weight-600">Hasan Basri</td>
                    <td><div class="badge badge-success">Paid</div></td>
                    <td>July 21, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-76824</a></td>
                    <td class="font-weight-600">Muhamad Nuruzzaki</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-84990</a></td>
                    <td class="font-weight-600">Agung Ardiansyah</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-87320</a></td>
                    <td class="font-weight-600">Ardian Rahardiansyah</td>
                    <td><div class="badge badge-success">Paid</div></td>
                    <td>July 28, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div> -->



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

<script type="text/javascript">
    var statistics_chart = document.getElementById("myChart").getContext('2d');
    var data = <?php echo $datausd; ?>;
var myChart = new Chart(statistics_chart, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [{
      label: 'USD',
      data: <?php echo $datausd ?? ''; ?>,
      borderWidth: 5,
      borderColor: '#e9ea61',
      backgroundColor: '#e9ea61',
      pointBackgroundColor: '#55c6cc',
      pointBorderColor: '#55c6cc',
      pointRadius: 4
    }, {
        label: 'RM',
      data: <?php echo $datarm ?? ''; ?>,
      borderWidth: 5,
      borderColor: '#2FAC36',
      backgroundColor: '#2FAC36',
      pointBackgroundColor: '#55c6cc',
      pointBorderColor: '#55c6cc',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 5
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});







var usersChartDom = document.getElementById("usersChart").getContext('2d');
var usersChartInit = new Chart(usersChartDom, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [{
      label: 'Users',
      data: <?php echo $usersChartData ?? ''; ?>,
      borderWidth: 5,
      borderColor: '#3b929d',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#3b929d',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 10
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});


var testsChartDom = document.getElementById("testsChart").getContext('2d');
var testsChartInit = new Chart(testsChartDom, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [{
      label: 'Users',
      data: <?php echo $testsChartData ?? ''; ?>,
      borderWidth: 5,
      borderColor: '#55c6cc',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#55c6cc',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 10
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 5
        }
      }]
    },
  }
});
</script>

 <!--<script src="{{asset('admin/js/page/index-0.js')}}"></script>-->

@endsection
