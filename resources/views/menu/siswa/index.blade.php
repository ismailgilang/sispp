<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Siswa</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Tabel Siswa</h2>
                        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal')">
                            Tambah Data
                        </x-primary-button>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ibu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ayah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Handphone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Pada</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nis">{{ $user->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nama">{{ $user->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nama">{{ $user->nama_ibu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nama">{{ $user->nama_ayah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap kelas">{{ $user->kelas->nama_kelas }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap alamat">{{ $user->alamat }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap telp">{{ $user->no_telp }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap created_at">{{ $user->created_at }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-4 items-center justify-center w-full">
                                                <a href="{{ route('Edit.siswa', $user->nis) }}" class="border border-yellow-500 bg-yellow-500 px-4 py-1 rounded text-white hover:bg-yellow-400 hover:border-yellow-400">Edit</a>
                                                <x-danger-button 
                                                   x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $user->nis }}')">
                                                    Hapus
                                                </x-danger-button>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal name="confirm-delete-{{ $user->nis }}" :show="false" maxWidth="sm">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h2>
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus siswa <b>{{ $user->name }} dengan NIS {{ $user->nis }}</b>?</p>
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->nis }}')"
                                                    class="px-4 py-2 border rounded-md">
                                                    Batal
                                                </button>
                                                <form method="POST" action="{{ route('Hapus.siswa', $user->nis) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data Siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="w-full flex justify-end">
                        <div class="flex items-center justify-center gap-4 mt-4" id="paginationControls">
                            <button id="prevPage" class="px-3 py-3 border rounded-md hover:bg-blue-500 hover:text-white" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div id="pageNumbers" class="flex space-x-2"></div>
                            <button id="nextPage" class="px-3 py-3 border rounded-md hover:bg-blue-500 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
    <x-modal name="add-modal" focusable>
        <form method="POST" action="{{ route('Siswa.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">Tambah Siswa Baru</h2>
            
             <div class="mt-6">
                <x-input-label for="nis" value="NIS" />
                <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="nama" value="Nama Lengkap" />
                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="nama_ibu" value="Nama Ibu" />
                <x-text-input id="nama_ibu" name="nama_ibu" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="nama_ayah" value="Nama ayah" />
                <x-text-input id="nama_ayah" name="nama_ayah" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="id_kelas" value="Nama Kelas" />
                <select id="id_kelas" name="id_kelas" 
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_kelas')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="alamat" value="Alamat" />
                <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="no_telp" value="No Handphone" />
                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
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
                const name = row.querySelector('.nama').textContent.toLowerCase();
                const username = row.querySelector('.kelas').textContent.toLowerCase();
                const role = row.querySelector('.alamat').textContent.toLowerCase();
                const telp = row.querySelector('.telp').textContent.toLowerCase();
                const at = row.querySelector('.created_at').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       name.includes(searchTerm) || 
                       username.includes(searchTerm) || 
                       role.includes(searchTerm) ||
                       telp.includes(searchTerm) || 
                       at.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
</x-app-layout>