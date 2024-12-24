<?php

namespace App\Http\Controllers;

use App;
use App\Models\Book;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\JsonLd;
use Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home(){

        if(!Cache::has('books')){
            $books = Book::get();
            Cache::put('books', $books);
        } else {
            $books = Cache::get('books');
        }

        $template = env('TEMPLATE');
        return view($template. '.welcome' , compact('books'));
    }
    
    public function show($id){
        $book = Book::findOrFail($id);

        SEOMeta::setTitle( $book->name );
        SEOMeta::setDescription($book->name . ' isimli kitabı satın al');
        SEOMeta::setCanonical(url()->current());

        JsonLd::setType('Product');
        JsonLd::setTitle( $book->name );
        JsonLd::setDescription($book->name . ' isimli kitabı satın al');


        return view('users.books.show', compact('book'));
    }

    public function changelocale()
    {
        if(session()->get('locale') == 'tr'){
        session()->put('locale', 'en');
        } else {
        session()->put('locale', 'tr');
        }
        return redirect()->back();
    }
}
