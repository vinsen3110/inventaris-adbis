@extends('layouts.admin')

@section('content')
    {{-- daftar atk Kelur --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Ups! Ada kesalahan:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar ATK</h4>
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
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAtkKeluar">+ Tambah
                        ATK</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-2 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-2 text-muted">Jumlah</th>
                                    <th scope="col" class="px-2 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-2 text-muted">Foto</th>
                                    <th scope="col" class="px-2 text-muted">Keterangan</th>
                                    <th scope="col" class="px-2 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($atkKeluars as $item)
                                    <tr>
                                        <td class="px-0">{{ $item->atk->nama_barang }}</td>
                                        <td class="px-0">{{ $item->jumlah_keluar_alat }}</td>
                                        <td class="px-0">{{ $item->tanggal_keluar_alat }}</td>
                                        <td>
                                            @php
                                                $fotoArray = json_decode($item->foto, true); // decode JSON foto
                                            @endphp

                                            @if ($fotoArray && count($fotoArray) > 0)
                                                @foreach ($fotoArray as $index => $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                        style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#zoomFotoModal{{ $item->id }}_{{ $index }}">

                                                    <!-- Modal Zoom Foto -->
                                                    <div class="modal fade"
                                                        id="zoomFotoModal{{ $item->id }}_{{ $index }}"
                                                        tabindex="-1"
                                                        aria-labelledby="zoomFotoLabel{{ $item->id }}_{{ $index }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content bg-transparent border-0">
                                                                <div class="modal-body text-center p-0">
                                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                                        alt="Foto Barang" class="img-fluid rounded"
                                                                        style="max-height: 80vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                            @endif
                                        </td>
                                        <td class="px-0">{{ $item->keterangan_alat }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('barang-keluar.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('barang-keluar.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit ATK</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="atk_id">Nama Barang</label>
                                                        <select name="atk_id" id="atk_id" class="form-control" required>
                                                            <option value="">-- Pilih Barang --</option>
                                                            @foreach ($dataAtk as $atk)
                                                                <option value="{{ $atk->id }}"
                                                                    {{ $item->atk_id == $atk->id ? 'selected' : '' }}>
                                                                    {{ $atk->nama_barang }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <input type="number" name="jumlah_keluar_alat"
                                                            value="{{ $item->jumlah_keluar_alat }}"
                                                            class="form-control mb-2" placeholder="Jumlah" required>
                                                        <input type="date" name="tanggal_keluar_alat"
                                                            value="{{ $item->tanggal_keluar_alat }}"
                                                            class="form-control mb-2" required>

                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Upload Foto Barang
                                                                (bisa lebih dari satu)
                                                            </label>
                                                            <input type="file" name="foto[]"
                                                                class="form-control mb-2" multiple>
                                                        </div>

                                                        @if ($item->foto)
                                                            @php
                                                                $fotoArray = json_decode($item->foto, true);
                                                            @endphp
                                                            @if ($fotoArray && count($fotoArray) > 0)
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto Saat Ini:</label>
                                                                    <div class="d-flex flex-wrap gap-3">
                                                                        @foreach ($fotoArray as $index => $foto)
                                                                            <div class="text-center">
                                                                                <img src="{{ asset('storage/' . $foto) }}"
                                                                                    alt="Foto Barang"
                                                                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                                                                <div class="form-check mt-1">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="hapus_foto[]"
                                                                                        value="{{ $foto }}"
                                                                                        id="hapusFoto{{ $index }}">
                                                                                    <label
                                                                                        class="form-check-label small text-danger"
                                                                                        for="hapusFoto{{ $index }}">
                                                                                        Hapus
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        <textarea name="keterangan_alat" class="form-control" placeholder="Keterangan">{{ $item->keterangan_alat }}</textarea>
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
            </div>
        </div>
    </div>
    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahAtkKeluar" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('barang-keluar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ATK Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="atk_id">Nama Barang</label>
                            <select name="atk_id" id="atk_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($dataAtk as $atk)
                                    <option value="{{ $atk->id }}">{{ $atk->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jumlah_keluar">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar_alat" id="jumlah_keluar" class="form-control"
                                placeholder="Jumlah Keluar" min="1" required>
                        </div>
                        <div class="mb-2">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar_alat" id="tanggal_keluar" class="form-control"
                                required>
                        </div>
                        <div class="mb-2">
                            <label for="foto">Foto Bukti (opsional)</label>
                            <input type="file" name="foto[]" multiple id="foto" class="form-control"
                                accept="image/*">
                        </div>
                        <div class="mb-2">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan_alat" id="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Atk Keluar --}}

    {{-- Alat Keluar --}}

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar Alat</h4>
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
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAlatKeluar">+
                        Tambah
                        Alat</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-2 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-2 text-muted">Jumlah</th>
                                    <th scope="col" class="px-2 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-2 text-muted">Foto</th>
                                    <th scope="col" class="px-2 text-muted">Keterangan</th>
                                    <th scope="col" class="px-2 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alatKeluar as $item)
                                    <tr>
                                        <td class="px-0">{{ $item->alat->nama_alat }}</td>
                                        <td class="px-0">{{ $item->jumlah_keluar }}</td>
                                        <td class="px-0">{{ $item->tanggal_keluar }}</td>
                                        <td>
                                            @php
                                                $fotoArray = json_decode($item->foto, true); // decode JSON foto
                                            @endphp

                                            @if ($fotoArray && count($fotoArray) > 0)
                                                @foreach ($fotoArray as $index => $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                        style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#zoomFotoModal{{ $item->id }}_{{ $index }}">

                                                    <!-- Modal Zoom Foto -->
                                                    <div class="modal fade"
                                                        id="zoomFotoModal{{ $item->id }}_{{ $index }}"
                                                        tabindex="-1"
                                                        aria-labelledby="zoomFotoLabel{{ $item->id }}_{{ $index }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content bg-transparent border-0">
                                                                <div class="modal-body text-center p-0">
                                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                                        alt="Foto Barang" class="img-fluid rounded"
                                                                        style="max-height: 80vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                            @endif
                                        </td>
                                        <td class="px-0">{{ $item->keterangan }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('alat-keluar.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('alat-keluar.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Alat</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="alat_id">Nama Barang</label>
                                                        <select name="alat_id" id="atk_id" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Alat --</option>
                                                            @foreach ($dataAlat as $alat)
                                                                <option value="{{ $alat->id }}"
                                                                    {{ $item->alat_id == $alat->id ? 'selected' : '' }}>
                                                                    {{ $alat->nama_alat }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <input type="number" name="jumlah_keluar"
                                                            value="{{ $item->jumlah_keluar }}" class="form-control mb-2"
                                                            placeholder="Jumlah" required>
                                                        <input type="date" name="tanggal_keluar"
                                                            value="{{ $item->tanggal_keluar }}" class="form-control mb-2"
                                                            required>

                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Upload Foto Barang
                                                                (bisa lebih dari satu)
                                                            </label>
                                                            <input type="file" name="foto[]"
                                                                class="form-control mb-2" multiple>
                                                        </div>

                                                        @if ($item->foto)
                                                            @php
                                                                $fotoArray = json_decode($item->foto, true);
                                                            @endphp
                                                            @if ($fotoArray && count($fotoArray) > 0)
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto Saat Ini:</label>
                                                                    <div class="d-flex flex-wrap gap-3">
                                                                        @foreach ($fotoArray as $index => $foto)
                                                                            <div class="text-center">
                                                                                <img src="{{ asset('storage/' . $foto) }}"
                                                                                    alt="Foto Barang"
                                                                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                                                                <div class="form-check mt-1">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="hapus_foto[]"
                                                                                        value="{{ $foto }}"
                                                                                        id="hapusFoto{{ $index }}">
                                                                                    <label
                                                                                        class="form-check-label small text-danger"
                                                                                        for="hapusFoto{{ $index }}">
                                                                                        Hapus
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $item->keterangan }}</textarea>
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
            </div>
        </div>
    </div>

    {{-- Modal Tambah Alat Keluar --}}
    <div class="modal fade" id="tambahAlatKeluar" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('alat-keluat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alat Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Pilih Alat --}}
                        <div class="mb-2">
                            <label for="alat_id">Nama Barang</label>
                            <select name="alat_id" id="alat_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($dataAlat as $alat)
                                    <option value="{{ $alat->id }}">{{ $alat->nama_alat }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Keluar --}}
                        <div class="mb-2">
                            <label for="jumlah_keluar">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control"
                                placeholder="Jumlah Keluar" min="1" required>
                        </div>

                        {{-- Tanggal Keluar --}}
                        <div class="mb-2">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                required>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-2">
                            <label for="foto">Foto Bukti (boleh lebih dari satu)</label>
                            <input type="file" name="foto[]" id="foto" class="form-control" accept="image/*"
                                multiple>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-2">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan (Opsional)"></textarea>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- End Alat Keluar --}}

     {{-- Modal Tambah Mebeler Keluar --}}
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar Mebeler</h4>
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
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMebelerKeluar">+
                        Tambah
                        Mebeler Keluar</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-2 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-2 text-muted">Jumlah</th>
                                    <th scope="col" class="px-2 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-2 text-muted">Foto</th>
                                    <th scope="col" class="px-2 text-muted">Keterangan</th>
                                    <th scope="col" class="px-2 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mebelerKeluar as $item)
                                    <tr>
                                        <td class="px-0">{{ $item->Mebeler->nama_mebeler }}</td>
                                        <td class="px-0">{{ $item->jumlah_keluar }}</td>
                                        <td class="px-0">{{ $item->tanggal_keluar }}</td>
                                        <td>
                                            @php
                                                $fotoArray = json_decode($item->foto, true); // decode JSON foto
                                            @endphp

                                            @if ($fotoArray && count($fotoArray) > 0)
                                                @foreach ($fotoArray as $index => $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                        style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#zoomFotoModal{{ $item->id }}_{{ $index }}">

                                                    <!-- Modal Zoom Foto -->
                                                    <div class="modal fade"
                                                        id="zoomFotoModal{{ $item->id }}_{{ $index }}"
                                                        tabindex="-1"
                                                        aria-labelledby="zoomFotoLabel{{ $item->id }}_{{ $index }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content bg-transparent border-0">
                                                                <div class="modal-body text-center p-0">
                                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                                        alt="Foto Barang" class="img-fluid rounded"
                                                                        style="max-height: 80vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <img src="{{ asset('img/foto-not-font.jpeg') }}" alt="No Image"
                                                    style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                            @endif
                                        </td>
                                        <td class="px-0">{{ $item->keterangan }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModalMebeler{{ $item->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('mebeler-keluar.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModalMebeler{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('mebeler-keluar.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Mebeler</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="mebeler_id">Nama Barang</label>
                                                        <select name="mebeler_id" id="atk_id" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih mebeler --</option>
                                                            @foreach ($dataMebeler as $mebeler)
                                                                <option value="{{ $mebeler->id }}"
                                                                    {{ $item->mebeler_id == $mebeler->id ? 'selected' : '' }}>
                                                                    {{ $mebeler->nama_mebeler }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <input type="number" name="jumlah_keluar"
                                                            value="{{ $item->jumlah_keluar }}" class="form-control mb-2"
                                                            placeholder="Jumlah" required>
                                                        <input type="date" name="tanggal_keluar"
                                                            value="{{ $item->tanggal_keluar }}" class="form-control mb-2"
                                                            required>

                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Upload Foto Barang
                                                                (bisa lebih dari satu)
                                                            </label>
                                                            <input type="file" name="foto[]"
                                                                class="form-control mb-2" multiple>
                                                        </div>

                                                        @if ($item->foto)
                                                            @php
                                                                $fotoArray = json_decode($item->foto, true);
                                                            @endphp
                                                            @if ($fotoArray && count($fotoArray) > 0)
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto Saat Ini:</label>
                                                                    <div class="d-flex flex-wrap gap-3">
                                                                        @foreach ($fotoArray as $index => $foto)
                                                                            <div class="text-center">
                                                                                <img src="{{ asset('storage/' . $foto) }}"
                                                                                    alt="Foto Barang"
                                                                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                                                                <div class="form-check mt-1">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="hapus_foto[]"
                                                                                        value="{{ $foto }}"
                                                                                        id="hapusFoto{{ $index }}">
                                                                                    <label
                                                                                        class="form-check-label small text-danger"
                                                                                        for="hapusFoto{{ $index }}">
                                                                                        Hapus
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ $item->keterangan }}</textarea>
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
            </div>
        </div>
    </div>

    {{-- Modal Tambah mebeler Keluar --}}
    <div class="modal fade" id="tambahMebelerKeluar" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('mebeler-keluar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mebeler Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Pilih Mebeler --}}
                        <div class="mb-2">
                            <label for="mebeler_id">Nama Barang</label>
                            <select name="mebeler_id" id="mebeler_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($dataMebeler as $mebeler)
                                    <option value="{{ $mebeler->id }}">{{ $mebeler->nama_mebeler }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Keluar --}}
                        <div class="mb-2">
                            <label for="jumlah_keluar">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control"
                                placeholder="Jumlah Keluar" min="1" required>
                        </div>

                        {{-- Tanggal Keluar --}}
                        <div class="mb-2">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                required>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-2">
                            <label for="foto">Foto Bukti (boleh lebih dari satu)</label>
                            <input type="file" name="foto[]" id="foto" class="form-control" accept="image/*"
                                multiple>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-2">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan (Opsional)"></textarea>
                        </div>
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
