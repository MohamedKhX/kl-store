<?php

namespace App\Http\Livewire;

use App\Models\ProductColors;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

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
    public ?int    $colorId;
    public ?string $sizeSelected = null;
    public \App\Models\Product $product;
    public ProductColors       $color;


    //Admin
    public ?string $color_priority;
    public ?string $product_priority;
    public ?string $outer_description;

    protected $listeners = ['showProduct', 'unShowProduct', 'showProductFromCategory'];

    public function mount()
    {
        if(isset($this->product))
        {
            $this->showProduct($this->product->id, $this->colorId);
        } else {
            $this->identifier = \App\Models\Product::active()->get()->first()->id;
            $this->colorId = 1;
        }

        $this->fillAlertMessages();

    }

    public function updatedSizeSelected()
    {
        $this->unShowAlert();
    }

    public function changeColor($colorId)
    {
        $this->colorId = $colorId;
        $this->color   = $this->product->colors->where('id', '=', $colorId)->first();
        $this->unShowAlert();
        $this->fillFastUpdateFields();
    }

    public function showProduct(int $id, ?int $colorId = null)
    {
        $this->colorId      = $colorId;
        $this->identifier   = $id;
        $this->sizeSelected = null;
        $this->showProduct  = true;
        $this->unShowAlert();

        $this->product = \App\Models\Product::find($this->identifier);

        if(! $this->product->status) {
            return abort(404);
        }

        if(is_null($this->colorId))
        {
            $color = $this->product->colorsWithSizes()->first();
            if(isset($color->id)) {
                $this->colorId = $color->id;
            } else {
                abort(404);
            }
        }
        else
        {
            $color = $this->product->colors->where('id', '=', $colorId)->first();
        }


        //Check if the color available in the product
        //if not abort 404
        if(isset($color))
        {
            $this->color = $color;
        } else
        {
            abort(404);
        }

        $this->fillFastUpdateFields();
        $this->product->view(); //Add a view to views count
    }

    public function unShowProduct()
    {
        $this->showProduct = false;
    }

    public function addToCart(\App\Models\Product $product)
    {
        if(is_null($this->sizeSelected))
        {
            $this->showAlert($this->alertMessages['selectSize']);
        }
        else
        {
            $this->unShowAlert();
            $color = $this->color;

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

    public function handleFastUpdate()
    {

        if(is_null(auth()->user())) {
            abort(403);
        }

        if(auth()->user()->role !== 'admin') {
            abort(403);
        }

        $this->validate([
            'color_priority' => 'numeric',
            'product_priority' => 'numeric'
        ]);

        $this->color->priority            = $this->color_priority ?? null;
        $this->product->priority          = $this->product_priority ?? null;
        $this->product->outer_description = $this->outer_description ?? null;

        $this->emit('reRenderProductsCard');

        session()->flash('updatedProduct', 'updated');

        $this->color->save();
        $this->product->save();

    }

    public function render()
    {
        return view('livewire.product');
    }

    protected function fillFastUpdateFields()
    {
        $this->color_priority = $this->color->priority;
        $this->product_priority = $this->product->priority;
        $this->outer_description = $this->product->outer_description;
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
