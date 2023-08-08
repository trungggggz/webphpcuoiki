<?php

namespace App\Http\Controllers\user;

// use App\Events\AdminConfirm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;
use App\Models\Wishlist;
use Exception;
class homeController extends Controller
{
    public function home()
    {
        // dd("test");
        $products = [];
        $categories =  [];
        $brands = [];
        $cart = session()->get('cart', []);
        return view('user.design.home', compact('products', 'categories', 'brands','cart'));
    }
    
   
}
   
