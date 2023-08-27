@extends('layouts.main')

@section('content')
<h1>create category</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
    @csrf    
     <div class="form-group">
        nama
        <input name="nama" type="text" class="form-control" >
     </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
 
</form>
 
@stop