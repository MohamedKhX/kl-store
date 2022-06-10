<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Product extends Component
{

    public bool   $showAlert     = false;
    public string $alertMessage  = '';
    public string $alertType     = 'danger';
    public array  $alertMessages = [
        'selectSize'    => 'Please select a size!',
        'AlreadyInCart' => 'This product is already in your cart!',
        'AddedToCart'   => '<div>Product added to cart</div>
                            <a class="" data-bs-toggle="modal" data-bs-target="#CartModel" href="#">
                               <strong>Open Cart</strong>
                            </a>'
    ];

    public bool    $showProduct = false;
    public string  $identifier;
    public int     $colorId;
    public ?string $sizeSelected = null;

    protected $listeners = ['SingleProduct', 'unShowProduct', 'showProductFromCategory'];

    public function mount()
    {
        $this->identifier = \App\Models\Product::first()->id;
        $this->colorId = 1;
    }

    public function showProductFromCategory($id)
    {
        $this->colorId = 1;
        $this->identifier = $id;
        $this->sizeSelected = null;
        $this->unShowAlert();

        $this->showProduct = true;
    }

    protected function showAlert(string $message, string $alertType = 'danger')
    {
        $this->showAlert    = true;
        $this->alertMessage = $message;
        $this->alertType    = $alertType;
    }

    protected function unShowAlert()
    {
        $this->showAlert = false;
    }

    public function updatedSizeSelected()
    {
        $this->unShowAlert();
    }


    public function reRender($colorId)
    {
        $this->colorId = $colorId;
        $this->unShowAlert();
    }

    public function unShowProduct()
    {
        $this->showProduct = false;
    }

    public function SingleProduct(int $id)
    {
        $this->colorId = 1;
        $this->identifier = $id;

        \App\Models\Product::find($id)->view();

        $this->sizeSelected = null;
        $this->unShowAlert();

        $this->showProduct = true;
    }

    public function render($id = null)
    {

        if(! isset($this->product)) {
           $product = \App\Models\Product::find($this->identifier);
        }

        if(isset($product->colors[$this->colorId - 1])) {
            $color = $product->colors[$this->colorId - 1];
        } else {
            abort(404);
        }

        return view('livewire.product')->with([
            'product' => $product,
            'color'   => $color,
        ]);
    }


    public function addToCart(\App\Models\Product $product)
    {
        if(is_null($this->sizeSelected)) {
            $this->showAlert($this->alertMessages['selectSize']);
        }
        else {
            $this->unShowAlert();
            $color = $product->colors[$this->colorId - 1];


            $duplicates = Cart::search(function($cartItem, $rowId) use($color) {
                if($cartItem->id === $color->id) {
                    if($cartItem->options['size'] === $this->sizeSelected) {
                        return $cartItem;
                    }
                }
                return false;
            });

            if(count($duplicates) >= 1) {
                $this->showAlert($this->alertMessages['AlreadyInCart']);
                return;
            }

            $item = Cart::add([
                'id' => $color->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => (int) $color->priceWithOutCurrency(),
                'options' => [
                    'size'       => $this->sizeSelected,
                    'thumbnail'  => $color->images[0],
                    'product_id' => $product->id
                ],
            ])->associate('App/Models/Product');
            $this->showAlert($this->alertMessages['AddedToCart'], 'success');
            $this->emit('newItemAddedToCart');
        }
    }
}
