/**
 *  alamat.js
 *  Dropdown berjenjang ala Shopee (Provinsi > Kota/Kab > Kecamatan > Desa)
 *  ─────────────────────────────────────────────────────────────────────
 *  • Letakkan file ini di /public/js/alamat.js
 *  • Pastikan file JSON wilayah ada di /public/json/wilayah.json
 *  • Elemen <select> di form harus memiliki id:
 *      - province
 *      - city
 *      - district
 *      - village
 */

let wilayahData = {};

async function loadWilayahJSON() {
    try {
        const response = await fetch('/json/wilayah.json');
        if (!response.ok) throw new Error('wilayah.json tidak ditemukan');
        wilayahData = await response.json();

        // Isi dropdown Provinsi pertama kali
        fillSelect('province', Object.keys(wilayahData));
    } catch (err) {
        console.error('Gagal memuat data wilayah:', err);
    }
}

function fillSelect(selectId, options) {
    const selectEl = document.getElementById(selectId);
    if (!selectEl) return;

    selectEl.innerHTML = '<option value="">-- Pilih --</option>';
    options.forEach(opt => {
        const optEl = document.createElement('option');
        optEl.value = opt;
        optEl.textContent = opt;
        selectEl.appendChild(optEl);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    loadWilayahJSON();

    // Provinsi -> Kota/Kab
    document.getElementById('province')?.addEventListener('change', e => {
        const prov = e.target.value;
        fillSelect('city', prov ? Object.keys(wilayahData[prov]) : []);
        fillSelect('district', []);
        fillSelect('village', []);
    });

    // Kota/Kab -> Kecamatan
    document.getElementById('city')?.addEventListener('change', e => {
        const prov = document.getElementById('province').value;
        const city = e.target.value;
        fillSelect('district', prov && city ? Object.keys(wilayahData[prov][city]) : []);
        fillSelect('village', []);
    });

    // Kecamatan -> Desa/Kelurahan
    document.getElementById('district')?.addEventListener('change', e => {
        const prov = document.getElementById('province').value;
        const city = document.getElementById('city').value;
        const district = e.target.value;
        fillSelect(
            'village',
            prov && city && district ? wilayahData[prov][city][district] : []
        );
    });
});
