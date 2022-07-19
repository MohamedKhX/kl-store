<?php

namespace App\Observers;

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
        foreach ($order->products as $product) {
            $this->addOrDeleteProduct($product['id'], $product['options']['size']);
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
        $beforeUpdatedStatus = $this->getOrderStats()[$order->getOriginal()['status']];
        $afterUpdatedStatus  = $this->getOrderStats()[$order->status];

        $toCompleteSum =  $beforeUpdatedStatus != $afterUpdatedStatus;

        if(! $toCompleteSum) {
            return;
        }

        foreach ($order->products as $product) {
            //if delete is true the product will be deleted and the opposite is true
            //so that is why we !
            $this->addOrDeleteProduct($product['id'], $product['options']['size'], delete: ! $afterUpdatedStatus);
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

    protected function getOrderStats(): array
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

    protected function addOrDeleteProduct(int $productColorId, string $size, bool $delete = true): void
    {
       $productColor = ProductColors::find($productColorId);

       foreach ($productColor->sizes as $key => $colorSize) {
            if($colorSize->size == $size) {

                if($delete) {
                    $colorSize->qty -= 1;
                } else {
                    $colorSize->qty += 1;
                }

                $newSizesToSave = $productColor->sizes;

                $newSizesToSave[$key] = $colorSize;

                $productColor->sizes = json_encode($newSizesToSave);

            }
       }

       $productColor->save();
    }
}
