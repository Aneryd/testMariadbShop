<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'user_id',
        'is_cancel'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, "order_products");
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
