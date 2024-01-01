<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_price','transaction_id'];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($product) {
        $product->transaction_id = Str::uuid();
    });
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
