<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
class Review extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'title',
        'image',
        'rate',
        'content',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
