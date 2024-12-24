<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function index() { // sepet sayfası
        $books = Cart::content();
        $template = env('TEMPLATE');
        return view($template. '.cart' , compact('books'));                     
    }

    public function addtocart($id){
        $book = Book::notDeleteds()->findOrFail($id);
        Cart::add($book->id, $book->name, 1, $book->price, []);
        return redirect()->back();
    }
 
    public function removefromcart($row_id){
        Cart::remove($row_id);

        return redirect()->back();
    }

    public function updatecart($row_id, $type){
        $item = Cart::get($row_id);

        switch ($type) {
            case 'increase':
                Cart::update($row_id, $item->qty+1);
                break;
            default:
                Cart::update($row_id, $item->qty-1);
                break;
        }

        return redirect()->back();
    }


}