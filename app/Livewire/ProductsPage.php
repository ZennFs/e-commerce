<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

#[Title('Products | E-Thrifting')]
class ProductsPage extends Component
{
    use LivewireAlert;

    public int $perPage = 9;
    public $search = '';

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $is_new;

    #[Url]
    public  $price_min = null;

    #[Url]
    public $price_max = null;

    #[Url]
    public $sort = 'latest';


    public function addToCart($product_id){
        $total_amount = CartManagement::addItemToCart($product_id);
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
        $query = Product::query()
        ->where('is_active', 1)
        ->search($this->search);
        #categories
        if(!empty($this->selected_categories)){
            $query->whereIn('category_id', $this->selected_categories);
        }
        #brands
        if(!empty($this->selected_brands)){
            $query->whereIn('brand_id', $this->selected_brands);
        }
        #sale
        if($this->on_sale){
            $query->where('on_sale', 1);
        }
        #secondary
        if($this->is_new){
            $query->where('is_new', 0);
        }
        #featured
        if($this->featured){
            $query->where('is_featured', 1);
        }
        #price min max
        if(isset($this->price_min) && isset($this->price_max)){
            $query->whereBetween('price', [$this->price_min, $this->price_max]);
        }else if(isset($this->price_min)){
            $query->where('price', '>=', $this->price_min);
        }else if(isset($this->price_max)){
            $query->where('price', '<=', $this->price_max);
        }
        #sort_by
        if($this->sort == 'latest'){

            $query->latest();
        }else if($this->sort == 'price'){
            $query->orderBy('price', 'ASC');
        } 
        #data
        $data = [
            'products' => $query->paginate($this->perPage),
            'brands' => Brand::where('is_active', 1)->get(['id','name','slug']),
            'categories' => Category::where('is_active', 1)->get(['id','name','slug'])
        ];
        
        return view('livewire.products-page',$data);
    }

    public function set_price_one(){
        $this->price_min = 0;
        $this->price_max = 75000;
    }
    public function set_price_two(){
        $this->price_min = 100000;
        $this->price_max = 150000;
    }
    public function set_price_three(){
        $this->price_min = 200000;
        $this->price_max = 500000;
    }
    public function set_price_four(){
        $this->price_min = 1000000;
        $this->price_max = 1500000;
    }
    public function reset_price(){
        $this->price_min = null;
        $this->price_max = null;
    }
    
    
     #life cycle hooks
    //  public function updatingSearch()
    //  {
    //      $this->resetPage();
    //  }
    //  public function updatedSelectedCategories(){
    //     $this->resetPage();
    //  }
}
