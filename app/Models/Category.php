<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'slug', 'imageable_id', 'imageable_type'];

    public function subCategories(){
        return $this->hasMany(Category::class, 'category_id')->with('subCategories')->with('subCategories.products');
    }
    public function parent(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function subproducts()
    {
        return $this->hasManyThrough(Product::class, self::class, 'id', 'category_id');
    }
    public function imagable(){
        return $this->morphTo();
    }
}
