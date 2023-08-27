<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Models\Clothes;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ClothesController extends Controller
{
    public function index(){
        $clothes = Clothes::latest()->paginate(5);
        $category = Category::all();
        return view('clothes.index',compact('clothes','category'));
    }

    public function create(){
        $category = Category::all();
        return view('clothes.create',compact('category'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'category_id' => 'required',
            'nama' => 'required|string|min:5|max:80',
            'harga' => 'required|integer|min:50000',
            'jumlah' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            ]);

            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/images', $fileName);
        
        Clothes::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'foto' => $fileName,
        ]);

        return redirect()->route('clothes.index');
    }

    public function edit(Request $req, $id){
        $cloth = Clothes::find($id);
        $category = Category::all();
        return view('clothes.edit',compact('cloth','category'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'category_id' => 'required',
            'nama' => 'required|string|min:5|max:80',
            'harga' => 'required|integer|min:50000',
            'jumlah' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            ]);

        $cloth = Clothes::find($id);
        $path='storage/images/'.$cloth->foto; 
        if(File::exists($path)) {
            unlink($path);
        }

        $fileName = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('public/images', $fileName);

        $cloth->update([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'foto' => $fileName
        ]);

        return redirect()->route('clothes.index');
    }

    public function delete(Request $request,$id){
        $cloth = Clothes::find($id);
        $path='storage/images/'.$cloth->foto; 

        if(File::exists($path)) {
            unlink($path);
        }
        
        $cloth->delete();

        return redirect()->route('clothes.index');
    }
}
