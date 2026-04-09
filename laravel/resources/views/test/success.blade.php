@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test Success</div>
                <div class="card-body text-center">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h4>Thank you for completing the Career Assessment!</h4>
                        <p>Your results have been saved successfully.</p>
                    </div>

                    <div class="student-info mt-4">
                        <h5>Student Information</h5>
                        <p>ID: {{ $student->student_id }}</p>
                        <p>Name: {{ $student->firstname }} {{ $student->lastname }}</p>
                    </div>

                    <div class="test-results mt-4">
                        <h5>Your Personality Types</h5>
                        <ul>
                            @foreach($score as $personality => $value)
                                <li>{{ $personality }}: {{ $value }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ $student->test_link }}" class="btn btn-primary">Download Report</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
