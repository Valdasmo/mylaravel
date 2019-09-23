@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Naujinti siuvėjo info</div>
               <div class="card-body">

               <div class="form-group">

<form method="POST" action="{{route('master.update',[$master])}}">

    <label>Vardas:</label>
    <input type="text" name="master_name" class="form-control" value="{{$master->name}}">
    <small class="form-text text-muted">Kitas siuvėjo vardas</small>


    <label>Pavardė:</label>
    <input type="text" name="master_surname" class="form-control" value="{{$master->surname}}">
    <small class="form-text text-muted">Kita siuvėjo pavardė</small>

    @csrf
    <button type="submit">EDIT</button>
 </form>

</div>
  </div>
</div>
</div>
</div>
</div>
@endsection
