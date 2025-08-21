<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <div class="card w-100">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Daftar Stok Kadaluwarsa</h6>
        </div>

        <div class="card-body">
            <!-- Catatan warna -->
            <div class="alert alert-warning py-2 px-3 small" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Catatan:</strong>
    Baris:
    <span class="bg-danger px-2 rounded text-white">Merah</span> = Sudah kadaluwarsa,
    <span class="bg-warning px-2 rounded text-dark">Kuning</span> = Akan kadaluwarsa ≤ 3 hari,
    <span class="bg-success px-2 rounded text-white">Hijau</span> = Masih aman.
</div>

<div class="mb-3">
    <label for="filterKadaluwarsa" class="form-label">Filter Status:</label>
    <select id="filterKadaluwarsa" class="form-select form-select-sm w-auto d-inline-block">
        <option value="">Semua</option>
        <option value="expired">Sudah Kadaluwarsa</option>
        <option value="soon">Akan Kadaluwarsa (≤ 3 hari)</option>
        <option value="safe">Masih Aman</option>
    </select>
</div>

            <table id="tableKadaluwarsa" class="table table-bordered table-sm table-hover">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>No</th>
                        <th>Tgl Kadaluwarsa</th>
                        <th>Expire</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Sumber</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $i => $barang)
          @php
    $statusKadaluwarsa = 'safe'; // default
    $expireText = '-';
    $expireClass = '';

    if (!empty($barang->tanggal_kadaluwarsa)) {
        $tanggal = \Carbon\Carbon::parse($barang->tanggal_kadaluwarsa)->startOfDay();
        $hariIni = \Carbon\Carbon::today();
        $diff = $hariIni->diffInDays($tanggal, false);

        if ($diff < 0) {
            $expireText = abs($diff) . ' hari lewat';
            $expireClass = 'table-danger';
            $statusKadaluwarsa = 'expired';
        } elseif ($diff <= 3) {
            $expireText = $diff === 0 ? 'Hari ini' : $diff . ' hari lagi';
            $expireClass = 'table-warning';
            $statusKadaluwarsa = 'soon';
        } else {
            $expireText = $diff . ' hari lagi';
            $expireClass = 'table-success';
            $statusKadaluwarsa = 'safe';
        }
    }
@endphp

<tr class="text-center small text-nowrap {{ $expireClass }}" data-status="{{ $statusKadaluwarsa }}">

                            <td>{{ $i + 1 }}</td>
                            <td>{{ $barang->tanggal_kadaluwarsa ? \Carbon\Carbon::parse($barang->tanggal_kadaluwarsa)->format('d-m-Y') : '-' }}
                            </td>
                            <td>{{ $expireText }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td class="text-start">{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->sumber->nama_sumber ?? '-' }}</td>
                            <td>{{ $barang->tahun_anggaran }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->status ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-1 flex-wrap justify-content-center">
                                    <button class="btn btn-info btn-sm btnDetailKadaluwarsa"
                                        data-id="{{ $barang->id }}">Detail</button>
                                    <button class="btn btn-warning btn-sm btnStatusKadaluwarsa"
                                        data-id="{{ $barang->id }}">Keterangan</button>
                                    <button class="btn btn-danger btn-sm btnHapusKadaluwarsa"
                                        data-id="{{ $barang->id }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if(count($barangs) === 0)
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data stok kadaluwarsa.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailKadaluwarsaContainer" style="display:none; position: fixed; z-index: 9999; top: 0; left: 0;
width: 100%; height: 100%; background-color: rgba(0,0,0,0.4); overflow-y: auto;">
    <div id="detailKadaluwarsaContent" class="p-4 bg-white rounded shadow"
        style="width: 90%; max-width: 800px; margin: 5% auto; position: relative;">
        {{-- konten dimuat via AJAX --}}
    </div>
</div>