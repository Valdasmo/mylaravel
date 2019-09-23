@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Naujas siuvėjas:</div>
               <div class="card-body">

            <div class="form-group">

<form method="POST" action="{{route('master.store')}}">


        <label>Vardas:</label>
        <input type="text" name="master_name" class="form-control" value="{{old('master_name')}}">
        <small class="form-text text-muted">Siuvėjo vardas</small>
    
    
        <label>Pavardė:</label>
        <input type="text" name="master_surname" class="form-control"value="{{old('master_surname')}}">
        <small class="form-text text-muted">Siuvėjo pavardė</small>


    @csrf
    <button type="submit">ADD</button>
 </form>


</div>
    </div>
</div>
</div>
</div>
</div>
@endsection
