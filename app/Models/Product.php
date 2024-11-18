<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillable = ['name', 'category_id', 'selling_price', 'purchase_price', 'img'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // app/Models/Product.php
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
