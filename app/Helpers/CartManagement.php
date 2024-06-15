<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement{
    // add item to cart
    static public function addItemToCart($product_id){
        $cart_items = self::getCartItemsFromCookies();
        $existing_item = null;
        foreach($cart_items as $key =>  $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null){
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity']*
            $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::where('id',$product_id)->first(['id','name','price','images']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'images' => $product->images,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }
        self::addCartItemsToCookies($cart_items);
        return count($cart_items);
    }
    // add item to cart with qty
    static public function addItemToCartWithQty($product_id,$qty = 1){
        $cart_items = self::getCartItemsFromCookies();
        $existing_item = null;
        foreach($cart_items as $key =>  $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null){
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity']*
            $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::where('id',$product_id)->first(['id','name','price','images']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'images' => $product->images,
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }
        self::addCartItemsToCookies($cart_items);
        return count($cart_items);
    }

    // remove item from cart
    static public function removeCartItem ($product_id){
        $cart_items = self::getCartItemsFromCookies();
        foreach($cart_items as $key =>  $item){
            if($item['product_id'] == $product_id){
                unset($cart_items[$key]);
            }
        }
        self::addCartItemsToCookies($cart_items);
        return $cart_items;
    }

    // add cart item to cookies
    static public function addCartItemsToCookies($cart_items){
        Cookie::queue('cart_items',json_encode($cart_items), 60 * 24 * 30);
    }

    // clear cart item from cookies
    static public function clearCartItemsFromCookies(){
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get cart items from cookies
    static public function getCartItemsFromCookies(){
        $cart_items = Cookie::get('cart_items');
        if($cart_items){
            return json_decode($cart_items, true);
        }
        return [];
    }

    // increment cart item quantity
    static public function incrementCartItemQuantity($product_id){
        $cart_items = self::getCartItemsFromCookies();
        foreach($cart_items as $key =>  $item){
            if($item['product_id'] == $product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity']*$cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCookies($cart_items);
        return $cart_items;
    } 

    // decrement cart item quantity
    static public function decrementCartItemQuantity($product_id){
        $cart_items = self::getCartItemsFromCookies();
        foreach($cart_items as $key =>  $item){
            if($item['product_id'] == $product_id){
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity']*$cart_items[$key]['unit_amount'];
                }
            }
        } 
        self::addCartItemsToCookies($cart_items);
        return $cart_items;
    } 

    // calculate cart total
    static public function calculateCartTotal($items){
       return array_sum(array_column($items, 'total_amount')); 
    }
}