<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\HomepageSettingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\SliderRepositoryInterface;
use App\Models\Adverisement;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Cache::rememberForever('sliders', function(){
            return app(SliderRepositoryInterface::class)->getActiveSliders();
        });

        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSaleDate();

        $flashSaleItems = app(FlashSaleItemRepositoryInterface::class)->getHomeFlashSaleProductIds();

        $homeSettingRepo = app(HomepageSettingRepositoryInterface::class);
        $popularCategory = $homeSettingRepo->getByKey('popular_category_section');
        $brands = app(BrandRepositoryInterface::class)->getFeaturedBrands();

        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = $homeSettingRepo->getByKey('product_slider_section_one');
        $categoryProductSliderSectionTwo = $homeSettingRepo->getByKey('product_slider_section_two');
        $categoryProductSliderSectionThree = $homeSettingRepo->getByKey('product_slider_section_three');

        // banners
        $homepage_secion_banner_one = Adverisement::where('key', 'homepage_secion_banner_one')->first();
        $homepage_secion_banner_one = json_decode($homepage_secion_banner_one?->value);

        $homepage_secion_banner_two = Adverisement::where('key', 'homepage_secion_banner_two')->first();
        $homepage_secion_banner_two = json_decode($homepage_secion_banner_two?->value);

        $homepage_secion_banner_three = Adverisement::where('key', 'homepage_secion_banner_three')->first();
        $homepage_secion_banner_three = json_decode($homepage_secion_banner_three?->value);

        $homepage_secion_banner_four = Adverisement::where('key', 'homepage_secion_banner_four')->first();
        $homepage_secion_banner_four = json_decode($homepage_secion_banner_four?->value);

        $recentBlogs = Blog::with(['category', 'user'])->where('status',1)->orderBy('id', 'DESC')->take(8)->get();

        return view('frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItems',
                'popularCategory',
                'brands',
                'typeBaseProducts',
                'categoryProductSliderSectionOne',
                'categoryProductSliderSectionTwo',
                'categoryProductSliderSectionThree',

                'homepage_secion_banner_one',
                'homepage_secion_banner_two',
                'homepage_secion_banner_three',
                'homepage_secion_banner_four',
                'recentBlogs'
            ));
    }

    public function getTypeBaseProduct()
    {
        $productRepo = app(ProductRepositoryInterface::class);
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = $productRepo->getTypeBasedProducts('new_arrival');
        $typeBaseProducts['featured_product'] = $productRepo->getTypeBasedProducts('featured_product');
        $typeBaseProducts['top_product'] = $productRepo->getTypeBasedProducts('top_product');
        $typeBaseProducts['best_product'] = $productRepo->getTypeBasedProducts('best_product');

        return $typeBaseProducts;
    }

    public function vendorPage()
    {
       $vendors = Vendor::where('status',1)->paginate(20);
       return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(string $id)
    {
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);

        $categories = app(CategoryRepositoryInterface::class)->getActiveCategories();
        $brands = app(BrandRepositoryInterface::class)->getActiveBrands();
        $vendor = Vendor::findOrFail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands', 'vendor'));
    }

    function ShowProductModal(string $id) {
       $product = app(ProductRepositoryInterface::class)->getById($id);

       $content = view('frontend.layouts.modal', compact('product'))->render();

       return Response::make($content, 200, ['Content-Type' => 'text/html']);
    }
}
