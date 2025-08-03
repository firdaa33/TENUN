@extends('layouts.customer')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Ubah Alamat Pengiriman</h2>

    <form method="POST" action="{{ route('checkout.update-alamat') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full border p-2 rounded" required>
        </div>

        {{-- Dropdown Provinsi --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Provinsi</label>
            <select id="province" name="province" class="w-full border p-2 rounded" required></select>
        </div>

        {{-- Dropdown Kota/Kabupaten --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Kota / Kabupaten</label>
            <select id="city" name="city" class="w-full border p-2 rounded" required></select>
        </div>

        {{-- Dropdown Kecamatan --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Kecamatan</label>
            <select id="district" name="district" class="w-full border p-2 rounded" required></select>
        </div>

        {{-- Dropdown Desa --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Desa / Kelurahan</label>
            <select id="village" name="alamat" class="w-full border p-2 rounded" required></select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Detail Alamat (Patokan, RT/RW, dll)</label>
            <input type="text" name="alamat_detail" value="{{ old('alamat_detail', auth()->user()->alamat_detail) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mt-4">
            <button class="bg-[#5E2C1F] text-white px-6 py-2 rounded hover:bg-[#4b221a]">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    const wilayahUrl = '/json/wilayah.json';
    const provinceSelect = document.getElementById('province');
    const citySelect     = document.getElementById('city');
    const districtSelect = document.getElementById('district');
    const villageSelect  = document.getElementById('village');

    let wilayah = {};

    fetch(wilayahUrl)
        .then(res => res.json())
        .then(data => {
            wilayah = data["Nusa Tenggara Barat"];
            loadProvinces();
        });

    function loadProvinces() {
        const provName = "Nusa Tenggara Barat";
        provinceSelect.innerHTML = `<option selected>${provName}</option>`;
        loadCities(provName);
    }

    function loadCities(provName) {
        citySelect.innerHTML = `<option value="">-- Pilih Kota/Kabupaten --</option>`;
        Object.keys(wilayah).forEach(city => {
            citySelect.innerHTML += `<option value="${city}">${city}</option>`;
        });

        citySelect.addEventListener('change', function () {
            const selectedCity = this.value;
            loadDistricts(selectedCity);
        });
    }

    function loadDistricts(cityName) {
        districtSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
        if (!wilayah[cityName]) return;

        Object.keys(wilayah[cityName]).forEach(district => {
            districtSelect.innerHTML += `<option value="${district}">${district}</option>`;
        });

        districtSelect.addEventListener('change', function () {
            const selectedDistrict = this.value;
            loadVillages(cityName, selectedDistrict);
        });
    }

    function loadVillages(cityName, districtName) {
        villageSelect.innerHTML = `<option value="">-- Pilih Desa --</option>`;
        if (!wilayah[cityName][districtName]) return;

        wilayah[cityName][districtName].forEach(village => {
            villageSelect.innerHTML += `<option value="${village}">${village}</option>`;
        });
    }
</script>
@endsection
