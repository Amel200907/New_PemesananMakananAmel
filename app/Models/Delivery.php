<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    protected $fillable = [
        'admin_id', 'order_id', 'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
