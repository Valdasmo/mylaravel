@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Pakeiskime drabužį</div>
               <div class="card-body">

            <div class="form-group">

<form method="POST" action="{{route('outfit.update',[$outfit])}}">

    <label>Drabužio tipas:</label>
    <input type="text" class="form-control" name="outfit_type" value="{{$outfit->type}}">
    <small class="form-text text-muted">Kažkoks parašymas.</small>

    <label>Drabužio spalva:</label>
    <input type="text" class="form-control" name="outfit_color" value="{{$outfit->color}}">
    <small class="form-text text-muted">Kažkoks parašymas.</small>

    <label>Drabužio dydis:</label>
    <input type="text" class="form-control" name="outfit_size" value="{{$outfit->size}}">
    <small class="form-text text-muted">Kažkoks parašymas.</small>

    <label>Drabužio aprašymas:</label>
    <textarea class="form-control" id="summernote" name="outfit_about">{{$outfit->about}}</textarea>
    <small class="form-text text-muted">Drabužio charakteristikos</small>

    <select name="master_id">
        @foreach ($masters as $master)
            <option value="{{$master->id}}" @if($master->id == $outfit->master_id) selected @endif>
                {{$master->name}} {{$master->surname}}
            </option>
        @endforeach
</select>
    @csrf
    <button type="submit">EDIT</button>
</form>

</div>

  </div>
</div>
</div>
</div>
</div>
<script>
        $(document).ready(function() {
           $('#summernote').summernote();
         });
        </script>
@endsection
