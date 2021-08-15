<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex justify-content-between" >
                            <div>Edit Book </div>
                            <div><a href="{{route('dashboard.bookEditor')}}" class="btn btn-success">Back</a></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('posts.update',$id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mt-2">
                                <label for="title">Title :</label>
                                <input type="text" value="{{old('title')}}" class="form-control"  id="title" placeholder="Enter title" name="title" >
                                @if($errors->any('title'))
                                    <span class="text-danger"> {{$errors->first('title')}}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="description">Description :</label>
                                <textarea class="form-control" id="description" placeholder="Enter description" name="description">{{old('description')}}</textarea>
                                @if($errors->any('description'))
                                    <span class="text-danger"> {{$errors->first('description')}}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="image">Image :</label>
                                <input type="file" class="form-control " id="image" placeholder="Choose an image" name="image" >
                                @if($errors->any('image'))
                                    <span class="text-danger"> {{$errors->first('image')}}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="category">Category :</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select Category</option>

                                    @if(count($categories))
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"  {{(old('category') && old('category')==$category->id )?'selected':''}}  >{{$category->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @if($errors->any('category'))
                                    <span class="text-danger"> {{$errors->first('category')}}</span>
                                @endif
                            </div>
                            <div class="form-group mt-2">
                                <label for="author">Author :</label>
                                <select class="form-control" id="author" name="author">
                                    <option value="">Select Author</option>

                                    @if(count($authors))
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}"  {{(old('author') && old('author')==$author->id )?'selected':''}}  >{{$author->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @if($errors->any('author'))
                                    <span class="text-danger"> {{$errors->first('author')}}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
