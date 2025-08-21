@php
    use Carbon\Carbon;

    $tanggalExpire = Carbon::parse($barang->tanggal_kadaluwarsa);
    $hariSisa = now()->diffInDays($tanggalExpire, false);

    // Warna status hanya merah dan hijau
    $statusWarna = $hariSisa <= 0 ? 'bg-danger text-white' : 'bg-success text-white';
    $statusTulisan = $hariSisa <= 0 ? 'Kadaluwarsa' : "Aman - Tersisa $hariSisa hari";

    $dataList = [
        ['label' => 'Nama Barang', 'value' => $barang->nama_barang, 'icon' => 'box'],
        ['label' => 'Kode Barang', 'value' => $barang->kode_barang, 'icon' => 'barcode'],
        ['label' => 'Sumber', 'value' => $barang->sumber->nama_sumber ?? '-', 'icon' => 'truck'],
        ['label' => 'Kategori', 'value' => $barang->kategori->nama_kategori ?? '-', 'icon' => 'tag'],
        ['label' => 'Tahun Anggaran', 'value' => $barang->tahun_anggaran, 'icon' => 'calendar'],
        ['label' => 'Stok', 'value' => $barang->stok, 'icon' => 'layers'],
        ['label' => 'Satuan', 'value' => $barang->satuan, 'icon' => 'grid'],
        ['label' => 'Harga', 'value' => 'Rp ' . number_format($barang->harga, 0, ',', '.'), 'icon' => 'dollar-sign'],
        ['label' => 'Total', 'value' => 'Rp ' . number_format($barang->total, 0, ',', '.'), 'icon' => 'calculator'],
        ['label' => 'Tanggal Kadaluwarsa', 'value' => $tanggalExpire->format('d-m-Y'), 'icon' => 'clock'],
        ['label' => 'Status', 'value' => $statusTulisan, 'icon' => 'alert-circle'],
    ];
@endphp

<div class="container mt-4">
    <div class="position-relative mb-4 text-center">
        <h5 class="mb-4">Detail Barang Kadaluwarsa</h5>
        <button class="btn btn-sm btn-danger position-absolute top-0 end-0 btnTutupDetailKadaluwarsa">
            <i class="fas fa-times me-1"></i> Tutup
        </button>
    </div>

    <div class="row g-4">
        @foreach ($dataList as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 {{ $item['label'] === 'Status' ? $statusWarna : '' }}">
                    <div class="card-body d-flex align-items-start gap-3">
                        <div class="fs-4">
                            <i class="fas fa-{{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <p class="mb-1 text-muted small">{{ $item['label'] }}</p>
                            <h6 class="mb-0">{{ $item['value'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
