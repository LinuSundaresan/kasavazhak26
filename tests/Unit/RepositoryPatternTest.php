<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\SliderRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\AdminVendorProfileRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Interfaces\CoupenRepositoryInterface;
use App\Interfaces\ShippingruleRepositoryInterface;
use App\Interfaces\UserAddressRepositoryInterface;
use App\Interfaces\PaypalSettingRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderProductRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\StripeSettingRepositoryInterface;
use App\Interfaces\RazorpaySettingRepositoryInterface;
use App\Interfaces\HomepageSettingRepositoryInterface;

class RepositoryPatternTest extends TestCase
{
    public function test_all_repositories_are_bound_and_resolvable(): void
    {
        $bindings = [
            UserRepositoryInterface::class => \App\Repositories\UserRepository::class,
            SliderRepositoryInterface::class => \App\Repositories\SliderRepository::class,
            CategoryRepositoryInterface::class => \App\Repositories\CategoryRepository::class,
            SubCategoryRepositoryInterface::class => \App\Repositories\SubCategoryRepository::class,
            ChildCategoryRepositoryInterface::class => \App\Repositories\ChildCategoryRepository::class,
            BrandRepositoryInterface::class => \App\Repositories\BrandRepository::class,
            AdminVendorProfileRepositoryInterface::class => \App\Repositories\AdminVendorProfileRepository::class,
            ProductRepositoryInterface::class => \App\Repositories\ProductRepository::class,
            ProductImageGalleryRepositoryInterface::class => \App\Repositories\ProductImageGalleryRepository::class,
            ProductVariantRepositoryInterface::class => \App\Repositories\ProductVariantRepository::class,
            ProductVariantItemRepositoryInterface::class => \App\Repositories\ProductVariantItemRepository::class,
            VendorShopProfileRepositoryInterface::class => \App\Repositories\VendorShopProfileRepository::class,
            FlashSaleRepositoryInterface::class => \App\Repositories\FlashSaleRepository::class,
            FlashSaleItemRepositoryInterface::class => \App\Repositories\FlashSaleItemRepository::class,
            GeneralSettingRepositoryInterface::class => \App\Repositories\GeneralSettingRepository::class,
            CoupenRepositoryInterface::class => \App\Repositories\CoupenRepository::class,
            ShippingruleRepositoryInterface::class => \App\Repositories\ShippingRuleRepository::class,
            UserAddressRepositoryInterface::class => \App\Repositories\UserAddressRepository::class,
            PaypalSettingRepositoryInterface::class => \App\Repositories\PaypalSettingRepository::class,
            OrderRepositoryInterface::class => \App\Repositories\OrderRepository::class,
            OrderProductRepositoryInterface::class => \App\Repositories\OrderProductRepository::class,
            TransactionRepositoryInterface::class => \App\Repositories\TransactionRepository::class,
            StripeSettingRepositoryInterface::class => \App\Repositories\StripeSettingRepository::class,
            RazorpaySettingRepositoryInterface::class => \App\Repositories\RazorpaySettingRepository::class,
            HomepageSettingRepositoryInterface::class => \App\Repositories\HomepageSettingRepository::class,
        ];

        foreach ($bindings as $interface => $expectedClass) {
            $instance = app($interface);
            $this->assertInstanceOf($expectedClass, $instance, "Interface {$interface} did not resolve to {$expectedClass}");
        }
    }

    public function test_controllers_can_be_instantiated(): void
    {
        $controller = app(\App\Http\Controllers\Backend\ProductController::class);
        $this->assertInstanceOf(\App\Http\Controllers\Backend\ProductController::class, $controller);

        $catController = app(\App\Http\Controllers\Backend\CategoryController::class);
        $this->assertInstanceOf(\App\Http\Controllers\Backend\CategoryController::class, $catController);

        $orderController = app(\App\Http\Controllers\Backend\OrderController::class);
        $this->assertInstanceOf(\App\Http\Controllers\Backend\OrderController::class, $orderController);
    }
}
