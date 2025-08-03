@extends('layouts.customer')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h2 class="text-xl font-semibold text-center mb-6">Ubah Alamat</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="province" class="block font-medium text-sm text-gray-700">Provinsi</label>
            <select id="province" name="province" required class="form-select w-full rounded mt-1 border-gray-300">
                <option value="">-- Pilih Provinsi --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="city" class="block font-medium text-sm text-gray-700">Kabupaten/Kota</label>
            <select id="city" name="city" required class="form-select w-full rounded mt-1 border-gray-300">
                <option value="">-- Pilih Kabupaten/Kota --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="district" class="block font-medium text-sm text-gray-700">Kecamatan</label>
            <select id="district" name="district" required class="form-select w-full rounded mt-1 border-gray-300">
                <option value="">-- Pilih Kecamatan --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="village" class="block font-medium text-sm text-gray-700">Desa/Kelurahan</label>
            <select id="village" name="village" required class="form-select w-full rounded mt-1 border-gray-300">
                <option value="">-- Pilih Desa --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="address" class="block font-medium text-sm text-gray-700">Detail Alamat</label>
            <textarea name="address" id="address" rows="3" class="w-full border rounded p-2" placeholder="Dusun, RT/RW, jalan..." required>{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-[#5E2C1F] hover:bg-[#472118] text-white px-6 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>

{{-- Wilayah Script --}}
<script>
    let dataWilayah = {};
    async function loadWilayah() {
        const res = await fetch("/json/wilayah.json");
        dataWilayah = await res.json();

        const selectedProv = @json(old('province', $user->province));
        const selectedCity = @json(old('city', $user->city));
        const selectedDistrict = @json(old('district', $user->district));
        const selectedVillage = @json(old('village', $user->village));

        populateSelect('province', Object.keys(dataWilayah), selectedProv);

        if (selectedProv) populateSelect('city', Object.keys(dataWilayah[selectedProv]), selectedCity);
        if (selectedCity) populateSelect('district', Object.keys(dataWilayah[selectedProv][selectedCity]), selectedDistrict);
        if (selectedDistrict) populateSelect('village', dataWilayah[selectedProv][selectedCity][selectedDistrict], selectedVillage);
    }

    function populateSelect(id, options, selected = '') {
        const el = document.getElementById(id);
        el.innerHTML = '<option value="">-- Pilih --</option>';
        options.forEach(val => {
            const o = document.createElement("option");
            o.value = val;
            o.text = val;
            if (val === selected) o.selected = true;
            el.appendChild(o);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadWilayah();
        document.getElementById('province')?.addEventListener('change', e => {
            const prov = e.target.value;
            populateSelect('city', prov ? Object.keys(dataWilayah[prov]) : []);
            populateSelect('district', []);
            populateSelect('village', []);
        });

        document.getElementById('city')?.addEventListener('change', e => {
            const prov = document.getElementById('province').value;
            const city = e.target.value;
            populateSelect('district', prov && city ? Object.keys(dataWilayah[prov][city]) : []);
            populateSelect('village', []);
        });

        document.getElementById('district')?.addEventListener('change', e => {
            const prov = document.getElementById('province').value;
            const city = document.getElementById('city').value;
            const district = e.target.value;
            populateSelect('village', prov && city && district ? dataWilayah[prov][city][district] : []);
        });
    });
</script>
@endsection
