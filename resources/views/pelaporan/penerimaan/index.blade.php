<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6>Buku Harian Penerimaan Surat Dan Barang</h6>
            <ul class="nav nav-tabs card-header-tabs" id="penerimaanTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="surat-tab" data-bs-toggle="tab" data-bs-target="#suratPane"
                        type="button" role="tab" aria-controls="suratPane" aria-selected="true">
                        Surat Penerimaan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="barang-tab" data-bs-toggle="tab" data-bs-target="#barangPane"
                        type="button" role="tab" aria-controls="barangPane" aria-selected="false">
                        Barang Masuk
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content" id="penerimaanTabsContent">

            {{-- Tab Surat --}}
            <div class="tab-pane fade show active" id="suratPane" role="tabpanel" aria-labelledby="surat-tab">
                <div class="table-responsive">
                    <table id="tabelSurat" class="table table-bordered table-sm table-hover">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk</th>
                                <th>No Surat BAST</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penerimaans as $i => $p)
                                <tr class="text-center align-middle">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d-m-Y') }}</td>
                                    <td>{{ $p->no_surat_bast }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm detailPenerimaan" data-id="{{ $p->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tab Barang --}}
            <div class="tab-pane fade" id="barangPane" role="tabpanel" aria-labelledby="barang-tab">
                <div class="table-responsive">
                    <table id="tabelBarang" class="table table-bordered table-sm table-hover">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Tanggal Masuk</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Tanggal Keluar Terakhir</th> {{-- Kolom baru --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $i => $b)
                                <tr class="text-center align-middle">
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $b->nama_barang }}</td>
                                    <td>{{ $b->kode_barang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($b->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $b->stok }}</td>
                                    <td>{{ $b->satuan }}</td>
                                    <td>
                                        {{-- Cek apakah updated_at lebih baru dari created_at --}}
                                        @if($b->updated_at && $b->updated_at != $b->created_at)
                                            {{ \Carbon\Carbon::parse($b->updated_at)->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- Overlay Detail Penerimaan --}}
<div id="detailPenerimaanContainer" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background:rgba(0,0,0,0.5); z-index:1050; overflow:auto;">
    <div id="detailPenerimaanContent" class="p-4"
        style="max-width:900px; margin:40px auto; background:#fff; border-radius:8px; box-shadow:0 5px 15px rgba(0,0,0,0.3);">
        {{-- Konten detail akan di-load via AJAX --}}
    </div>
</div>