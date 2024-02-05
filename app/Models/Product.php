<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    	'category_id',
    	'brand_id',
    	'name',
        'sku_code',
    	'description',
    	'media_id',
    	'price',
    	'quantity',
        'status',
        'is_deleted'
    ];

	public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
