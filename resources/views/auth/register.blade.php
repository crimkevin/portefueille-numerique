@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="loginBox">
                 {{-- <img class="user" src="{{asset('demo/Logo lis.PNG')}}"  height="100px" width="100px"> --}}
                <h3>Nouvel Utulisateur</h3>
                @if (session()->has('success'))
                <div class="alert alert-info">
                    <li>{{ session()->get('success') }}</li>
                </div>
                @endif

                <form action="{{route('register.store')}}" method="post"">

                    @method('post')
                    @csrf
                    <div class="row">

                                <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" id="name" name="name">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                    <label for="userSurname" class="form-label">userSurname</label>
                                    <input type="text" class="form-control shadow-none" id="userSurname" name="userSurname">
                                    @error('userSurname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4 pb-2">
                                    <div class="form-group">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control shadow-none" id="email" name="email">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                            <div class="col-lg-6 mb-4 pb-2">
                                <div class="form-group">
                                <label for="password" class="form-label">password</label>
                                <input type="password" class="form-control shadow-none" id="password" placeholder="password" value="{{old('')}}" name="password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4 pb-2">
                                <div class="form-group">
                                <label for="adrUser" class="form-label">adrUser</label>
                                <input type="adrUser" class="form-control shadow-none" id="adrUser" placeholder="adrUser" name="adrUser">
                                @error('adrUser')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 pb-2">
                                <div class="form-group">
                                <label for="secretCode" class="form-label">secretCode</label>
                                <input type="password" class="form-control shadow-none" id="secretCode" name="secretCode">
                                @error('secretCode')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 pb-2">
                                <div class="form-group">
                                <label for="accountNumber" class="form-label">accountNumber</label>
                                <input type="text" class="form-control shadow-none" id="accountNumber" name="accountNumber">
                                @error('accountNumber')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 pb-2">
                                <div class="form-group">
                                <label for="accountStatue" class="form-label">accountStatue</label>
                                <input type="text" class="form-control shadow-none" id="accountNumber" name="accountStatue">
                                @error('accountStatue')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                           </div>
                    </div>
                  </form>

                <div class="text-center">
                    <p style="color: #59238F;">Avez vous deja un compte?
                         <a href="{{route('login')}}">Se connecter</a>
                    </p>
                </div>

            </div
        </div>
    </div>
</div>

>


@endsection
