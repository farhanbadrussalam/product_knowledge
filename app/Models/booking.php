<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['product', 'customer'];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
