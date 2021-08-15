<x-app-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>Books</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <form action="{{route('dashboard.bookEditor')}}" method="get">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Search</label>
                                    <input name="bookSearch"
                                           @if(isset($_GET['bookSearch'])) value="{{$_GET['bookSearch']}}"
                                           @endif type="text" class="form-control" id="exampleFormControlInput1"
                                           placeholder="Type something">
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Choose category</div>
                                    <select name="bookCategory" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->name}}"
                                                    @if(isset($_GET['bookCategory'])) @if($_GET['bookCategory'] == $category->name) selected @endif @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Choose filter</div>
                                    <select name="bookFilter" class="form-select form-select-sm"
                                            aria-label=".form-select-sm example">
                                        <option value="default"></option>
                                        <option value="name-a-z"
                                                @if(isset($_GET['bookFilter'])) @if($_GET['bookFilter'] == 'name-a-z') selected @endif @endif>
                                            Name: A-Z
                                        </option>
                                        <option value="name-z-a"
                                                @if(isset($_GET['bookFilter'])) @if($_GET['bookFilter'] == 'name-z-a') selected @endif @endif>
                                            Name: Z-A
                                        </option>


                                    </select>
                                </div>
                                <button type="submit" class="btn btn_search btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <div><a href="{{route('dashboard.bookEditor.addBook')}}" class="btn btn-success float-right">Add Book</a></div>
                            <table style="width: 100%;" class="table table-stripped ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($books))
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{$book->id}}</td>
                                            <td style="width: 25%;">
                                                @isset($book->image)
                                                    <img class="img-fluid" alt="" style="width: 200px;" src="{{asset('/storage/' . $book->image)}}">
                                                @endisset
                                            </td>
                                            <td>{{$book->name}}</td>
                                            <td style="width:80%;">{{$book->description}}</td>
                                            <td>
                                                @foreach($book->categories as $category)
                                                    <p class="card-text">{{$category->name}}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($book->authors as $author)
                                                    <p class="card-text">{{$author->name}}</p>
                                                @endforeach</td>
                                            <td style="width:100%;">
                                                <nobr>
                                                    <a href="{{route('dashboard.bookEditor.editBook', $book->id)}}"
                                                       class="btn btn-success">Edit</a>
                                                    <form id="bookDeleteForm" action="{{route('dashboard.bookEditor.deleteBook',$book->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-danger" type="submit" value="Delete">
                                                    </form>
                                                </nobr>
                                            </td>
                                        </tr>


                                    @endforeach
                                @else

                                    <tr>
                                        <td colspan="6">No posts found</td>

                                    </tr>
                                @endif


                                </tbody>
                            </table>
                            {{$books->withQueryString()->appends(Request::query())->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="post_delete_form" method="post" action="">
        @csrf
        @method('DELETE')
    </form>
</x-app-layout>
