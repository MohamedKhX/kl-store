<?php

namespace App\Observers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColors;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        if(isset($order->options->coupon_id)) {
            $coupon = Coupon::find($order->options->coupon_id);
            $coupon->number_of_uses = $coupon->number_of_uses + 1;
            $coupon->save();
        }

        foreach ($order->products as $product) {
            $this->addOrDeleteProduct($product['id'], $product['options']['size'], quantity: $product['qty']);
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order): void
    {

        //This code when we update order Products
        if($order->wasChanged('products')) {
            $status = $this->getOrderStatus()[$order->status];

            $afterUpdatedProducts  = Order::find($order->id)->products;
            $beforeUpdatedProducts = $order->getOriginal('products');

            //Properties to change in the order product
            $newQuantity = 0;
            $oldQuantity = 0;
            $newSize     = '';
            $oldSize     = '';

            $updatedProduct = null;

            foreach ($beforeUpdatedProducts as $beforeUpdatedProduct) {
                foreach ($afterUpdatedProducts as $afterUpdatedProduct) {

                    if($beforeUpdatedProduct['rowId'] != $afterUpdatedProduct['rowId']) {
                        continue;
                    }

                    if($beforeUpdatedProduct['qty'] != $afterUpdatedProduct['qty'] ||
                        $beforeUpdatedProduct['options']['size'] != $afterUpdatedProduct['options']['size']) {

                        $updatedProduct = $afterUpdatedProduct;
                        $newQuantity    = $afterUpdatedProduct['qty'] - $beforeUpdatedProduct['qty'];
                        $oldQuantity    = $beforeUpdatedProduct['qty'];
                        $newSize        = $afterUpdatedProduct['options']['size'];
                        $oldSize        = $beforeUpdatedProduct['options']['size'];

                    }

                }
            }

            if(is_null($updatedProduct)) {
                return;
            }

            if($status) {
                return;
            }

            if($newSize != $oldSize) {
                //Add or delete for the new size
                $this->addOrDeleteProduct($updatedProduct['id'], $newSize, delete: (bool) $updatedProduct['qty'],  quantity: $updatedProduct['qty']);

                //Add or delete for the old size
                $this->addOrDeleteProduct($updatedProduct['id'], $oldSize, delete: false,  quantity: $oldQuantity);

                return;
            }

            $this->addOrDeleteProduct($updatedProduct['id'], $updatedProduct['options']['size'], delete: (bool) $newQuantity,  quantity: $newQuantity);
        }

        $beforeUpdatedStatus = $this->getOrderStatus()[$order->getOriginal()['status']];
        $afterUpdatedStatus  = $this->getOrderStatus()[$order->status];

        $toCompleteSum =  $beforeUpdatedStatus != $afterUpdatedStatus;
        if(! $toCompleteSum) {
            return;
        }

        if(isset($order->options->coupon_id)) {
            $coupon = Coupon::find($order->options->coupon_id);

            if(! $afterUpdatedStatus) {
                $coupon->number_of_uses = $coupon->number_of_uses + 1;
            } else {
                $coupon->number_of_uses = $coupon->number_of_uses - 1;
            }

            $coupon->save();
        }

        foreach ($order->products as $product) {
            //if delete is true the product will be deleted and the opposite is true
            //so that is why we use !
            $this->addOrDeleteProduct($product['id'], $product['options']['size'], delete: ! $afterUpdatedStatus, quantity: $product['qty']);
        }

    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }

    protected function getOrderStatus(): array
    {
        return [
            'Requested' => false,
            'Refused'   => true,
            'Accepted'  => false,
            'InComing'  => false,
            'InLibya'   => false,
            'Arrived'   => false,
            'No Response'  => true,
            'Not Accepted' => true
        ];
    }

    protected function addOrDeleteProduct(int $productColorId, string $size, bool $delete = true, $quantity = 1): void
    {
       $productColor = ProductColors::find($productColorId);
       if(is_null($productColor)) {
           return;
       }

       foreach ($productColor->sizes as $key => $colorSize) {
            if($colorSize->size == $size) {

                if($delete) {
                    $colorSize->qty -= $quantity;
                } else {
                    $colorSize->qty += $quantity;
                }

                $newSizesToSave = $productColor->sizes;

                $newSizesToSave[$key] = $colorSize;

                $productColor->sizes = json_encode($newSizesToSave);

            }
       }

       $productColor->save();
    }
}
