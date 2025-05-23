@extends('layouts.admin')

@section('content')
    {{-- daftar atk --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar ATK </h4>
                        <p class="card-subtitle">
                            Administrasi Bisnis
                        </p>
                        <button id="btnToggleListAtk" class="btn btn-sm btn-outline-secondary"
                            title="Tutup daftar ATK">&times;</button>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <select class="form-select theme-select border-0" aria-label="Default select example">
                            <option value="1">March 2025</option>
                            <option value="2">March 2025</option>
                            <option value="3">March 2025</option>
                        </select>
                    </div>
                </div>
                {{-- Button Tambah --}}
                <div id="listAtkWrapper">
                    {{-- Button Tambah --}}
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah
                        ATK</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-2 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-2 text-muted">Jumlah</th>
                                    <th scope="col" class="px-2 text-muted">Satuan</th>
                                    <th scope="col" class="px-2 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-2 text-muted">Foto 1</th>
                                    <th scope="col" class="px-2 text-muted">Foto 2</th>
                                    <th scope="col" class="px-2 text-muted">Foto 3</th>
                                    <th scope="col" class="px-2 text-muted">Keterangan</th>
                                    <th scope="col" class="px-2 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $atk)
                                    <tr>
                                        <td class="px-2">{{ $atk->nama_barang }}</td>
                                        <td class="px-2">{{ $atk->jumlah }}</td>
                                        <td class="px-2">{{ $atk->satuan }}</td>
                                        <td class="px-2">{{ $atk->tanggal_masuk }}</td>
                                        <td>
                                            @if ($atk->foto_1)
                                            {{-- {{ dd($atk->foto_1) }} --}}
                                                <img src="{{ asset('storage/foto-atk/' . $atk->foto_1) }}" alt="Foto Barang"
                                                    style="width:100px; height:100px; object-fit:cover;">
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($atk->foto_2)
                                                <img src="{{ asset('storage/foto-atk/' . $atk->foto_2) }}" alt="Foto Barang"
                                                    style="width:100px; height:100px; object-fit:cover;">
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($atk->foto_3)
                                                <img src="{{ asset('storage/foto-atk/' . $atk->foto_3) }}" alt="Foto Barang"
                                                    style="width:100px; height:100px; object-fit:cover;">
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td class="px-2">{{ $atk->keterangan }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $atk->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('barang-masuk.destroy', $atk->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                    </div>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $atk->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('barang-masuk.update', $atk->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit ATK</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="nama_barang" value="{{ $atk->nama_barang }}"
                                            class="form-control mb-2" placeholder="Nama Barang" required>
                                        <input type="number" name="jumlah" value="{{ $atk->jumlah }}"
                                            class="form-control mb-2" placeholder="Jumlah" required>
                                        <input type="text" name="satuan" value="{{ $atk->satuan }}"
                                            class="form-control mb-2" placeholder="Satuan" required>
                                        <input type="date" name="tanggal_masuk" value="{{ $atk->tanggal_masuk }}"
                                            class="form-control mb-2" required>
                                        <input type="file" name="foto_1" value="{{ $atk->foto_1 }}"
                                            class="form-control mb-2">
                                        <input type="file" name="foto_2" value="{{ $atk->foto_2 }}"
                                            class="form-control mb-2">
                                        <input type="file" name="foto_3" value="{{ $atk->foto_1 }}"
                                            class="form-control mb-2">
                                        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $atk->keterangan }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('barang-masuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah ATK</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nama_barang" class="form-control mb-2" placeholder="Nama Barang"
                            required>
                        <input type="number" name="jumlah" class="form-control mb-2" placeholder="Jumlah" required>
                        <input type="text" name="satuan" class="form-control mb-2" placeholder="Satuan" required>
                        <input type="date" name="tanggal_masuk" class="form-control mb-2" required>
                        <input type="file" name="foto_1" class="form-control mb-2">
                        <input type="file" name="foto_2" class="form-control mb-2">
                        <input type="file" name="foto_3" class="form-control mb-2">
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- daftar mebeler --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar MEBELER </h4>
                        <p class="card-subtitle">
                            Administrasi Bisnis
                        </p>
                        <button id="btnToggleListMebeler" class="btn btn-sm btn-outline-secondary"
                            title="Tutup daftar ATK">&times;</button>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <select class="form-select theme-select border-0" aria-label="Default select example">
                            <option value="1">March 2025</option>
                            <option value="2">March 2025</option>
                            <option value="3">March 2025</option>
                        </select>
                    </div>
                </div>
                {{-- Button Tambah --}}
                <div id="listMebelerWrapper">
                    {{-- Button Tambah --}}
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMebeler">+ Tambah
                        Mebeler</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-0 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-0 text-muted">Jumlah</th>
                                    <th scope="col" class="px-0 text-muted">Satuan</th>
                                    <th scope="col" class="px-0 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-0 text-muted">Keterangan</th>
                                    <th scope="col" class="px-0 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mebelers as $mebeler)
                                    <tr>
                                        <td class="px-0">{{ $mebeler->nama_mebeler }}</td>
                                        <td class="px-0">{{ $mebeler->jumlah_mebeler }}</td>
                                        <td class="px-0">{{ $mebeler->satuan_mebeler }}</td>
                                        <td class="px-0">{{ $mebeler->tanggal_masuk_mebeler }}</td>
                                        <td class="px-0">{{ $mebeler->keterangan_mebeler }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editMebeler{{ $mebeler->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('mebeler.destroy', $mebeler->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                    </div>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editMebeler{{ $mebeler->id }}" tabindex="-1"
                        aria-labelledby="editMebelerLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('mebeler.update', $mebeler->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Mebeler</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="nama_mebeler" value="{{ $mebeler->nama_mebeler }}"
                                            class="form-control mb-2" placeholder="Nama Barang" required>
                                        <input type="number" name="jumlah_mebeler"
                                            value="{{ $mebeler->jumlah_mebeler }}" class="form-control mb-2"
                                            placeholder="Jumlah" required>
                                        <input type="text" name="satuan_mebeler"
                                            value="{{ $mebeler->satuan_mebeler }}" class="form-control mb-2"
                                            placeholder="Satuan" required>
                                        <input type="date" name="tanggal_masuk_mebeler"
                                            value="{{ $mebeler->tanggal_masuk_mebeler }}" class="form-control mb-2"
                                            required>
                                        <textarea name="keterangan_mebeler" class="form-control" placeholder="Keterangan">{{ $mebeler->keterangan_mebeler }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahMebeler" tabindex="-1" aria-labelledby="tambahMebelerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('mebeler.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mebeler</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nama_mebeler" class="form-control mb-2" placeholder="Nama Mebeler"
                            required>
                        <input type="number" name="jumlah_mebeler" class="form-control mb-2"
                            placeholder="Jumlah Mebeler" required>
                        <input type="text" name="satuan_mebeler" class="form-control mb-2"
                            placeholder="Satuan Mebeler" required>
                        <input type="date" name="tanggal_masuk_mebeler" class="form-control mb-2" required>
                        <textarea name="keterangan_mebeler" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar MEBELER </h4>
                        <p class="card-subtitle">
                            Administrasi Bisnis
                        </p>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <select class="form-select theme-select border-0" aria-label="Default select example">
                            <option value="1">March 2025</option>
                            <option value="2">March 2025</option>
                            <option value="3">March 2025</option>
                        </select>
                    </div>
                </div>
                {{-- Button Tambah --}}
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah
                    ATK</button>

                {{-- Tabel ATK --}}
                <div class="table-responsive mt-0">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="px-0 text-muted">Nama Barang</th>
                                <th scope="col" class="px-0 text-muted">Jumlah</th>
                                <th scope="col" class="px-0 text-muted">Satuan</th>
                                <th scope="col" class="px-0 text-muted">Tanggal Masuk</th>
                                <th scope="col" class="px-0 text-muted">Keterangan</th>
                                <th scope="col" class="px-0 text-muted">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $atk)
                                <tr>
                                    <td class="px-0">{{ $atk->nama_barang }}</td>
                                    <td class="px-0">{{ $atk->jumlah }}</td>
                                    <td class="px-0">{{ $atk->satuan }}</td>
                                    <td class="px-0">{{ $atk->tanggal_masuk }}</td>
                                    <td class="px-0">{{ $atk->keterangan }}</td>
                                    <td>
                                        {{-- Edit Button --}}
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $atk->id }}">Edit</button>

                                        {{-- Delete Form --}}
                                        <form action="{{ route('barang-masuk.destroy', $atk->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $atk->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('barang-masuk.update', $atk->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit ATK</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="nama_barang"
                                                        value="{{ $atk->nama_barang }}" class="form-control mb-2"
                                                        placeholder="Nama Barang" required>
                                                    <input type="number" name="jumlah" value="{{ $atk->jumlah }}"
                                                        class="form-control mb-2" placeholder="Jumlah" required>
                                                    <input type="text" name="satuan" value="{{ $atk->satuan }}"
                                                        class="form-control mb-2" placeholder="Satuan" required>
                                                    <input type="date" name="tanggal_masuk"
                                                        value="{{ $atk->tanggal_masuk }}" class="form-control mb-2"
                                                        required>
                                                    <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $atk->keterangan }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan
                                                        Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah --}}
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('barang-masuk.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah ATK</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="nama_barang" class="form-control mb-2"
                                    placeholder="Nama Barang" required>
                                <input type="number" name="jumlah" class="form-control mb-2" placeholder="Jumlah"
                                    required>
                                <input type="text" name="satuan" class="form-control mb-2" placeholder="Satuan"
                                    required>
                                <input type="date" name="tanggal_masuk" class="form-control mb-2" required>
                                <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <script>
                document.getElementById('btnToggleListAtk').addEventListener('click', function() {
                    const wrapper = document.getElementById('listAtkWrapper');
                    if (wrapper.style.display === 'none') {
                        wrapper.style.display = 'block';
                        this.innerHTML = '&times;'; // tombol "x"
                        this.title = "Tutup daftar ATK";
                    } else {
                        wrapper.style.display = 'none';
                        this.innerHTML = '&#x25B6;'; // tombol panah ► untuk buka lagi
                        this.title = "Buka daftar ATK";
                    }
                });

                document.getElementById('btnToggleListMebeler').addEventListener('click', function() {
                    const wrapper = document.getElementById('listMebelerWrapper');
                    if (wrapper.style.display === 'none') {
                        wrapper.style.display = 'block';
                        this.innerHTML = '&times;'; // tombol "x"
                        this.title = "Tutup daftar ATK";
                    } else {
                        wrapper.style.display = 'none';
                        this.innerHTML = '&#x25B6;'; // tombol panah ► untuk buka lagi
                        this.title = "Buka daftar ATK";
                    }
                });
            </script>
        @endsection
