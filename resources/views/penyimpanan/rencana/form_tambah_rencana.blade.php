<div class="card w-100">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Form Tambah Rencana Alokasi</h5>
    </div>

    <div class="card-body">
        <form id="formRencanaAlokasi" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
    <label for="no_surat" class="form-label">No Surat</label>
    <input type="text" class="form-control" id="no_surat" name="no_surat" 
           placeholder="BA.126/BNPB/OJLP/LP.01.03/11/2025" required>
</div>

<style>
    #no_surat::placeholder {
        color: #aaa;        /* abu-abu muda agar tidak terlalu tajam */
        opacity: 1;
        font-style: italic; /* opsional */
        font-size: 0.85rem; /* bisa diperkecil lagi sesuai kebutuhan */
    }
</style>


            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="text" class="form-control" id="tahun" name="tahun" maxlength="4" required>
            </div>

            <div class="mb-3">
                <label for="dokumen" class="form-label">Dokumen</label>
                <input type="file" class="form-control" id="dokumen" name="dokumen" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <button type="button" id="btnBatalRencana" class="btn btn-danger">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
            </div>
        </form>
    </div>
</div>
