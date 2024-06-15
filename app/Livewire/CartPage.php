<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart | E-Thrifting')]
class CartPage extends Component
{
    use LivewireAlert;
    public $cart_items = [];
    public $grand_total;

    public function mount(){
       $this->cart_items =  CartManagement::getCartItemsFromCookies();
       $this->grand_total =  CartManagement::calculateCartTotal($this->cart_items);
    }
    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total =  CartManagement::calculateCartTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
        $this->alert('success', '', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Product deleted successfully!',
        ]);
    }
    public function incrementQty($product_id){
        $this->cart_items = CartManagement::incrementCartItemQuantity($product_id);
        $this->grand_total =  CartManagement::calculateCartTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }
    public function decrementQty($product_id){
        $this->cart_items = CartManagement::decrementCartItemQuantity($product_id);
        $this->grand_total =  CartManagement::calculateCartTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }
    public function render()
    {
        return view('livewire.cart-page');
    }
}
