<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clothes;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function cart(){
        return view('cart.index');
    }
    public function addToCart($id){
        foreach(Auth::user()->clothes()->get() as $cloth){
            if($cloth->id == $id) {
                return redirect()->route('clothes.index')->with('error', 'Product already added!');;
            }
        }
        $userId= Auth::user()->id;
         Cart::create([
            'clothes_id' => $id,
            'user_id' => $userId
        ]);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    public function removeCart($id){
         $user=Auth::user();
         $user->clothes()->detach($id);
        return redirect()->route('clothes.index')->with('success','product has been deleted');
    }

    public function checkout(Request $request){
        //validate request
        $this->validate($request, [
            'alamat' => 'required',
            'kode_pos' => 'required',
            'catatan' => 'required',
        ]);

        $count=0;
        foreach(Auth::user()->clothes()->get() as $cloth){
            $count++;
        }
        if($count<1){
         return redirect()->route('cart')->with('error','add minimum 1');
        }

        foreach(Auth::user()->clothes()->get() as $cloth){
            Order::create([
                'user_id'=>Auth::user()->id,
                'alamat'=>$request->alamat,
                'kodepos'=>$request->kode_pos,
                'catatan'=>$request->catatan,
                'category'=>$cloth->category_id,
                'nama'=>$cloth->nama,
                'harga'=>$cloth->harga,
                'jumlah'=>$cloth->jumlah,
                'foto'=>$cloth->foto
            ]);
        }
        
        $user=Auth::user();
        $user->clothes()->detach();
        return redirect()->route('checkout.index')->with('success','product has been ordered');
     }

     public function checkoutIndex(){
        
        return view('cart.checkout');
     }
}
