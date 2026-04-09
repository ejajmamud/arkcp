
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
      
      
      <div class="row">
                  <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
               <form class="form-inline" action="/admin/reports" method="post">
                  @csrf
                  <label class="sr-only" for="inlineFormInputName2">From Date</label>
                  <input type="text" class="form-control mb-2 mr-sm-2 datepicker" id="inlineFormInputName2" name="from" placeholder="From Date">
                
                  <label class="sr-only" for="inlineFormInputGroupUsername2">To Date</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control datepicker" id="inlineFormInputGroupUsername2" name="to" placeholder="To Date">
                  </div>
                
                  <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
            @if($fildata !== '0')
            <div class="card-body">
               
          <table id="users-table" class="display table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 30px;">Sl.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($fildata as $user)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                                @if($user->paid_amount > 15)
                                    RM {{$user->paid_amount}}
                                @else
                                    $ {{$user->paid_amount}}
                                @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        
                        <th colspan="4" style="text-align:right;"><h3><span id="totAmtVal" class="badge badge-success"></span> Total Income</h3></th>
                    </tr>
                </tfoot>
            </table>
            </div>
            @endif
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
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
             jQuery(function($){
               $('#users-table').DataTable({
                    "order": [[ 0, "desc" ]]
                });
                
                $('.datepicker').datepicker({
                    format: 'yyyy/mm/dd',
                    locale: 'en'
                });
                
                var totAmt=0, allStus = <?php echo $fildata ?>;
                console.log(allStus);
                for(var i=0; i<allStus.length; i++){
                    totAmt +=allStus[i].paid_amount;
                }
                document.getElementById("totAmtVal").innerHTML = '$'+totAmt;
                 
             });
        </script>

@endsection
