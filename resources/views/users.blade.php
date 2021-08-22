<x-app-layout>
    <div class="container">
        <form action="{{route('dashboard.users')}}" method="get">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Search</label>
                <input name="userSearch" @if(isset($_GET['userSearch'])) value="{{$_GET['userSearch']}}"
                       @endif type="text" class="form-control" id="exampleFormControlInput1"
                       placeholder="Type something">
            </div>
            <div class="mb-3">
                <div class="form-label">Choose category</div>
                <select name="userCategory" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option></option>
                    <option value="@gmail.com"
                            @if(isset($_GET['userCategory'])) @if($_GET['userCategory'] == '@gmail.com') selected @endif @endif>email@gmail.com</option>
                    <option value="@yandex.ru"
                            @if(isset($_GET['userCategory'])) @if($_GET['userCategory'] == '@yandex.ru') selected @endif @endif>email@yandex.ru</option>
                    <option value="@mail.ru"
                            @if(isset($_GET['userCategory'])) @if($_GET['userCategory'] == '@mail.ru') selected @endif @endif>email@mail.ru</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-label">Choose filter</div>
                <select name="userFilter" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="default"></option>
                    <option value="id"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'id') selected @endif @endif>
                        id⬆
                    </option>
                    <option value="id-desc"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'id-desc') selected @endif @endif>
                        id⬇
                    </option>
                    <option value="name-a-z"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'username-a-z') selected @endif @endif>
                        Username: A-Z
                    </option>
                    <option value="name-z-a"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'username-z-a') selected @endif @endif>
                        Username: Z-A
                    </option>
                    <option value="email"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'email') selected @endif @endif>
                        Email: A-Z
                    </option>
                    <option value="email-desc"
                            @if(isset($_GET['userFilter'])) @if($_GET['userFilter'] == 'email-desc') selected @endif @endif>
                        Email: Z-A
                    </option>



                </select>
            </div>
            <button type="submit" class="btn btn_search btn-primary">Submit</button>
            <div class="results mt-3">Showing <span>{{$users->count()}}</span> results</div>
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
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->password}} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row">ADD</th>
                            <td><input id="name" class="block mt-1 w-full" type="text" name="name"
                                       placeholder="Type login" required autofocus/></td>
                            <td><input id="emailAdd" class="block mt-1 w-full" type="email" name="email"
                                       placeholder="Type email" required /></td>
                            <td><input id="passwordAdd" class="block mt-1 w-full"
                                       type="password"
                                       name="password"
                                       placeholder="Type password"
                                       required autocomplete="new-password"/>
                                <input id="password_confirmationAdd" class="block mt-1 w-full"
                                       type="password"
                                       name="password_confirmation" required
                                       placeholder="Type password"/>
                                <button type="submit" class="btn btn_search btn-primary">Add user</button>
                            </td>
                        </tr>
                    </table>
                    {{$users->withQueryString()->links('layouts.pagination')}}
                </div>
            </form>

            <form method="POST" action="{{route('updateuser')}}">
                {{ csrf_field() }}
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
