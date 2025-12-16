<x-admin-layout>
    <div class="mx-auto max-w-270">
        <div class="mb-6 flex gap-3 sm:items-center">
             <a href="{{ route('family-plannings.index') }}" class="text-gray-500 hover:text-black">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Edit Data KB</h2>
        </div>

        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
             <div class="p-6.5 border-b border-stroke dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Pasien: {{ $familyPlanning->patient->name }}</h3>
                 <p>Tanggal Pasang: {{ $familyPlanning->installation_date ? \Carbon\Carbon::parse($familyPlanning->installation_date)->format('d M Y') : '-' }}</p>
            </div>
            
            <form action="{{ route('family-plannings.update', $familyPlanning->id) }}" method="POST" class="p-6.5">
                @csrf
                @method('PUT')
                
                <div class="mb-4.5 flex gap-4">
                     <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Metode Kontrasepsi</label>
                         <select name="method" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                            <option value="Suntik 1 Bulan" {{ $familyPlanning->method == 'Suntik 1 Bulan' ? 'selected' : '' }}>Suntik 1 Bulan</option>
                            <option value="Suntik 3 Bulan" {{ $familyPlanning->method == 'Suntik 3 Bulan' ? 'selected' : '' }}>Suntik 3 Bulan</option>
                            <option value="Pil KB" {{ $familyPlanning->method == 'Pil KB' ? 'selected' : '' }}>Pil KB</option>
                            <option value="IUD / Spiral" {{ $familyPlanning->method == 'IUD / Spiral' ? 'selected' : '' }}>IUD / Spiral</option>
                            <option value="Implan / Susuk" {{ $familyPlanning->method == 'Implan / Susuk' ? 'selected' : '' }}>Implan / Susuk</option>
                             <option value="Kondom" {{ $familyPlanning->method == 'Kondom' ? 'selected' : '' }}>Kondom</option>
                        </select>
                    </div>
                     <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Jadwal Kunjungan Ulang</label>
                         <input type="date" name="next_visit_date" value="{{ $familyPlanning->next_visit_date ? \Carbon\Carbon::parse($familyPlanning->next_visit_date)->format('Y-m-d') : '' }}" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>
                
                 <div class="mb-4.5 flex gap-4">
                     <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Berat Badan (Kg)</label>
                        <input type="text" name="weight" value="{{ $familyPlanning->weight }}" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                    <div class="w-1/2">
                        <label class="mb-2.5 block text-black dark:text-white">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" value="{{ $familyPlanning->blood_pressure }}" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                    </div>
                </div>

                 <div class="mb-4.5">
                    <label class="mb-2.5 block text-black dark:text-white">Efek Samping / Keluhan</label>
                    <textarea name="side_effects" rows="3" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">{{ $familyPlanning->side_effects }}</textarea>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray-100">Update Data</button>
            </form>
        </div>
    </div>
</x-admin-layout>
