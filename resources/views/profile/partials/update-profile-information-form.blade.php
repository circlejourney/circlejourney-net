<h2>Update profile</h2>
<p>Update your account's profile information and email address.</p>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="editor">
    @csrf
    @method('patch')

    <label for="name">Name</label>
    <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('name')" />

    <label for="email">Email</label>
    <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" />

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <p>
            {{ __('Your email address is unverified.') }}

            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Click here to re-send the verification email.') }}
            </button>
        </p>

        @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
        @endif
    @endif

    <x-primary-button>{{ __('Save') }}</x-primary-button>

    @if (session('status') === 'profile-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        >{{ __('Saved.') }}</p>
    @endif
</form>