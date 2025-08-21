<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-dark d-flex justify-content-between align-items-center">
            <h6>Laporan Persediaan Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelPersediaan" class="table table-bordered table-hover table-sm">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Stok Akhir</th>
                            <th>Satuan</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persediaan as $i => $p)
                            <tr class="align-middle text-center">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $p['nama_barang'] }}</td>
                                <td>{{ $p['kode_barang'] }}</td>
                                <td>{{ $p['stok_akhir'] }}</td>
                                <td>{{ $p['satuan'] }}</td>
                                <td>{{ $p['tanggal_masuk'] }}</td>
                                <td>{{ $p['tanggal_keluar'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
