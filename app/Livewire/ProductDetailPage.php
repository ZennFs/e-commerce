<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail | E-Thrifting')]
class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity = 1;
    public function mount($product){
        $this->slug = $product;
    }
    public function increaseQty(){
        $this->quantity++;
    }
    public function decreaseQty(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function addToCart($product_id){
        $total_amount = CartManagement::addItemToCartWithQty($product_id,$this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_amount)->to(Navbar::class);
        $this->alert('success', '', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Product added to the cart successfully!',
        ]);
    }
    public function render()
    {
        $data= [
            'product' => Product::where('slug', $this->slug)->firstOrFail()
        ];
        return view('livewire.product-detail-page',$data);
    }
}
