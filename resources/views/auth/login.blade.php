@extends('layouts.app')

@section('content')
<div class="flex justify-around">

        <div class="flex flex-col rounded-md shadow-lg w-2/3 md:w-2/4 lg:w-2/5 xl:w-1/3">
            <div class="bg-gray-200 p-3 rounded-b-none rounded-t-md text-2xl">
                {{ __('Login') }}
            </div>
                <div class="bg-white p-4 rounded-b-md">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <br/>
                            <input id="email" type="email" class="border border-gray-300 w-full rounded p-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <br/>

                                @error('email')
                                    <br/>
                                    <span class="text-red-700" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br/>
                            <label for="password">{{ __('Password') }}</label>
                            <br/>
                            <input id="password" type="password" class="border border-gray-300 w-full rounded p-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                    <br/>
                                    <span class="text-red-700" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            <br/>
                            <input class="m-4 mr-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Remember Me') }}
                            </label>

                            <br/>
                            <div class="flex flex-wrap">
                                <div class="flex-1">
                                    <button type="submit" class="w-full bg-aa-dark text-white p-2 hover:bg-aa-darker focus:bg-aa-darker">
                                    <i class="fa fa-user"></i> {{ __('Login') }}
                                    </button>
                                </div>

                                <div class="flex-2">
                                    @if (Route::has('password.request'))
                                        <a class="text-aa-light" href="{{ route('password.request') }}">
                                            <button type="button" class="flex-shrink-0 w-full bg-aa-light text-white p-2 hover:bg-aa-light-active focus:bg-aa-light-active">
                                                <i class="fa fa-key"></i> Retrieve Password
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
