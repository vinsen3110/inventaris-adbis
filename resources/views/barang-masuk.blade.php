@extends('layouts.admin')

@section('content')
    {{-- daftar atk --}}
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
                                    <th scope="col" class="px-2 text-muted">Foto</th>
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
                                            @php
                                                $fotoArray = json_decode($atk->foto, true); // decode JSON foto
                                            @endphp

                                            @if ($fotoArray && count($fotoArray) > 0)
                                                @foreach ($fotoArray as $index => $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                        style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#zoomFotoModal{{ $atk->id }}_{{ $index }}">

                                                    <!-- Modal Zoom Foto -->
                                                    <div class="modal fade"
                                                        id="zoomFotoModal{{ $atk->id }}_{{ $index }}"
                                                        tabindex="-1"
                                                        aria-labelledby="zoomFotoLabel{{ $atk->id }}_{{ $index }}"
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
                            </tbody>
                        </table>
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
                                        {{-- Input untuk upload multiple foto --}}
                                        {{-- Input untuk upload foto baru --}}
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Upload Foto Barang (bisa lebih dari
                                                satu)</label>
                                            <input type="file" name="foto[]" class="form-control mb-2" multiple>
                                        </div>

                                        {{-- Tampilkan foto yang sudah ada --}}
                                        @if ($atk->foto)
                                            @php
                                                $fotoArray = json_decode($atk->foto, true);
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

                                                                {{-- Checkbox untuk hapus foto --}}
                                                                <div class="form-check mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="hapus_foto[]" value="{{ $foto }}"
                                                                        id="hapusFoto{{ $index }}">
                                                                    <label class="form-check-label small text-danger"
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
                        <input type="file" name="foto[]" class="form-control mb-2" multiple accept="image/*">
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
                        <h4 class="card-title">Daftar Alat </h4>
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
                        Alat</button>

                    {{-- Tabel ATK --}}
                    <div class="table-responsive mt-0">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="px-0 text-muted">Nama Barang</th>
                                    <th scope="col" class="px-0 text-muted">Jumlah</th>
                                    <th scope="col" class="px-0 text-muted">Satuan</th>
                                    <th scope="col" class="px-0 text-muted">Tanggal Masuk</th>
                                    <th scope="col" class="px-0 text-muted">Foto</th>
                                    <th scope="col" class="px-0 text-muted">Keterangan</th>
                                    <th scope="col" class="px-0 text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alats as $alat)
                                    <tr>
                                        <td class="px-0">{{ $alat->nama_alat }}</td>
                                        <td class="px-0">{{ $alat->jumlah_alat }}</td>
                                        <td class="px-0">{{ $alat->satuan_alat }}</td>
                                        <td class="px-0">{{ $alat->tanggal_masuk_alat }}</td>
                                        <td class="px-0">
                                        <td>
                                            @php
                                                $fotoArray = json_decode($alat->foto, true); // decode JSON foto
                                            @endphp

                                            @if ($fotoArray && count($fotoArray) > 0)
                                                @foreach ($fotoArray as $index => $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                        style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#zoomFotoModal{{ $alat->id }}_{{ $index }}">

                                                    <!-- Modal Zoom Foto -->
                                                    <div class="modal fade"
                                                        id="zoomFotoModal{{ $alat->id }}_{{ $index }}"
                                                        tabindex="-1"
                                                        aria-labelledby="zoomFotoLabel{{ $alat->id }}_{{ $index }}"
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
                                        <td class="px-0">{{ $alat->keterangan_alat }}</td>
                                        <td>
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editAlat{{ $alat->id }}">Edit</button>

                                            {{-- Delete Form --}}
                                            <form action="{{ route('alat.destroy', $alat->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                    </div>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editAlat{{ $alat->id }}" tabindex="-1"
                        aria-labelledby="editAlatLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('alat.update', $alat->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Alat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="nama_alat" value="{{ $alat->nama_alat }}"
                                            class="form-control mb-2" placeholder="Nama Alat" required>
                                        <input type="number" name="jumlah_alat" value="{{ $alat->jumlah_alat }}"
                                            class="form-control mb-2" placeholder="Jumlah" required>
                                        <input type="text" name="satuan_alat" value="{{ $alat->satuan_alat }}"
                                            class="form-control mb-2" placeholder="Satuan" required>
                                        <input type="date" name="tanggal_masuk_alat"
                                            value="{{ $alat->tanggal_masuk_alat }}" class="form-control mb-2" required>
                                        {{-- Jika ingin tambahkan upload foto baru --}}
                                        <label for="foto" class="form-label">Upload Foto Baru (bisa lebih dari
                                            satu)</label>
                                        <input type="file" name="foto[]" multiple class="form-control mb-3">

                                        {{-- Tampilkan foto lama dan opsi hapus --}}
                                        @php
                                            $fotoArray = json_decode($alat->foto, true);
                                        @endphp

                                        @if ($fotoArray && count($fotoArray) > 0)
                                            <label class="form-label">Foto Saat Ini:</label>
                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                @foreach ($fotoArray as $index => $foto)
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/' . $foto) }}" alt="Foto Alat"
                                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                                        <div class="form-check mt-1">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="hapus_foto[]" value="{{ $foto }}"
                                                                id="hapusFoto{{ $index }}">
                                                            <label class="form-check-label small text-danger"
                                                                for="hapusFoto{{ $index }}">
                                                                Hapus
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <textarea name="keterangan_alat" class="form-control" placeholder="Keterangan">{{ $alat->keterangan_alat }}</textarea>
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
            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Alat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nama_alat" class="form-control mb-2" placeholder="Nama Barang"
                            required>
                        <input type="number" name="jumlah_alat" class="form-control mb-2" placeholder="Jumlah "
                            required>
                        <input type="text" name="satuan_alat" class="form-control mb-2" placeholder="Satuan "
                            required>
                        <input type="date" name="tanggal_masuk_alat" class="form-control mb-2" required>
                        <input type="file" name="foto[]" multiple class="form-control mb-2" accept="image/*">
                        <textarea name="keterangan_alat" class="form-control" placeholder="Keterangan"></textarea>
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
                        <h4 class="card-title">Daftar Mebeler </h4>
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
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMebelerr">+ Tambah
                    Mebeler</button>

                {{-- Tabel ATK --}}
                <div class="table-responsive mt-0">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="px-0 text-muted">Nama Mebeler</th>
                                <th scope="col" class="px-0 text-muted">Jumlah</th>
                                <th scope="col" class="px-0 text-muted">Satuan</th>
                                <th scope="col" class="px-0 text-muted">Tanggal Masuk</th>
                                <th scope="col" class="px-0 text-muted">Foto</th>
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
                                    <td>
                                        @php
                                            $fotoArray = json_decode($mebeler->foto, true); // decode JSON foto
                                        @endphp

                                        @if ($fotoArray && count($fotoArray) > 0)
                                            @foreach ($fotoArray as $index => $foto)
                                                <img src="{{ asset('storage/' . $foto) }}" alt="Foto Barang"
                                                    style="width:80px; height:80px; object-fit:cover; margin:2px; cursor:pointer; border-radius: 4px; border: 1px solid #ccc;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#zoomFotoModal{{ $mebeler->id }}_{{ $index }}">

                                                <!-- Modal Zoom Foto -->
                                                <div class="modal fade"
                                                    id="zoomFotoModal{{ $mebeler->id }}_{{ $index }}"
                                                    tabindex="-1"
                                                    aria-labelledby="zoomFotoLabel{{ $mebeler->id }}_{{ $index }}"
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
                                    <td class="px-0">{{ $mebeler->keterangan_mebeler }}</td>
                                    <td>
                                        {{-- Edit Button --}}
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMebelerr{{ $mebeler->id }}">Edit</button>

                                        {{-- Delete Form --}}
                                        <form action="{{ route('mebeler.destroy', $mebeler->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editMebelerr{{ $mebeler->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('mebeler.update', $mebeler->id) }}" method="POST"
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
                                                    <input type="text" name="nama_mebeler"
                                                        value="{{ $mebeler->nama_mebeler }}" class="form-control mb-2"
                                                        placeholder="Nama Mebeler" required>

                                                    <input type="number" name="jumlah_mebeler"
                                                        value="{{ $mebeler->jumlah_mebeler }}" class="form-control mb-2"
                                                        placeholder="Jumlah" required>

                                                    <input type="text" name="satuan_mebeler"
                                                        value="{{ $mebeler->satuan_mebeler }}" class="form-control mb-2"
                                                        placeholder="Satuan" required>

                                                    <input type="date" name="tanggal_masuk_mebeler"
                                                        value="{{ $mebeler->tanggal_masuk_mebeler }}"
                                                        class="form-control mb-2" required>

                                                    {{-- Upload foto baru --}}
                                                    <label class="form-label">Upload Foto Baru (Opsional)</label>
                                                    <input type="file" name="foto[]" multiple
                                                        class="form-control mb-2" accept="image/*">

                                                    {{-- Tampilkan foto lama --}}
                                                    @php
                                                        $fotoArray = json_decode($mebeler->foto, true);
                                                    @endphp

                                                    @if ($fotoArray && count($fotoArray) > 0)
                                                        <label class="form-label">Foto Lama:</label>
                                                        <div class="d-flex flex-wrap gap-3 mb-2">
                                                            @foreach ($fotoArray as $index => $foto)
                                                                <div class="text-center">
                                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                                        alt="Foto Mebeler"
                                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                                                    <div class="form-check mt-1">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="hapus_foto[]"
                                                                            value="{{ $foto }}"
                                                                            id="hapusFoto{{ $index }}">
                                                                        <label class="form-check-label small text-danger"
                                                                            for="hapusFoto{{ $index }}">
                                                                            Hapus
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <textarea name="keterangan_mebeler" class="form-control" placeholder="Keterangan">{{ $mebeler->keterangan_mebeler }}</textarea>
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
            <div class="modal fade" id="tambahMebelerr" tabindex="-1" aria-labelledby="tambahModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('mebeler.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Mebeler</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="nama_mebeler" class="form-control mb-2"
                                    placeholder="Nama Barang" required>

                                <input type="number" name="jumlah_mebeler" class="form-control mb-2"
                                    placeholder="Jumlah" required>

                                <input type="text" name="satuan_mebeler" class="form-control mb-2"
                                    placeholder="Satuan" required>

                                <input type="date" name="tanggal_masuk_mebeler" class="form-control mb-2" required>

                                <input type="file" name="foto[]" multiple class="form-control mb-2"
                                    accept="image/*">

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
