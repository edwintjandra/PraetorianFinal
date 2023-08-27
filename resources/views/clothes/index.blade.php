@extends('layouts.main')

@if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
@endif
@if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div> 
@endif

@section('content')
@if(auth()->user())
<h1>  Selamat Datang {{ auth()->user()->name }}</h1>
   @if(!empty(auth()->user()->admin_id))
    <strong> ADMIN ROLE</strong>
    @else
    <strong>USER ROLE </strong>
    @endif
@else
<h1>Index</h1>
@endif

<p>email:admin@gmail.com password:password (for admin login).
  <br>
  you can also update user permission on database.
</p>
<a href="{{ route('clothes.create') }}">create new clothes (admin role permission)</a>
<br>
<a href="{{ route('category.create') }}">create new category (admin role permission)</a>
<br>
<a href="{{ route('category.index') }}">delete category (admin role permission) </a>

<ul class="nav justify-content-around mt-1 mb-5">
  @foreach ($category as $item)
    <li class="nav-item"><i class="fa-solid fa-tag"></i> {{$item->nama}}</li>
    
    @endforeach
</ul>
 
 

<p>Clothes:</p>     
<div class="row mt-3">
@foreach ($clothes as $cloth)
    <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-4">
        <div class="card mb-4"  >
             <div class="card-body">
                  <img src="{{ asset('storage/images/'.$cloth->foto) }}" class="img-fluid">                
                  <li>kategori: {{ $cloth->category()->get()[0]->nama }}</li>
                   <li>nama: {{ $cloth->nama }}</li>
                   <li> harga: Rp. {{ $cloth->harga }}</li>
                   <li>jumlah: {{ $cloth->jumlah }}</li>
                   <a href="{{ route('cart.add', $cloth->id) }} " class="btn btn-success btn-sm mt-2 mb-1">Add to cart</a> <br>
            <a href="{{ route('clothes.edit',$cloth->id) }}" class="btn btn-warning btn-sm">edit</a>
            <form action="{{ route('clothes.delete',$cloth->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
                <button class="btn btn-sm btm-danger">delete</button>
            </form>
             </div>
        </div>
    </div>
    @endforeach
</div>

   
@stop