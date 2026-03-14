<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
        $validated = $request->validate([
            "name"=>["string","required","min:3",
            Rule::unique("product","name")
            ],
            "price"=>"required|numeric",
            "image"=>"required|image|mimes:jpg,png,jpeg,gif"
        ]);
        $imagePath= "";
        if($request->hasFile("image")){
            $imagePath=$request->file("image")->store("product","public");
        }
        $product=Product::create(
            [
              "name"=>$validated["name"],
              "price"=>$validated["price"],
              "image_url"=>$imagePath
            ]
        );
        return response()->json([
            "data"=>$product,
        ]);
        } catch(Exception $e){
            return response()->json([
                  "data"=> $e->getMessage()
            ]);
          
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
