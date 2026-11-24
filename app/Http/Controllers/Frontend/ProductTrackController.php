<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class ProductTrackController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('tracker')){
            $order = app(OrderRepositoryInterface::class)->getByInvoiceId($request->tracker);
    
            return view('frontend.pages.product-track', compact('order'));
        }else {
            return view('frontend.pages.product-track');
        }
    }
}
