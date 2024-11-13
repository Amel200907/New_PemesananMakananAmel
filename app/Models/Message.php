<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    use HasFactory;

    protected $fillable = ['sender', 'content', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
