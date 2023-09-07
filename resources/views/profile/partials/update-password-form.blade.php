<h2>Update password</h2>

<p>
    {{ __('Ensure your account is using a long, random password to stay secure.') }}
</p>

<form method="post" action="{{ route('password.update') }}" class="editor">
    @csrf
    @method('put')
    <x-input-label for="current_password" :value="__('Current Password')" />
    <x-text-input id="current_password" name="current_password" type="password" class="editor-text" autocomplete="current-password" />
    <x-input-error :messages="$errors->updatePassword->get('current_password')" />

    <x-input-label for="password" :value="__('New Password')" />
    <x-text-input id="password" name="password" type="password" class="editor-text" autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="editor-text" autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>