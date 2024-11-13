<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'is_superadmin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
