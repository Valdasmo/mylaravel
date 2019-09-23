@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>
               <div class="card-body">
                 

@foreach ($masters as $master)
{{$master->name}} {{$master->surname}}
  <a href="{{route('master.edit',[$master])}}"><button type="submit">EDIT</button></a>
  <form method="POST" action="{{route('master.destroy', [$master])}}" style="display:inline-block;">
    @csrf
    <button type="submit">DELETE</button>    
   </form><br>
@endforeach



  BLADE TURINYS
</div>
</div>
</div>
</div>
</div>
@endsection
