@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <span class="sr-only">Loading...</span>
</div>
</div>
<div role="status" style="width: 140px;height: 140px;position: absolute;inset: 0px;margin: auto;z-index: 1000;"><div class="loader">Loading...</div></div>
<div class="overlay" style="
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: auto;
    background-color: rgb(255 255 255 / 22%);
    width: 100%;
    height: 100%;
    z-index: 999;
"></div>
    <form name="order" method="post" action="https://app.senangpay.my/payment/{{$merchant_id}}">
        <input type="hidden" name="detail" value="{{$usrdata->student_id}}">
        <input type="hidden" name="amount" value="{{$usrdata->amount}}">
        <input type="hidden" name="order_id" value="{{$usrdata->uniqueid}}">
        <input type="hidden" name="name" value="{{$usrdata->firstname}}">
        <input type="hidden" name="email" value="{{$usrdata->email}}">
        <input type="hidden" name="hash" value="{{$hashed_string}}">
    </form>
  <script>
    //   console.log(<?php echo '.'. $hashed_string .'.'?>);
    
    localStorage.setItem('id', <?php echo $usrdata->student_id ?>);
    setTimeout(function(){
    window.onload(document.order.submit());
    });

  </script>

@endsection
