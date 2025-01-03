@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class="row">
                  <div class="col-6">{{ __('Kitap Düzenle') }}</div>
                  <div class="col-6 d-flex justify-content-end"><a href="{{route('books.index')}}" class = "btn btn-info">Kitaplar</a></div>
                </div>
                </div>
                <div class="card-body">
                 <h1>Kitap Düzenle</h1>
                 <form action="{{ route('books.update' , $book->id) }}" method="POST">
                 @csrf
                 <div class="form-group">
                    <label for="">Kitabın Adı</label>
                    <input type="text" name="name" value="{{$book->name}}" class="form-control" placeholder="Kitabın İsmi">
                 </div>
                <div class="form-group">
                    <label for="">Kitabın Fiyatı</label>
                    <input type="text" name="price" value="{{$book->price}}" class="form-control" placeholder="Kitabın İsmi">
                 </div>
                 <td><button type="submit" class="btn btn-success mt-1">Güncelle</button></td>
                 </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection