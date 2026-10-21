<x-guest-layout>
    @if (session('status'))
        <div class="status-msg">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field-inline">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary">Masuk</button>

        <div class="row-between" style="margin-top:16px;margin-bottom:0;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-small">Lupa password?</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="link-small">Daftar akun siswa</a>
            @endif
        </div>

    </form>
</x-guest-layout>
