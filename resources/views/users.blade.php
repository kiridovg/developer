<x-app-layout>
    <div class="container">
        <form action="{{route('dashboard.users')}}" method="get">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Search</label>
                <input name="search_field" @if(isset($_GET['search_field'])) value="{{$_GET['search_field']}}"
                       @endif type="text" class="form-control" id="exampleFormControlInput1"
                       placeholder="Type something">
            </div>
            <div class="mb-3">
                <div class="form-label">Choose category</div>
                <select name="category_name" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option></option>
                    <option value="@gmail.com"
                            @if(isset($_GET['category_name'])) @if($_GET['category_name'] == '@gmail.com') selected @endif @endif>email@gmail.com</option>
                    <option value="@yandex.ru"
                            @if(isset($_GET['category_name'])) @if($_GET['category_name'] == '@yandex.ru') selected @endif @endif>email@yandex.ru</option>
                    <option value="@mail.ru"
                            @if(isset($_GET['category_name'])) @if($_GET['category_name'] == '@mail.ru') selected @endif @endif>email@mail.ru</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-label">Choose filter</div>
                <select name="filter_name" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="default"></option>
                    <option value="id"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'id') selected @endif @endif>
                        id⬆
                    </option>
                    <option value="id-desc"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'id-desc') selected @endif @endif>
                        id⬇
                    </option>
                    <option value="name-a-z"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'username-a-z') selected @endif @endif>
                        Username: A-Z
                    </option>
                    <option value="name-z-a"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'username-z-a') selected @endif @endif>
                        Username: Z-A
                    </option>
                    <option value="email"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'email') selected @endif @endif>
                        Email: A-Z
                    </option>
                    <option value="email-desc"
                            @if(isset($_GET['filter_name'])) @if($_GET['filter_name'] == 'email-desc') selected @endif @endif>
                        Email: Z-A
                    </option>



                </select>
            </div>
            <button type="submit" class="btn btn_search btn-primary">Submit</button>
            <div class="results mt-3">Showing <span>{{$books->count()}}</span> results</div>
        </form>
        <div class="container">
            <form method="POST" action="{{ route('adduser') }}">
                @csrf
                <div class="product_item row col align-items-start d-flex align-items-stretch">
                    <h1 class="text-center mt-3">Users</h1>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th scope="row">{{$book->id}}</th>
                                <td>{{$book->name}}</td>
                                <td>{{$book->email}}</td>
                                <td>{{$book->password}} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row">ADD</th>
                            <td><input id="name" class="block mt-1 w-full" type="text" name="name"
                                       placeholder="Type login" required autofocus/></td>
                            <td><input id="email" class="block mt-1 w-full" type="email" name="email"
                                       placeholder="Type email" required /></td>
                            <td><input id="password" class="block mt-1 w-full"
                                       type="password"
                                       name="password"
                                       placeholder="Type password"
                                       required autocomplete="new-password"/>
                                <input id="password_confirmation" class="block mt-1 w-full"
                                       type="password"
                                       name="password_confirmation" required
                                       placeholder="Type password"/>
                                <button type="submit" class="btn btn_search btn-primary">Add user</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <form method="POST" action="{{ route('updateuser') }}">
            @csrf
                <div class="row col align-items-start d-flex align-items-stretch">
                    <h1 class="text-center mt-3">User update</h1>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><input id="id" class="block mt-1 w-full col-md-4" type="text" name="id"
                                                   placeholder="Type id" required autofocus/></th>
                            <td><input id="login" class="block mt-1 w-full" type="text" name="login"
                                       placeholder="Type login" required autofocus/></td>
                            <td><input id="email" class="block mt-1 w-full" type="email" name="email"
                                       placeholder="Type email" required /></td>
                            <td><input id="password" class="block mt-1 w-full"
                                       type="password"
                                       name="password"
                                       placeholder="Type password"
                                       required autocomplete="new-password"/>
                                <input id="password_confirmation" class="block mt-1 w-full"
                                       type="password"
                                       name="password_confirmation" required
                                       placeholder="Type password"/>
                                <button type="submit" class="btn btn_search btn-primary">Update user</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
