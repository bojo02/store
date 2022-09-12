<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use DB;

class PostCategoryController extends Controller
{
    private $categoryIds = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post_categories.index', compact('post_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post_categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post_categories.create', compact('post_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if(!$request->filled('slug')){
            $slug = $this->create_slug($request->name);
        }
        else{
            $slug = $request->slug;
        }

        $product_category = Category::create([
            'slug' => $slug,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'imageable_id' => $imageable_id = 1,
            'imageable_type' => $request->type,
        ]);

        $product_categories = Category::select('*')->where('imageable_type', 'App\Post')->with('subCategories')->get();

        return view('pages.product_categories.index', compact('product_categories'))->with('alert_success', 'Категорията беше създадена успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_category = Category::find($id);

        $post_categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post_categories.edit', compact('post_category', 'post_categories'));
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
        $product_category = Category::find($id);
        
        $request_category = Category::find($request->category_id);

        if( count( $product_category->subCategories) != 0 && $product_category->category_id == 0 && $request_category->category_id != 0){
            return redirect()->back()->with('alert_danger', 'Няма главна категория!');
        }
        if(!empty($request_category)){
            foreach($product_category->subCategories as $category){
                if( $category->id ==  $request_category->id){
                    return redirect()->back()->with('alert_danger', 'Няма главна категория!');
                }
            }
        }

        $product_category->name = $request->name;
        $product_category->slug = $request->slug;
        $product_category->description = $request->description;
        if(!empty($request->category_id))
        {
            $product_category->category_id = $request->category_id;
        }
        else
        {
            $product_category->category_id = 0;
        }

        $product_category->save();

        $product_categories = Category::select('*')->where('imageable_type', 'App\Product')->get();

        return view('pages.product_categories.edit', compact('product_category', 'product_categories'))->with('alert_success', 'Категорията беше редактирана успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_category= Category::find($id);

        if($post_category->subCategories->count() || $post_category->posts->count()){
            return redirect()->back()->with('alert_danger', 'Категорията не може да бъде изтрита, тъй като има подкатегории или статии!');
        }


        Category::destroy($id);

        $product_categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post_categories.index', compact('product_categories'))->with('alert_success', 'Категорията беше изтрита успешно!');
    }

    function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return strtolower($slug);
     }

    public function categories_recursive($cat){
        foreach($cat->subCategories as $category)
        {
            $this->categoryIds[] = $category->id;

            $this->categories_recursive($category);
        }

        return $this->categoryIds;
    }

    public function categoryPosts($slug){
        $category = Category::where('slug',$slug)->where('imageable_type', 'App\Post')->first();

        $subcategories = $category->subCategories;

        $posts = Post::select('*')->where('category_id', $category->id)->orWhere(function ($query) use ($category){
            foreach($this->categories_recursive($category) as $ids){
                $query->orWhere('category_id', $category->id)->orWhere('category_id', $ids);
            }
        })->orderBy('created_at', 'desc')->paginate(12);

        $categories = Category::select('*')->where('imageable_type', 'App\Post')->get();

        return view('pages.post.index', compact('posts', 'categories'));

    }
}
