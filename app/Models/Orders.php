<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'user_id',
        'order_id',
        'products',
        'total_price',
        'comments',
        'order_updated_at',
        'delivered',
        'paid',
        'is_delivered_by'
        

    ];
    
    protected $casts = [
        'products' => 'json',
    ];

    public function save(array $options = []){
        //update the updated_at property
        $this->order_updated_at = now();
        parent::save($options);
    }
}

