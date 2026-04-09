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
  <form name="order" action="{{ url('paypalgateway') }}" id="form" method="post">
    @csrf
    <input type="hidden" value="{{$da}}" name="da">
  </form>
  <script> 
      localStorage.setItem('id', <?php echo $da->student_id ?>);
  window.onload(document.order.submit());
 </script>

@endsection
