<div class="card shadow w-100">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Edit Pengguna</h5>
    </div>
    <div class="card-body">
        <form id="formEditPengguna">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" value="{{ $user->jabatan }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password (Opsional)</label>
                    <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak ingin ubah">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
                <button type="button" class="btn btn-danger btnKembaliPengguna">
                    <i class="bi bi-x-lg me-1"></i> Kembali
                </button>
            </div>
        </form>
    </div>
</div>
