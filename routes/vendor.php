<?php

use App\Http\Controllers\EarningController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MassageController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\Seller\ExportImportController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\SellerPagesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TransactionController;
use App\Models\Order;
use App\Models\Prodcat;
use App\Models\Product;
use Codeboxr\PathaoCourier\Facade\PathaoCourier;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Invoice;
use TCG\Voyager\Models\Category;

Route::group(
    [
        'as' => 'vendor.', //generalize name prefix
        'prefix' => 'vendor/dashboard' //generalize url prefix
    ],
    function () {
        Route::get('/', [SellerPagesController::class, 'dashboard'])->name('dashboard');

        Route::get('/product/create', [ProductController::class, 'create'])->name('create.product');

        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');

        Route::get('/products', [ProductController::class, 'products'])->name('products');
        Route::get('/product-edit/{slug}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/products-delete{product}', [ProductController::class, 'productRemove'])->name('products.delete');

        Route::get('/orders/index', [SellerPagesController::class, 'ordersIndex'])->name('ordersIndex');
        Route::get('/order/products', [SellerPagesController::class, 'orderProducts'])->name('order.products');
        Route::get('/order/view/{order}', [SellerPagesController::class, 'orderView'])->name('orderView');
        Route::get('/order/{order}/returned-product-received', [SellerPagesController::class, 'returned_product_received'])->name('returned.product.received');
        Route::post('/shipping', [SellerPagesController::class, 'shippingUrl'])->name('order.shipping');
        Route::get('/invoice', [SellerPagesController::class, 'invoice'])->name('invoice');


        Route::post('/ChangePassword', [SellerPagesController::class, 'ChangePassword'])->name('ChangePassword');

        Route::get('/banner', [SellerPagesController::class, 'banner'])->name('banner');
        Route::post('/banner/store', [SellerPagesController::class, 'bannerStore'])->name('banner.store');
        Route::get('/shop/policy', [SellerPagesController::class, 'shopPolicy'])->name('shopPolicy');
        Route::post('/shop/policy/store', [SellerPagesController::class, 'shopPolicyStore'])->name('shopPolicy.store');

        Route::post('/shop/shopMenu/store', [SellerPagesController::class, 'shopMenuStore'])->name('shopMenuStore.store');

        Route::get('/offers', [SellerPagesController::class, 'offers'])->name('offers');
        Route::get('/offer-accept/{offer}', [SellerPagesController::class, 'offerAccept'])->name('offer.accept');
        Route::get('/offer-decline/{offer}', [SellerPagesController::class, 'offerDecline'])->name('offer.decline');
        Route::get('vendor/dashboard/order/action/{order}', [SellerPagesController::class, 'orderDeliver'])->name('order.action');
        Route::get('vendor/dashboard/order/cancel/{order}', [SellerPagesController::class, 'orderCancel'])->name('order.cancel');
        Route::get('vendor/dashboard/order/approve/{order}', [SellerPagesController::class, 'orderApprove'])->name('order.approve');



        Route::get('ticket/create', [TicketsController::class, 'create'])->name('ticket.create');
        Route::get('tickets', [TicketsController::class, 'index'])->name('ticket.index');

        Route::post('ticket/store', [TicketsController::class, 'store'])->name('ticket.store');

        Route::get('/charges', [SellerPagesController::class, 'charges'])->name('charges');
        Route::get('/charge/{charge}', [SellerPagesController::class, 'charge'])->name('charge');

        Route::get('/massage/{id?}', [MassageController::class, 'shopMassage'])->name('massage');
        Route::get('/massage/store/{id?}', [MassageController::class, 'shopMassagestore'])->name('massage.store')->middleware('auth');

        Route::get('vendor/dashboard/setting/cancelSubscription', [SellerPagesController::class, 'cancelSubscription'])->name('cancelSubscription');
        Route::get('vendor/dashboard/setting/resumeSubscription', [SellerPagesController::class, 'resumeSubscription'])->name('resumeSubscription');
        Route::get('vendor/dashboard/setting/cancelSubscriptionNow', [SellerPagesController::class, 'cancelSubscriptionNow'])->name('cancelSubscriptionNow');
        Route::get('/feedbacks', [FeedbackController::class, 'vendorFeedbacks'])->name('feedbacks');

        Route::post('store-attribute', [ProductVariationController::class, 'storeAttribue'])->name('store.attribute');
        Route::post('update-attribute', [ProductVariationController::class, 'updateAttribue'])->name('update.attribute');
        Route::get('new-variation/{product}', [ProductVariationController::class, 'newVariation'])->name('new.variation');
        Route::post('update-variation/{product}', [ProductVariationController::class, 'updateVariation'])->name('update.variation');
        Route::get('delete-meta/{product}', [ProductVariationController::class, 'deleteProductMeta'])->name('delete.product.meta');
        Route::get('delete-attribute/{attribute}', [ProductVariationController::class, 'deleteProductAttribute'])->name('delete.product.attribute');
        Route::get('copy-product/{product}', [ProductVariationController::class, 'CopyProduct'])->name('copy.product');
        Route::get('create-all-variation-from-attribute/{product}', [ProductVariationController::class, 'create_all_variation'])->name('create.all.variation');
        Route::get('delete-all-child/{product}', [ProductVariationController::class, 'delete_all_child'])->name('delete.all.child');

        Route::get('cards', [SellerPagesController::class, 'cards'])->name('cards');
        Route::get('refund-request/accept/{order}', [SellerPagesController::class, 'refundRequestAccept'])->name('refund.request.accept');
        Route::get('/earnings', [EarningController::class, 'earnings'])->name('earnings');
        Route::get('/transactions', [TransactionController::class, 'transactions'])->name('transictions');
        Route::post('/widthraw-request', [TransactionController::class, 'widthrawRequest'])->name('widthraw.request');
        Route::get('order/{order}/ready-for-pickup', function (Order $order) {

            $childs = $order->childs->filter(fn($order) => $order->shop_id == auth()->user()->shop->id);
            $description = '';
            foreach ($childs as $child) {

                $description .= $child->product->name . ' X ' . $child->quantity . ' | ';
            }

            $item_weight = number_format($order->childs->map(fn($order) => minValue($order->product->weight, 0.1) * $order->quantity)->sum(), 2);
            $qty = $order->childs->map(fn($order) => $order->quantity)->sum();
            $total = $order->childs->map(fn($order) => $order->total)->sum();

            $response = PathaoCourier::order()
                ->create([
                    "store_id"            => auth()->user()->shop->shipping_method, // Find in store list,
                    "merchant_order_id"   => $order->id, // Unique order id
                    "recipient_name"      => $order->full_name, // Customer name
                    "recipient_phone"     => $order->phone, // Customer phone
                    "recipient_address"   => $order->address, // Customer address
                    "recipient_city"      => json_decode($order->shipping)->city->id, // Find in city method
                    "recipient_zone"      => json_decode($order->shipping)->zone->id, // Find in zone method
                    "recipient_area"      => json_decode($order->shipping)->area->id, // Find in Area method
                    "delivery_type"       => 48, // 48 for normal delivery or 12 for on demand delivery
                    "item_type"           => 2, // 1 for document,2 for parcel
                    "special_instruction" => $order->customer_note,
                    "item_quantity"       => $qty, // item quantity
                    "item_weight"         => $item_weight / 1000, // parcel weight
                    "amount_to_collect"   =>  $order->payment_method == 'cod' ? (int) $total : 0, // amount to collect
                    "item_description"    => $description // product details
                ]);
            $order->shipping_url = $response->consignment_id;
            $orders = $order->childs->filter(fn($order) => $order->shop_id == auth()->user()->shop->id);
            foreach ($orders as $key => $order) {
                $order->status = 2;
                $order->save();
            }
            $order->createMetas((array)$response);
            return redirect()->back()->with('success');
        })->name('order.pickup');
        Route::post('products/import', [ExportImportController::class, 'import'])->name('products.import');
        Route::get('products/export', [ExportImportController::class, 'export'])->name('products.export');


        Route::get('/category-list', function () {
            $categories =  Prodcat::select('id', 'name')->get();
            return view('auth.seller.categorylist', compact('categories'));
        })->name('category_list');

        Route::post('assign-affiliate',[SellerPagesController::class,'assignAffiliate'])->name('assign.affiliate');
        Route::get('order/delivered/{order}',[SellerPagesController::class,'orderDelivered'])->name('order.delivered');
    }
);
