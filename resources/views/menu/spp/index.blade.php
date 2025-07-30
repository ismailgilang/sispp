<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen SPP</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Tabel SPP</h2>
                        <div>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal2')">
                                Buat Tagihan / Jurusan
                            </x-primary-button>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal')">
                                Buat Tagihan / Siswa
                            </x-primary-button>
                        </div>
                    </div>
                    
                    <!-- Search Input -->
                    <div class="mb-4">
                        <input type="text" id="searchInput" placeholder="Cari pengguna..." 
                               class="w-full md:w-64 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               onkeyup="searchTable()">
                    </div>
                    
                    <div class="w-full overflow-x-auto">
                        <table class="w-full" id="userTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                                     <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nis">{{ $user->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap name">{{ $user->bulan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap name">{{ $user->tahun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap username">{{ $user->nominal }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap username">{{ $user->jatuh_tempo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap username">{{ $user->status }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-4 items-center justify-center w-full">
                                                @if ($user->status === 'belum_dibayar')
                                                    <a href="{{ route('bayar.spp', $user->id) }}" class="border border-green-500 bg-green-500 px-4 py-1 rounded text-white hover:bg-green-400 hover:border-green-400">Bayar</a>
                                                @endif
                                                <a href="{{ route('Spp.edit', $user->id) }}" class="border border-yellow-500 bg-yellow-500 px-4 py-1 rounded text-white hover:bg-yellow-400 hover:border-yellow-400">Edit</a>
                                                <x-danger-button 
                                                   x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $user->id }}')">
                                                    Hapus
                                                </x-danger-button>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal name="confirm-delete-{{ $user->id }}" :show="false" maxWidth="sm">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h2>
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus SPP dengan NIS {{ $user->nis }}</b>?</p>
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->id }}')"
                                                    class="px-4 py-2 border rounded-md">
                                                    Batal
                                                </button>
                                                <form method="POST" action="{{ route('Spp.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengguna</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="w-full flex justify-end">
                        <div class="flex items-center justify-center gap-4 mt-4" id="paginationControls">
                            <button id="prevPage" class="px-4 py-2 border rounded-md hover:bg-blue-500 hover:text-white" disabled>
                                <<
                            </button>
                            <div id="pageNumbers" class="flex space-x-2"></div>
                            <button id="nextPage" class="px-4 py-2 border rounded-md hover:bg-blue-500 hover:text-white">
                                >>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
    <x-modal name="add-modal" focusable>
        <form method="POST" action="{{ route('Spp.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">Buat Tagihan SPP Baru Siswa</h2>
            
            <div class="mt-4">
                <x-input-label for="nis" value="Nama Kelas" />
                <select id="nis" name="nis" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($data3 as $item)
                        <option value="{{ $item->nis }}">{{ $item->nama }} | {{$item->nis}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
            </div>
            <!-- Input Nominal -->
            <div class="mt-6">
                <x-input-label for="nominal" value="Nominal" />
                <x-text-input id="nominal" name="nominal" type="number" 
                    class="mt-1 block w-full" placeholder="Masukkan nominal" />
                <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
            </div>

            <!-- Input Bulan -->
            <div class="mt-6">
                <x-input-label for="bulan" value="Bulan" />
                <select id="bulan" name="bulan" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
            </div>

            <!-- Input Tahun -->
            <div class="mt-6">
                <x-input-label for="tahun" value="Tahun" />
                <x-text-input id="tahun" name="tahun" type="number" 
                    class="mt-1 block w-full" placeholder="Misalnya: 2025" />
                <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
            </div>

            <!-- Input Jatuh Tempo -->
            <div class="mt-6">
                <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                <x-text-input id="jatuh_tempo" name="jatuh_tempo" type="date" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
            </div>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="add-modal2" focusable>
        <form method="POST" action="{{ route('store.spp') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">Buat Tagihan SPP Baru Jurusan</h2>

            <div class="mt-4">
                <x-input-label for="id_jurusan" value="Nama Jurusan" />
                <select id="id_jurusan" name="id_jurusan" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($data2 as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_jurusan')" class="mt-2" />
            </div>

            <!-- Input Nominal -->
            <div class="mt-6">
                <x-input-label for="nominal" value="Nominal" />
                <x-text-input id="nominal" name="nominal" type="number" 
                    class="mt-1 block w-full" placeholder="Masukkan nominal" />
                <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
            </div>

            <!-- Input Bulan -->
            <div class="mt-6">
                <x-input-label for="bulan" value="Bulan" />
                <select id="bulan" name="bulan" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
            </div>

            <!-- Input Tahun -->
            <div class="mt-6">
                <x-input-label for="tahun" value="Tahun" />
                <x-text-input id="tahun" name="tahun" type="number" 
                    class="mt-1 block w-full" placeholder="Misalnya: 2025" />
                <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
            </div>

            <!-- Input Jatuh Tempo -->
            <div class="mt-6">
                <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                <x-text-input id="jatuh_tempo" name="jatuh_tempo" type="date" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
            </div>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <script>
        // Variabel global untuk pagination
        let currentPage = 1;
        const rowsPerPage = 5;
        let filteredRows = [];
        let allRows = Array.from(document.querySelectorAll('.user-row'));

        // Inisialisasi pagination saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            filteredRows = [...allRows];
            setupPagination();
        });

        // Fungsi untuk setup pagination
        function setupPagination() {
            const pageNumbersDiv = document.getElementById('pageNumbers');
            pageNumbersDiv.innerHTML = '';
            
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            
            // Tampilkan maksimal 5 nomor halaman
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(pageCount, startPage + 4);
            
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            // Tombol Previous
            document.getElementById('prevPage').disabled = currentPage === 1;
            
            // Nomor halaman
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = `px-4 py-2 border rounded-md ${currentPage === i ? 'bg-blue-500 text-white' : ''}`;
                pageButton.onclick = () => goToPage(i);
                pageNumbersDiv.appendChild(pageButton);
            }
            
            // Tombol Next
            document.getElementById('nextPage').disabled = currentPage === pageCount;
            
            // Tampilkan rows untuk halaman saat ini
            displayRowsForCurrentPage();
        }

        // Fungsi untuk menampilkan rows sesuai halaman
        function displayRowsForCurrentPage() {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            
            allRows.forEach(row => row.style.display = 'none');
            
            filteredRows.slice(startIndex, endIndex).forEach(row => {
                row.style.display = '';
            });
        }

        // Fungsi untuk pindah halaman
        function goToPage(page) {
            currentPage = page;
            setupPagination();
        }

        // Event listener untuk tombol next dan previous
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                goToPage(currentPage - 1);
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            if (currentPage < pageCount) {
                goToPage(currentPage + 1);
            }
        });

        // Fungsi untuk search
        function searchTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            filteredRows = allRows.filter(row => {
                const nis = row.querySelector('.nis').textContent.toLowerCase();
                const name = row.querySelector('.name').textContent.toLowerCase();
                const username = row.querySelector('.username').textContent.toLowerCase();
                const role = row.querySelector('.role').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       name.includes(searchTerm) || 
                       username.includes(searchTerm) || 
                       role.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
</x-app-layout>