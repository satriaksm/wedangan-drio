<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'payment_method', 'total_items', 'total_price'];
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
