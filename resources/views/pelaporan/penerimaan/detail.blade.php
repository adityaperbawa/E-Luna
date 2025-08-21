<div class="card">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-eye me-2"></i>Rincian Penerimaan</span>
        <button class="btn btn-sm btn-light btnTutupDetailPenerimaan">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-borderless">
            <tr>
                <th style="width: 200px;">Penerimaan</th>
                <td>: {{ ucfirst($penerimaan->penerimaan) }}</td>
            </tr>
            <tr>
                <th>No Surat BAST</th>
                <td>: {{ $penerimaan->no_surat_bast ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td>: {{ $penerimaan->tanggal_surat ? \Carbon\Carbon::parse($penerimaan->tanggal_surat)->format('d-m-Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>: {{ $penerimaan->tanggal_masuk ? \Carbon\Carbon::parse($penerimaan->tanggal_masuk)->format('d-m-Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Tahun Anggaran</th>
                <td>: {{ $penerimaan->tanggal_masuk ? \Carbon\Carbon::parse($penerimaan->tanggal_masuk)->format('Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Nama Pengirim</th>
                <td>: {{ $penerimaan->nama_pengirim ?? '-' }}</td>
            </tr>
            <tr>
                <th>No Whatsapp</th>
                <td>: {{ $penerimaan->no_whatsapp ?? '-' }}</td>
            </tr>

            {{-- Dokumen --}}
            @foreach([
                'dokumen_bast'   => 'Dokumen BAST',
                'delivery_order' => 'Delivery Order',
                'stnk'           => 'STNK',
                'sim_driver'     => 'SIM Driver',
                'foto_kendaraan' => 'Foto Kendaraan',
                'foto_unloading' => 'Foto / Video Unloading'
            ] as $field => $label)
                <tr>
                    <th>{{ $label }}</th>
                    <td>:
                        @if (!empty($penerimaan->$field))
                            <a href="{{ asset('uploads/plogpal/' . $penerimaan->$field) }}" target="_blank" class="text-primary">Lihat</a>
                        @else
                            <em class="text-danger">Belum diupload</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
