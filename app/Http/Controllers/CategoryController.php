<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $category=Category::All();
        return view('category.index',compact('category'));
    }
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|unique:categories'
        ]);

        Category::create([
                'nama' => $request->nama,
            
        ]);
    
        return redirect()->route('clothes.index');
     }

     public function delete(Request $request,$id){
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('clothes.index');
    }
}
