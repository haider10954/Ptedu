<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function getTransaction(){
        return $this->hasOne(Transaction::class,'order_id','id');
    }
}
