<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'payment_id', 'delivery_id', 'user_id', 'status_id', 'address', 'zip', 'city', 'country'];

    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
