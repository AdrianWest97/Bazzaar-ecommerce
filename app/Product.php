<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Cesargb\Database\Support\CascadeDelete;
use App\Http\Traits\Hashidable;
use App\Store;
use App\Review;

class Product extends Model implements Viewable
{

    use CascadeDelete;
    use Hashidable;


    protected $cascadeDeleteMorph = ['images', 'reviews', 'views'];
    use InteractsWithViews;

    protected $fillable = [
        'type',
        'title',
        'vendor',
        'description',
        'location',
        'available',
        'price',
        'quantity',
        'tags',
        'weight',
        'unit',
        'make',
        'model',
        'year',
        'transmission',
        'features',
        'brand',
        'featured',
        'currency'

    ];



    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, "product_id");
    }


    public function getImage($path)
    {
        return asset('product_images/' . $path . '/' . $this->images->first()->image);
    }

    public function get_small_image($img, $path)
    {
        return asset('product_images/' . $path . '/' . $img);
    }

    public function similar($type)
    {
        return Product::where('type', $type)->get()->except('id', $this->id);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


    public function getProduct($id)
    {
        return Product::findOrfail($id);
    }
    //if vehicle, get additional features



}