@extends("layouts.canonical")

@section("content")
    <form method="POST" action="{{ route('register') }}" class="editor">
        @csrf

        <!-- Name -->
        <label for="name">Name</label>
        <input id="name" class="editor-text" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        <!-- Email Address -->
        <label for="email">Email</label>
        <input id="email" class="editor-text" type="text" name="email" value="{{ old('email') }}" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <!-- Password -->
        <label for="password">Password</label>
        <input id="password" class="editor-text"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <!-- Confirm Password -->
        <label for="password_confirmation">Confirm password</label>
        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        <button>Register</button>
        <br>
        <a href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </form>
@endsection