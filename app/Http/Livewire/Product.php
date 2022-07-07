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

    protected $listeners = ['showProduct', 'unShowProduct', 'showProductFromCategory'];

    public function mount()
    {
        $this->identifier = \App\Models\Product::active()->get()->first()->id;
        $this->colorId = 1;

        $this->fillAlertMessages();
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

    public function showProduct(int $id)
    {
        $this->colorId      = 1;
        $this->identifier   = $id;
        $this->sizeSelected = null;
        $this->showProduct  = true;
        $this->unShowAlert();

        \App\Models\Product::find($id)->view(); //Add a view to views count
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
                    'product_id' => $product->id,
                    'product_url'=> $color->url,
                ],
            ])->associate('App/Models/Product');
            $this->showAlert($this->alertMessages['AddedToCart'], 'success');
            $this->emit('newItemAddedToCart');
        }
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



    protected function fillAlertMessages()
    {
        $addedToCart = __('cart.product_added_to_cart');
        $openCart    = __('cart.open_cart');

        $this->alertMessages = [
            'selectSize'    => __('cart.please_select_size'),
            'AlreadyInCart' => __('cart.this_product_in_you_cart'),
            'AddedToCart'   => "
                <div>{$addedToCart}</div>
                <a data-bs-toggle='modal' data-bs-target='#CartModel' href=''>
                    <strong>{$openCart}</strong>
                </a>
            ",
        ];
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
}
