
@extends('layouts.admin')
@section('admincontent')

<div class="main-content" style="min-height: 760px;">
    <section class="section">
      <div class="section-header">
        <h1>Questions</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Questions</div>
        </div>
      </div>

      <div class="section-body">
        <p class="section-title">
          Add Questions
        </p>
        <div class="row">
            <div class="col-12 col-md-12">
                <form class="card" action="/admin/questions" method="POST">
                    <div class="card-header">
                        <h4>New Question</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Personality Type</label>
                                    <select class="form-control form-control-sm" name="personalitytype" id="personalitytype">
                                        <option value="realistic">Realistic</option>
                                        <option value="Investigative">Investigative</option>
                                        <option value="Artistic">Artistic</option>
                                        <option value="Social">Social</option>
                                        <option value="Enterprising">Enterprising</option>
                                        <option value="Conventional">Conventional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question (English*)</label>
                                    <input type="text" class="form-control" required name="questionen" id="questionen">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question (Malay*)</label>
                                    <input type="text" class="form-control" required name="questionmalay" id="questionmalay">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
        <p class="section-title">
          Questions List
        </p>
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="padding: 20px 0;">

          <table id="users-table" class="display table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Category</th>
                        <th>Question English</th>
                        <th>Question Malay</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{ $loop-> index+1 }}</td>
                        <td>{{$question['personalitytype']}}</td>
                        <td>{{$question['questionen']}}</td>
                        <td>{{$question['questionmalay']}}</td>
                        <td class="d-flex align-items-center">
                        <a href="/admin/questionsedit/{{$question ->id}}" class="btn btn-primary btn-sm mr-2">Edit</a>
                        <form action="/admin/questions/{{$question ->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                         <th>Sl.no</th>
                        <th>Question</th>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

            </div>
           </div>
       </div>

      </div>
    </section>
  </div>

  <script>
             jQuery(function($){
                $('#users-table').DataTable();

             });
        </script>


@endsection
