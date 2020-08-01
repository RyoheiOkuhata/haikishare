@if (session('flash_message--success'))
        <li class="p-form--item">
            <p class="flash_message--success">
            {{ session('flash_message--success') }}
            </p>
        </li>
    @endif
    @if (session('flash_message--failure'))
        <li class="p-form--item">
            <p class="flash_message--failure">
            {{ session('flash_message--failure') }}
            </p>
        </li>
    @endif
    @error('email')
    <li class="p-form--item">
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
</li>
@enderror
@error('new-password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
 @enderror
