
@extends('layouts.admin')
@section('admincontent')

<div class="main-content" style="min-height: 760px;">
    <section class="section">
      <div class="section-header">
        <h1>Occupations</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Occupations</div>
        </div>
      </div>

      <div class="section-body">
        <p class="section-title">
          Edit Occupation
        </p>
        <div class="row">
            <div class="col-12 col-md-12">

            <form class="card" action="/admin/occupationsedit/{{$occupation->id}}" method="POST">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Personality Type</label>
                                <select class="form-control form-control-sm" name="personalitytype">
                                        <option value="Realistic" {{ ( $occupation->personalitytype == 'Realistic') ? 'selected' : '' }}>Realistic</option>
                                        <option value="Investigative" {{ ( $occupation->personalitytype == 'Investigative') ? 'selected' : '' }}>Investigative</option>
                                        <option value="Artistic" {{ ( $occupation->personalitytype == 'Artistic') ? 'selected' : '' }}>Artistic</option>
                                        <option value="Social" {{ ( $occupation->personalitytype == 'Social') ? 'selected' : '' }}>Social</option>
                                        <option value="Enterprising" {{ ( $occupation->personalitytype == 'Enterprising') ? 'selected' : '' }}>Enterprising</option>
                                        <option value="Conventional" {{ ( $occupation->personalitytype == 'Conventional') ? 'selected' : '' }}>Conventional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Occupation (English*)</label>
                                    <input type="text" class="form-control" required name="occupationen" id="occupationen" value="{{$occupation->occupationen}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Occupation (Malay*)</label>
                                    <input type="text" class="form-control" required name="occupationmalay" id="occupationmalay" value="{{$occupation->occupationmalay}}">
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
