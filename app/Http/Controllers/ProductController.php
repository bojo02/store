<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cart = session()->get('cart');

        //return count($cart);

        $products = Product::orderBy('created_at', 'desc')->with('photo')->paginate(12);

        $categories = Category::select('*')->where('imageable_type', 'App\Product')->get();

        return view('pages.shop.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('*')->where('imageable_type', 'App\Product')->get();

        return view('pages.shop.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return strtolower($slug);
     }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required',
            'category_id' => 'required',
        ]);

           $file = $request->file('photo');
    
           $name = $request->file('photo')->getClientOriginalName();
    
           $path = $request->file('photo')->storeAs('/images', $name);
    
           $request->file('photo')->move(public_path('images'), $name);
    
           $photo = new Photo;
    
           $photo->name = $name;
           $photo->path = $path;
    
           $photo->save();

          $product = new Product;
          $product->title = $request->title;
          $product->slug = $this->create_slug($request->title);
          $product->short_description = $request->short_description;
          $product->description = $request->description;
          $product->price = $request->price;
          $product->sale_status = 0;
          $product->sale_price = 0;
          $product->category_id = $request->category_id;
          $product->photo_id = $photo->id;

          $product->save();

          $alert_success = "Продуктът бе качен успешно!";

          $categories = Category::all();

         return view('pages.shop.show', compact('product','categories', 'alert_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('slug',$id)->with('photo')->with('category')->first();

        return view("pages.shop.show", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
