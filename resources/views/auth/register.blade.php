<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor HP -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Nomor HP')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Alamat Berjenjang -->
        <div class="mt-4">
            <x-input-label :value="__('Alamat Lengkap')" />
            <select id="province" name="province" class="w-full border p-2 rounded mb-2" required></select>
            <select id="city" name="city" class="w-full border p-2 rounded mb-2" required></select>
            <select id="district" name="district" class="w-full border p-2 rounded mb-2" required></select>
            <select id="village" name="village" class="w-full border p-2 rounded mb-2" required></select>
            <textarea id="address" name="address" class="w-full border p-2 rounded" placeholder="Detail Alamat (Dusun, RT/RW, Jalan)" required>{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Sudah punya akun -->
        <div class="text-center mt-4 text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
        </div>
    </form>
    <!-- Wilayah dropdown handler -->
    <script src="/js/alamat.js"></script>
</x-guest-layout>
