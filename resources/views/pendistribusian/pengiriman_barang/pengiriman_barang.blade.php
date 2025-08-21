@php use Illuminate\Support\Facades\Storage; @endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div id="cardPengirimanBarang">
        <div class="card w-100">
            <div class="card-header text-dark d-flex justify-content-between align-items-center">
                <h6>Data Pengiriman Barang</h6>
                
              <div class="d-flex align-items-center gap-3">
        <div>
            Barang Dipilih: <span id="badgeCount" class="badge bg-primary">0</span>
        </div>
        <button id="btnKirimBarang" class="btn btn-success btn-sm">
            Kirim Barang <i class="fas fa-paper-plane"></i>
        </button>
    </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover" id="tablePengirimanBarang">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Jumlah Kirim</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $b)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="checkBarang" name="barang_id[]" value="{{ $b->id }}">
                                    </td>
                                    <td>{{ $b->nama_barang }}</td>
                                    <td class="text-center">{{ $b->stok }}</td>
                                    <td>
                                        <input type="number" min="1" max="{{ $b->stok }}" class="form-control form-control-sm jumlah-kirim" 
                                               data-id="{{ $b->id }}" value="1">
                                    </td>
                                    <td class="text-center">{{ $b->satuan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada barang tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Overlay Pilih Surat --}}
    <div id="overlayPilihSurat" 
         style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
                background:rgba(0,0,0,.5);z-index:9999">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card shadow" style="width:500px;max-height:80vh;overflow-y:auto">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Pilih Surat BAST</h6>
                    <button class="btn btn-sm btn-danger" id="btnCloseOverlay">X</button>
                </div>
                <div class="card-body">
                    <select id="pengiriman_id" class="form-select mb-3">
    <option value="">-- Pilih Surat --</option>
    @foreach($surat as $s)
        <option value="{{ $s->id }}">{{ $s->no_surat }}</option>
    @endforeach
</select>
                    <div class="text-end">
                        <button id="btnProsesKirim" class="btn btn-success btn-sm">Proses Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
