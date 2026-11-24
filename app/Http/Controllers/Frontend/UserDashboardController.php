<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $orderRepo = app(OrderRepositoryInterface::class);
        $totalOrder = $orderRepo->countByUserId(Auth::user()->id);
        $pendingOrder = $orderRepo->countByUserIdAndStatus(Auth::user()->id, 'pending');
        $completeOrder = $orderRepo->countByUserIdAndStatus(Auth::user()->id, 'delivered');
        $reviews = ProductReview::where('user_id', Auth::user()->id)->count();
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->count();

        return view('frontend.dashboard.dashboard', compact(
            'totalOrder',
            'pendingOrder',
            'completeOrder',
            'reviews',
            'wishlist'
        ));
    }
}
