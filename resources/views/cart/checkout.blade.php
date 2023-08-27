@extends('layouts.main')
@section('content') 

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

<h1>Your Order</h1>


<table class="table">
  <thead>
    <tr>
       <th scope="col">Order date</th>
      <th scope="col">Alamat</th>
      <th scope="col">Kodepos</th>
      <th scope="col">catatan</th>
      <th scope="col">status</th>
      <th scope="col">nama</th>
       <th scope="col">quantity</th>
      <th scope="col">harga</th>
      <th scope="col">total</th>
    </tr>
  </thead>
  <tbody>
   @foreach(auth()->user()->Order()->get() as $item)
    <tr>
       <td>{{$item->created_at}}</td>
      <td>{{$item->alamat}}</td>
      <td>{{$item->kodepos}}</td>
      <td>{{$item->catatan}}</td>
      <td><button class="btn btn-sm btn-warning">pending</button></td>
      <td>{{$item->nama}}</td>
      <td>{{$item->jumlah}}</td>
      <td>Rp.{{$item->harga}}</td>
      <td>Rp.{{$item->jumlah * $item->harga}}</td>
      
     
    </tr>
  @endforeach
  </tbody>
</table>

@stop