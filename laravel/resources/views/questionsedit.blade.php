
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
          Edit Question
        </p>
        <div class="row">
            <div class="col-12 col-md-12">

            <form class="card" action="/admin/questionsedit/{{$question->id}}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Personality Type</label>
                                <select class="form-control form-control-sm" name="personalitytype">
                                        <option value="Realistic" {{ ( $question->personalitytype == 'Realistic') ? 'selected' : '' }}>Realistic</option>
                                        <option value="Investigative" {{ ( $question->personalitytype == 'Investigative') ? 'selected' : '' }}>Investigative</option>
                                        <option value="Artistic" {{ ( $question->personalitytype == 'Artistic') ? 'selected' : '' }}>Artistic</option>
                                        <option value="Social" {{ ( $question->personalitytype == 'Social') ? 'selected' : '' }}>Social</option>
                                        <option value="Enterprising" {{ ( $question->personalitytype == 'Enterprising') ? 'selected' : '' }}>Enterprising</option>
                                        <option value="Conventional" {{ ( $question->personalitytype == 'Conventional') ? 'selected' : '' }}>Conventional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question (English*)</label>
                                    <input type="text" class="form-control" required name="questionen" id="questionen" value="{{$question->questionen}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question (Malay*)</label>
                                    <input type="text" class="form-control" required name="questionmalay" id="questionmalay" value="{{$question->questionmalay}}">
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

      </div>
    </section>
  </div>


@endsection
