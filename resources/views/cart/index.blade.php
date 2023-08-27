@extends('layouts.main')
@section('content') 

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th >Foto</th>
            <th  >Nama</th>
            <th  >Harga</th>
            <th   class="text-center">Jumlah</th>
            <th  >kategori</th>
             <th  >Action</th>

        </tr>
    </thead>
    <tbody>
       
    @foreach(auth()->user()->clothes()->get()  as $details)
    <tr class="item">
        <td >
            <div class="col-sm-3 hidden-xs"><img src="{{ asset('storage/images/'.$details['foto']) }}  " width="100" height="100" class="img-responsive"/></div>
         </td>
        <td>
        <div class="col-sm-5">
            <h4 class="nomargin">{{ $details['nama'] }}</h4>
        </div>
        </td>
        <td  >Rp.{{ $details['harga'] }}</td>
        <td>
            <p>{{ $details['jumlah'] }}</p>
         </td>
        
        <td  > {{ $details['category_id'] }}</td>
         <td>
            <form action="{{route('cart.delete',$details['id'])}}" method="POST">
                @csrf 
                @method('delete')
                <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
            </form>
        </td>
    </tr>
   @endforeach   
 
</tbody>
</table>
 
<div class="mt-5">
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
    <input name="alamat" type="text" placeholder="alamat pengiriman" min="10" maks="100">
    <input name="kode_pos" type="text" placeholder="kode pos" max="5" min="5">
    <br>
    <textarea name="catatan" id="" cols="50" rows="5">catatan tambahan</textarea>
    <br>
    <button class="btn btn-success">Checkout</button>
    </form>
   

</div>

 

@stop