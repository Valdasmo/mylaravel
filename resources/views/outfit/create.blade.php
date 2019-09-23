@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Naujas drabužis</div>
               <div class="card-body">

                    <div class="form-group">


<form method="POST" action="{{route('outfit.store')}}">

    
        <label>Drabužio tipas:</label>
        <input type="text" class="form-control" name="outfit_type">
        <small class="form-text text-muted">Kažkoks parašymas.</small>
    
        <label>Drabužio spalva:</label>
        <input type="text" class="form-control" name="outfit_color">
        <small class="form-text text-muted">Kažkoks parašymas.</small>
    
        <label>Drabužio dydis:</label>
        <input type="text" class="form-control" name="outfit_size">
        <small class="form-text text-muted">Kažkoks parašymas.</small>
    
        <label>Drabužio aprašymas:</label>
        <textarea class="form-control" name="outfit_about"></textarea>
        <small class="form-text text-muted">Drabužio charakteristikos</small>


    <select name="master_id">
        @foreach ($masters as $master)
            <option value="{{$master->id}}">{{$master->name}} {{$master->surname}}</option>
        @endforeach
 </select>
    @csrf
    <button type="submit">ADD</button>
 </form>

</div>

    BLADE TURINYS
  </div>
</div>
</div>
</div>
</div>
@endsection
