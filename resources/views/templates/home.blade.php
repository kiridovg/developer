@extends('layouts.layout')

@section('title', 'Home')

@section('container')
    <div class="container">
        <h1 class="text-center mt-3">Books</h1>
        <form action="{{route('showBook')}}" method="get">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Search</label>
                <input name="search_field" @if(isset($_GET['search_field'])) value="{{$_GET['search_field']}}" @endif type="text" class="form-control" id="exampleFormControlInput1" placeholder="Type something">
            </div>
            <div class="mb-3">
                <div class="form-label">Choose category</div>
                <select name="category_name" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option></option>
                    @foreach($categories as $category)
                        <option value="{{$category->name}}" @if(isset($_GET['category_name'])) @if($_GET['category_name'] == $category->name) selected @endif @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-label">Choose filter</div>
                <select name="filter_name" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="default"></option>
                    <option value="name-a-z" @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'name-a-z') selected @endif @endif>Name: A-Z</option>
                    <option value="name-z-a" @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'name-z-a') selected @endif @endif>Name: Z-A</option>


                </select>
            </div>
            <button type="submit" class="btn btn_search btn-primary">Submit</button>
            <div class="results mt-3">Showing <span>{{$books->count()}}</span> results</div>
        </form>
    </div>
    </div>
    <div>
    </div>
    <div class="product_item row col align-items-start d-flex align-items-stretch">
        @foreach($books as $book)
            <div class="card mx-auto mt-3 mb-3 d-flex flex-column" style="width: 18rem;">
                <img src="https://99px.ru/sstorage/53/2014/05/tmb_102421_3124.jpg" class="card-img-top mt-3" alt="">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{$book->name}}</h5>
                    <p class="card-text">{{$book->description}}</p>
                    <p class="card-text"></p>
                    @foreach($book->authors as $author)
                        <p class="card-text">Автор: {{$author->name}}</p>
                    @endforeach
                    <p class="card-text">Категории:</p>
                    @foreach($book->categories as $category)
                        <p class="card-text">{{$category->name}}</p>
                    @endforeach
                    <a href="#" class="btn btn-primary mt-auto">Переход куда-нибудь</a>
                </div>
            </div>
        @endforeach
    </div>
    {{$books->withQueryString()->links('layouts.pagination')}}


@endsection
