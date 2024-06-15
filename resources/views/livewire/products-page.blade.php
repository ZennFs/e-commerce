<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
            <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
                <div class="flex flex-wrap mb-24 -mx-3">
                    <div class="w-full pr-2 lg:w-1/4 lg:block">
                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                            <h2 class="text-xl font-bold dark:text-gray-400"> Categories</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                @foreach ($categories as $category )
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{$category->slug}}" class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{$category->slug}}" value="{{$category->id}}" class="w-4 h-4 mr-2">
                                        <span class="text-md">{{$category->name}}</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-xl font-bold dark:text-gray-400">Brand</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                @foreach ($brands as $brand )
                                <li class="mb-4" wire:key="{{ $brand->id }}">
                                    <label for="{{$brand->slug}}" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="selected_brands" id="{{$brand->slug}}"
                                            value="{{$brand->id}}" class="w-4 h-4 mr-2">
                                        <span class="text-md dark:text-gray-400">{{$brand->name}}</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-xl font-bold dark:text-gray-400">Product Status</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                <li class="mb-4">
                                    <label for="" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="featured" value="1"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-md dark:text-gray-400">Featured Product</span>
                                    </label>
                                </li>
                                <li class="mb-4">
                                    <label for="" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="is_new" value="0" class="w-4 h-4 mr-2">
                                        <span class="text-md dark:text-gray-400">Second Product</span>
                                    </label>
                                </li>
                                <li class="mb-4">
                                    <label for="" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                                        <span class="text-md dark:text-gray-400">On Sale</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                            <h2 class="text-xl font-bold dark:text-gray-400">Price</h2>
                            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                            <div>
                                <div class=" font-medium mb-1">
                                    <span class="text-sm">
                                        Price Limit (Rp)
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <input type="number" wire:model.live.debounce.250ms="price_min"
                                            class="p-1.5 w-[90%] mx-auto  mb-4 bg-slate-100 border rounded focus:border-slate-300 border-slate-200 appearance-none "
                                            min="0" value="" placeholder="Min">
                                    </div>
                                    <hr
                                        class="w-[40%] items-center mx-auto self-center mb-4 mr-2.5 border-slate-300 border">
                                    <div class="justify-end">
                                        <input type="number" wire:model.live.debounce.250ms="price_max"
                                            class="p-1.5 w-[90%] mx-0.5  mb-4 bg-slate-100  border border-slate-200  focus:border-slate-300 rounded appearance-none "
                                            min="0" value="" placeholder="Max">
                                    </div>
                                </div>
                                <div>
                                    <button type="button" wire:click='set_price_one'
                                        class="mb-4 p-0.5 text-xs text-slate-600 rounded-md border border-slate-200 bg-slate-100 w-[40%]">
                                        0RB - 75RB
                                    </button>
                                    <button type="button" wire:click='set_price_two'
                                        class="mb-4 p-0.5 text-xs text-slate-600 rounded-md border border-slate-200 bg-slate-100 w-[40%]">
                                        100RB - 250RB
                                    </button>
                                </div>
                                <div>
                                    <button type="button" wire:click='set_price_three'
                                        class="mb-4 p-0.5 text-xs text-slate-600 rounded-md border border-slate-200 bg-slate-100 w-[40%]">
                                        200RB - 500RB
                                    </button>
                                    <button type="button" wire:click='set_price_four'
                                        class="mb-4 p-0.5 text-xs text-slate-600 rounded-md border border-slate-200 bg-slate-100 w-[40%]">
                                        1JT - 1,5JT
                                    </button>
                                </div>

                                <div class="flex flex-col items-center justify-between">
                                    <button type="button" wire:click='reset_price'
                                        class="w-full text-sm  font-normal p-2 rounded-lg  bg-slate-200 text-slate-700 ">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="px-3 mb-4">
                            <div class="items-center justify-between  px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                                <div class="md:flex justify-between hidden items-center">
                                    <select wire:model.live='sort'
                                        class="block w-40 text-base mx-2 bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                        <option value="latest">Sort by Latest</option>
                                        <option value="price">Sort by Price</option>
                                    </select>
                                </div>
                                <div class="flex justify-end  items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input wire:model.live.debounce.250ms="search" type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                           
                        </div>
                        <div class="flex flex-wrap items-center ">
                            @forelse ($products as $product )
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{$product->id}}">
                                <div class="border border-gray-300 dark:border-gray-700">
                                    <div class="relative bg-gray-200">
                                        <a wire:navigate href="/products/{{$product->slug}}" class="">
                                            <img src="{{ url('storage', $product->images[0])}}" alt="{{$product->name}}"
                                                class="object-cover w-full h-56 mx-auto ">
                                        </a>
                                    </div>
                                    <div class="p-3 ">
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <h3 class="text-lg font-medium dark:text-gray-400">
                                                {{Str::limit($product->name,22)}}
                                            </h3>
                                        </div>
                                        <p class="text-lg ">
                                            <span
                                                class="text-green-600 dark:text-green-600">{{Number::currency($product->price,'IDR')}}</span>
                                        </p>
                                    </div>
                                    <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                        <a href="#" wire:click.prevent="addToCart({{ $product->id }})"
                                            class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                </path>
                                            </svg><span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to Cart</span><span wire:loading wire:target='addToCart({{ $product->id }})'>Adding...</span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="flex  p-4 w-full bg-slate-100 font-medium text-xs align-middle items-center self-center  text-slate-700 "><span class="mx-auto">Product Not Found!</span></div> 
                            @endforelse


                        </div>
                        <!-- pagination start -->
                        <div class=" mx-3 mt-6">
                            {{ $products->links() }}
                        </div>
                        <!-- pagination end -->
                    </div>
                </div> 
            </div>
           
        </section>

    </div>
</div>