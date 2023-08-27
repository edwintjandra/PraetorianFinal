@extends('layouts.main')

@section('content')
<h1>category</h1>

<ul>
    @foreach($category as $item)
    <li> {{$item->nama}} </li>
    <form action="{{ route('category.delete',$item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btm-danger">delete</button>
    </form> 
    @endforeach
</ul>

 
 
@stop