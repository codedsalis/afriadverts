@extends('layouts.app-guest')

@section('title', 'Login')

@section('content')
    <div class="flex justify-around mt-12">

        <div class="flex flex-col rounded-md shadow-lg w-2/3 md:w-2/4 lg:w-2/5 xl:w-1/3">
            <div class="bg-gray-200 p-3 rounded-b-none rounded-t-md text-2xl">
                {{ __('Login') }}
            </div>
            <div class="bg-white p-4 rounded-b-md">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <br />
                    <input id="email" type="email"
                        class="border border-gray-300 w-full rounded p-3 @error('email') border border-red-700 @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <br />

                    @error('email')
                    <br />
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <br />
                    <label for="password">{{ __('Password') }}</label>
                    <br />
                    <input id="password" type="password"
                        class="border border-gray-300 w-full rounded p-3 @error('password') border border-red-700 @enderror"
                        name="password" required>

                    @error('password')
                    <br />
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <br />
                    <div class="flex">
                        <div class="flex-1">
                            <input class="m-4 mr-0" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="flex-1 m-4">
                            <a class="text-aa-light hover:text-aa-light-active" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <br />
                    <div class="flex flex-wrap">
                        <div class="flex-1">
                            <button type="submit"
                                class="animation w-full bg-aa-dark text-white p-2 hover:bg-aa-darker focus:bg-dark-800 hover:scale-110">
                                <i class="fa fa-user"></i> {{ __('Login') }}
                            </button>
                        </div>

                        <div class="flex-1">
                            @if (Route::has('password.request'))
                                <a href="{{ route('register') }}">
                                    <button type="button"
                                        class="animation flex-shrink-0 w-full bg-aa-light text-white p-2 hover:bg-aa-light-active focus:bg-aa-light-active hover:scale-110">
                                        <i class="fa fa-key"></i> Register
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
