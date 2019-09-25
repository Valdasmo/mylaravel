@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS


                  <form method="GET" action="{{route('outfit.index')}}">
                      <select class="form-control" name="filter">
                          @foreach ($masters as $master)
                              <option value="{{$master->id}}" @if($master->id==$filter) selected @endif>{{$master->name}} {{$master->surname}}</option>
                          @endforeach
                      </select>

                      <br>
                      <button type="submit">Rodyti siuvėjo drabužį</button>
                      </form>

                      
               </div>
               <div class="card-body">


@foreach ($outfits as $outfit)
  
  <a href="{{route('outfit.edit',$outfit)}}"> {{$outfit->type}} {{$outfit->outfitMaster->name}} {{$outfit->outfitMaster->surname}}</a>

  <form method="POST" action="{{route('outfit.destroy', [$outfit])}}">
   @csrf
   <button type="submit">DELETE</button>
  </form>
  <br>
@endforeach


</div>
</div>
</div>
</div>
</div>
@endsection
