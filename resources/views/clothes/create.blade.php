@extends('layouts.main')

@section('content')
<h1>create</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('clothes.store') }}" method="post" enctype="multipart/form-data">
    @csrf    
    <div class="form-group">
    kategori
    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
        @foreach($category as $item)  
        <option value="{{ $item->id }}"> {{ $item->nama}}</option>
        @endforeach
    </select>
     <div class="form-group">
        nama
        <input name="nama" type="text" class="form-control" >
     </div>
    <div class="form-group">
        harga
        <div class="input-group-prepend">
          <div class="input-group-text">Rp.</div>
            <input name="harga" type="number" class="form-control" >
        </div>
    </div>
    <div class="form-group">
        jumlah
        <input name="jumlah" type="number" class="form-control" >
    </div>
    <div class="form-group">
        foto
        <input type="file" name="foto" class="form-control" >
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
 
</form>
 
@stop