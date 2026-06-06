<x-filament-panels::page>
    @php $data = $this->getLaporanData(); @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-6 bg-white border rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Total Pendapatan</p>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($data['pendapatan'], 0, ',', '.') }}</p>
        </div>
        <div class="p-6 bg-white border rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Total Beban</p>
            <p class="text-2xl font-bold text-red-600">Rp {{ number_format($data['beban'], 0, ',', '.') }}</p>
        </div>
        <div class="p-6 border rounded-xl shadow-sm {{ $data['laba_rugi'] >= 0 ? 'bg-green-50' : 'bg-red-50' }}">
            <p class="text-sm text-gray-500">Laba/Rugi Bersih</p>
            <p class="text-3xl font-black {{ $data['laba_rugi'] >= 0 ? 'text-green-700' : 'text-red-700' }}">
                Rp {{ number_format($data['laba_rugi'], 0, ',', '.') }}
            </p>
        </div>
    </div>
</x-filament-panels::page>