<!DOCTYPE html>
<html>
<body>

<h2>Calculetorius</h2>

<form action="{{route('sumsumas')}}" method="POST">
  X:<br>
  <input type="text" name="x" value="">
  <br>
  Y:<br>
  <input type="text" name="y" value="">
  <br><br>
  <input type="Submit" value="+++">
  @csrf
</form> 

<p>If you click the "+++" button, the form-data will be sent to "sumsumas".</p>


</body>
</html>

<h2>Sumavimo rezultatas = {{$ats}}</h2>
{{-- <h2>{{$ats}}</h2> --}}

