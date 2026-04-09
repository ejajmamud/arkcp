
@extends('layouts.admin')
@section('admincontent')
<div class="main-content" style="min-height: 586px;">
    <section class="section">
      <div class="section-header">
        <h1>Students List</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Students</div>
        </div>
      </div>

      <div class="section-body">


        <div class="row">
          <div class="col-10">

          <p class="section-title">List of the students registered in Portal.</p>
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
                        <th style="width: 30px;">Sl.no</th>
                        <th>Student Details</th>
                        <th>Country</th>
                        <th>Amount</th>
                        <th>Created On</th>
                        <th>Test Status</th>
                        <th>Payment Status</th>
                        <th>Report</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td> <b>{{$user->firstname}} {{$user->lastname}}</b> <br> {{$user->email}} <br> Age:{{$user->age}} </td>
                        <td>{{$user->country}}</td>
                        <td>
                                @if($user->paid_amount > 15)
                                    RM {{$user->paid_amount}}
                                @else
                                    $ {{$user->paid_amount}}
                                @endif
                        
                        </td>
                        <td>{{$user->created_at->format('d/m/Y')}}</td>
                        <td>
                            @if($user->payment_status==='approved')
                                @if($user->isTestCompleted)
                                    <span class="badge badge-success">Completed</span>
                                @else
                                    <span class="badge badge-info">Not Started</span>
                                @endif
                            @else
                                N/A
                            @endif
                            
                        </td>
                        <td>
                            @if($user->payment_status==='approved')
                                <span class="badge badge-primary">Approved</span>
                            @elseif($user->payment_status==='declined')
                                <span class="badge badge-warning">Declined</span>
                            @else
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            @if($user->payment_status==='approved')
                                @if($user->isTestCompleted)
                                    <a href="{{route('downloadpdf', $user->id)}}" class="btn btn-dark btn-sm">Download</a>
                                @else
                                    <span class="text-warning">Test in progress</span>
                                @endif
                            
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th style="width: 30px;">Sl.no</th>
                        <th>Student Details</th>
                        <th>Country</th>
                        <th>Amount</th>
                        <th>Created On</th>
                        <th>Test Status</th>
                        <th>Payment Status</th>
                        <th>Report</th>
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
