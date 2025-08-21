<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6>Buku Harian Pengeluaran</h6>
            <ul class="nav nav-tabs card-header-tabs" id="pengeluaranTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="surat-tab" data-bs-toggle="tab" data-bs-target="#suratPane"
                        type="button" role="tab" aria-controls="suratPane" aria-selected="true">
                        Surat Pengeluaran
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="barang-tab" data-bs-toggle="tab" data-bs-target="#barangPane"
                        type="button" role="tab" aria-controls="barangPane" aria-selected="false">
                        Barang Tanpa Surat
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content" id="pengeluaranTabsContent">

            {{-- Tab Surat --}}
            <div class="tab-pane fade show active" id="suratPane" role="tabpanel" aria-labelledby="surat-tab">
                <div class="table-responsive">
                    <table id="tabelPengeluaran" class="table table-bordered table-sm table-hover">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surat as $i => $s)
                                <tr class="align-middle text-center">
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $s->no_surat }}</td>
                                    <td>{{ $s->tanggal_surat?->format('d-m-Y') }}</td>
                                    <td>{{ $s->tujuan->instansi ?? '-' }} ({{ $s->tujuan->kab_kota ?? '-' }})</td>
                                    <td>
                                        <span class="badge bg-primary">Dikirim</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm show-detail" data-id="{{ $s->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tab Barang Tanpa Surat --}}
            <div class="tab-pane fade" id="barangPane" role="tabpanel" aria-labelledby="barang-tab">
                <div class="table-responsive">
                    <table id="tabelBarangTanpaSurat" class="table table-bordered table-sm table-hover">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangTanpaSurat as $i => $b)
                                <tr class="align-middle text-center">
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $b->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $b->barang->kode_barang ?? '-' }}</td>
                                    <td>{{ $b->jumlah }}</td>
                                    <td>{{ $b->barang->satuan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada barang tanpa surat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Overlay Detail Barang --}}
<div id="detailBarangContainer" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); z-index:1050; overflow:auto;">
    <div id="detailBarangContent" class="p-4"
        style="max-width:900px; margin:40px auto; background:#fff; border-radius:8px; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span>Detail Barang Dikirim</span>
                <button class="btn btn-sm btn-light btnTutupDetail">Tutup</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="detailBarang"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
