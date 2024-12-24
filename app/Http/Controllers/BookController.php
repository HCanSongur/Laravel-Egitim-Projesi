<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Imports\BookImport;
use App\Models\Book;
use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use Maatwebsite\Excel\Facades\Excel;
use function abort;



class BookController extends Controller
{
    public function index(){
      $user = auth()->user();
      $books = $user->books()->withTrashed()->get();
      return view('books.index' , compact('books'));
    }
    
    public function create(){
      return view('books.create');
    }
    
    public function store(BookStoreRequest $request){
      $book = new Book();
      $book->name = $request->name;
      $book->price = $request->price;
      $book->user_id = auth()->id();
      $book->save();

      Cache::delete('books');

      return redirect()->back();
    }
    
    public function edit(Book $book){
      $user = auth()->user();
      if(!$user->books()->pluck('id')->contains($book->id)) {         //implicit binding
       abort(404);
      }
       
       return view('books.edit',compact('book'));
    }

    public function update(Request $request, Book $book){
      $user = auth()->user();
      if(!$user->books()->pluck('id')->contains($book->id)) {         //implicit binding
       abort(404);
      }
      $book->name = $request->name;
      $book->price = $request->price;
      $book->save();

      return redirect()->back();
    }

    public function delete(Book $book){
      $book->delete();
      Cache::delete('books');
      return redirect()->back();
    }

    public function restore(Book $book){
      $book->restore();
      Cache::delete('books');
      return redirect()->back();  
    }

    public function export()
    {
      return Excel::download (new BookExport, 'kitaplar.xlsx');
    }
    
    public function import(Request $request)
      {
      Excel::import(new BookImport, $request->file('file'));
        
      return redirect()->back()->with('success', 'Başarıyla içeriye aktarma yapıldı');
    }
}

