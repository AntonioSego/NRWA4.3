<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'client_name',
        'client_contact',
        'product_name',
        'noOfProducts',
        'sub_total',
        'vat',
        'discount',
        'total_amount',
        'paid',
        'due',
        'payment_type',
        'payment_status',
        'product_id',
        'user_id'
    ];
}
