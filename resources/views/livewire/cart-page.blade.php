<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold">Product</th>
                                    <th class="text-left font-semibold">Price</th>
                                    <th class="text-left font-semibold">Quantity</th>
                                    <th class="text-left font-semibold">Total</th>
                                    <th class="text-left font-semibold">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart_items as $item )
                                <tr wire:key="{{ $item['product_id'] }}">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 mr-4" alt="{{$item['name']}}" 
                                            src="{{ url('storage', $item['images'][0]) }}"
                                                alt="{{$item['name']}}">
                                            <span class="font-semibold">{{$item['name']}}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">{{Number::currency($item['price'],'IDR', 2, ',','.')}}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            @if ($item['quantity'] > 1) 
                                            <button  wire:click='decrementQty({{$item['product_id']}})'  class="border rounded-md py-2 px-4 mr-2">-</button>
                                            @endif
                                            <span class="text-center w-8">{{$item['quantity']}}</span>
                                            <button wire:click='incrementQty({{$item['product_id']}})' class="border rounded-md py-2 px-4 ml-2">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($item['total_amount'], 'IDR', 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        <button wire:click="removeItem({{$item['product_id']}})"
                                            class="bg-neutral-100  border-2 border-neutral-200 rounded-lg px-3 py-1 hover:bg-red-600 hover:text-white hover:border-red-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                              </svg>
                                              </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No items in cart</td>
                                </tr>
                                @endforelse
                               
                                <!-- More product rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>{{ Number::currency($grand_total, 'IDR', 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Taxes</span>
                            <span>{{ Number::currency(0, 'IDR', 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Shipping</span>
                            <span>{{ Number::currency(0, 'IDR', 2, ',', '.') }}</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Grand Total</span>
                            <span class="font-semibold">{{ Number::currency($grand_total, 'IDR', 2, ',', '.') }}</span>
                        </div>
                        @if ($cart_items)
                        <a href="/checkout" class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>