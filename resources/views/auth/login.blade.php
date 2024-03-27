@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="loginBox">
                 {{-- <img class="user" src="{{asset('demo/Logo lis.PNG')}}" height="100px" width="100px"> --}}
                <h3>Se connecter</h3>
                @if (session()->has('error'))
                <div class="alert alert-info">
                    <li>{{ session()->get('error') }}</li>
                </div>
                @endif
                <form action="{{route('login.store')}}" method="POST">
                    @method('post')
                    @csrf

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
                    
                        <input type="submit" name="" value="Se connecter">

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="">Mots de passe oublier?</a>
                            {{-- {{route('password')}} --}}
                        </div>
                </form>

                <div class="text-center">
                    <p style="color: #59238F;">
                         <a href="{{route('register')}}">Creer compte</a>
                    </p>
                </div>

            </div>
        </div>

    </div>

</div>




@endsection
