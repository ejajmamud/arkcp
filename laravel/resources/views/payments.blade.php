
@extends('layouts.admin')
@section('admincontent')

<div class="main-content" style="min-height: 586px;">
    <section class="section">
      <div class="section-header">
        <h1>Payments List</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Payments</div>
        </div>
      </div>

      <div class="section-body">


        <div class="row">
          <div class="col-10">

          <p class="section-title">List of all the payments happened in portal </p>
          </div>
          <div class="col-2">
          <!--<a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">-->
          <!--   <i class="fas fa-file-export"></i> Export-->
          <!--</a>-->
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" style="padding: 20px 0;">

          <table id="users-table" class="display table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment gateway</th>
                        <th>Payment Status</th>
                        <th>Payment ID</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$student['firstname']}} {{$student['lastname']}}</td>
                        <td>{{$student['email']}}</td>
                        <td>
                                @if($student['payment_gateway'] = 'senangpay')
                                    RM {{$student['amount']}}
                                @else
                                    $ {{$student['amount']}}
                                @endif
                        </td>
                        <td>{{$student['created_at']->format('d/m/Y')}}</td>
                        <td>{{$student['payment_gateway']}}</td>
                        <td>{{$student['payment_status']}}</td>
                        <td>{{$student['payment_id']}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment gateway</th>
                        <th>Payment Status</th>
                        <th>Payment ID</th>
                    </tr>
                </tfoot>
            </table>

            </div>
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

<script>
             jQuery(function($){
                $('#users-table').DataTable();

             });
        </script>



@endsection
