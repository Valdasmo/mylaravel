@foreach ($masters as $master)
{{$master->name}} {{$master->surname}}
  <a href="{{route('master.edit',[$master])}}"><button type="submit">EDIT</button></a>
  <form method="POST" action="{{route('master.destroy', [$master])}}" style="display:inline-block;">
    @csrf
    <button type="submit">DELETE</button>    
   </form><br>
@endforeach
