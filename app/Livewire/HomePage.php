<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home | E-Thrifting')]
class HomePage extends Component
{
    public function render()
    {
        $data = [
            'brands' => Brand::where('is_active', 1)->get(),
            'categories' => Category::where('is_active', 1)->get()
        ];
        return view('livewire.home-page',$data);
    }
}
