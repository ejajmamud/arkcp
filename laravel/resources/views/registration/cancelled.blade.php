@extends('layouts.app')

@section('content')
<main id="main">

    <section class="section pb-2" >

      <div class="container py-5 my-5" style="min-height:440px">
        <div class="row align-items-center py-5 my-5">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-7 border-bottom">
                <h1 data-aos="fade-up" data-aos-delay="">Oops...</h1>
                <h3 data-aos="fade-up" data-aos-delay="">Your transaction has been cancelled</h3>
                <p>Please try again by clicking <a href="/registration">here</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
  <form name="cancelledPayment" action="{{ url('cancelpay') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="" id="id">
    <input type="hidden" name="res" value="{{$res}}" id="res">
</form>

    </section>


  </main>
@endsection
