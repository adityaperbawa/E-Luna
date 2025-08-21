/* ============================================================
 *  Permohonan Barata – init & handler
 *  ------------------------------------------------------------
 *  Pastikan tabel list dibungkus: <div id="cardListBarata">…</div>
 *  Form container:   <div id="formContainerBarata"></div>
 *  Rincian overlay:  #rincianBarataOverlay  +  #rincianBarataContent
 * ============================================================
 */
function initPermohonanBarata () {

    /* ---------- CSRF ---------- */
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    const $listCard = $('#cardListBarata');
    const $formBox  = $('#formContainerBarata');
    const showList  = () => $listCard.show();
    const hideList  = () => $listCard.hide();

    /* ---------- reload list ---------- */
    const reloadList = () => $.get('/permohonan_barata').done(html => {
        $('main').html(html);
        initPermohonanBarata();
    });

    /* ======================================================
     *  Tambah
     * ==================================================== */
    $(document).off('click', '#btnTambahPermohonanBarata')
               .on ('click', '#btnTambahPermohonanBarata', () => {
        $.get('/permohonan_barata/create').done(html => {
            $formBox.html(html); hideList(); $('html,body').scrollTop(0);

            // instansi otomatis
            $(document).off('change', '#selectKabKota')
                       .on ('change', '#selectKabKota', function () {
                $('#instansiView').val($(this).find(':selected').data('instansi') || '');
            });

            // submit tambah
            $(document).off('submit', '#formTambahBarata')
                       .on ('submit', '#formTambahBarata', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/permohonan_barata',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend () { Swal.showLoading(); },
                    success (r){ Swal.fire('Berhasil', r.message,'success'); reloadList(); },
                    error   (x){ Swal.fire('Gagal',x.responseJSON?.message||'Error','error'); }
                });
            });

            // kembali
            $(document).off('click', '.btnKembaliBarata')
                       .on ('click', '.btnKembaliBarata', ()=>{ $formBox.empty(); showList();});
        });
    });

    /* ======================================================
     *  Edit
     * ==================================================== */
    $(document).off('click', '.editBtnBarata')
               .on ('click', '.editBtnBarata', function () {
        const id = $(this).data('id');
        $.get(`/permohonan_barata/${id}/edit`).done(html => {
            $formBox.html(html); hideList(); $('html,body').scrollTop(0);

            $('#selectKabKota').trigger('change');
            $(document).off('change', '#selectKabKota')
                       .on ('change', '#selectKabKota', function () {
                $('#instansiView').val($(this).find(':selected').data('instansi') || '');
            });

            $(document).off('submit', '#formEditBarata')
                       .on ('submit', '#formEditBarata', function (e) {
                e.preventDefault();
                $.ajax({
                    url: `/permohonan_barata/${id}`,
                    method:'POST',                  // _method=PUT di Blade
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    beforeSend(){ Swal.showLoading(); },
                    success(r){ Swal.fire('Berhasil',r.message,'success'); reloadList(); },
                    error  (x){ Swal.fire('Gagal',x.responseJSON?.message||'Error','error'); }
                });
            });

            $(document).off('click', '.btnKembaliBarata')
                       .on ('click', '.btnKembaliBarata', ()=>{ $formBox.empty(); showList();});
        });
    });

    /* ======================================================
     *  Delete
     * ==================================================== */
    $(document).off('click', '.deleteBtnBarata')
               .on ('click', '.deleteBtnBarata', function () {
        const id = $(this).data('id');
        Swal.fire({icon:'warning',title:'Hapus data?',showCancelButton:true})
            .then(r=>{
                if(!r.isConfirmed) return;
                $.ajax({
                    url:`/permohonan_barata/${id}`,
                    method:'DELETE',
                    beforeSend(){ Swal.showLoading(); },
                    success (r){ Swal.fire('Berhasil',r.message,'success'); reloadList(); },
                    error   (x){ Swal.fire('Gagal',x.responseJSON?.message||'Error','error'); }
                });
            });
    });

    /* ======================================================
     *  Setuju / Tidak Setuju
     * ==================================================== */
    $(document).off('click', '.btnSetujuBarata, .btnTolakBarata')
           .on ('click', '.btnSetujuBarata, .btnTolakBarata', function () {
    const id     = $(this).data('id');
    const status = $(this).hasClass('btnSetujuBarata') ? 'disetujui' : 'ditolak';
    const statusText = status === 'disetujui' ? 'Setujui' : 'Tolak';

    Swal.fire({
        title: `Yakin ingin ${statusText} permohonan ini?`,
        text: "Tindakan ini tidak dapat dibatalkan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal'
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url:`/permohonan_barata/${id}/status`,
                method:'POST',
                data:{ status },
                beforeSend(){ Swal.showLoading(); },
                success(r){ Swal.fire('Berhasil', r.message, 'success'); reloadList(); },
                error  (x){ Swal.fire('Gagal', x.responseJSON?.message||'Error', 'error'); }
            });
        }
    });
});



    /* ======================================================
     *  Rincian
     * ==================================================== */
    $(document).off('click', '.btnRincianBarata')
               .on ('click', '.btnRincianBarata', function () {
        const id = $(this).data('id');
        $('#rincianBarataContent').html('<div class="p-4 text-center">Loading…</div>');
        $('#rincianBarataOverlay').fadeIn('fast');
        $.get(`/permohonan_barata/${id}`).done(html =>
            $('#rincianBarataContent').html(html)
        );
    });

    // tutup rincian
    $(document).off('click', '.btnCloseRincianBarata')
               .on ('click', '.btnCloseRincianBarata', ()=> $('#rincianBarataOverlay').fadeOut('fast'));
    $('#rincianBarataOverlay')
        .off('click')
        .on('click', e=>{if(e.target.id==='rincianBarataOverlay')$(e.currentTarget).fadeOut('fast');});

        $(document).ready(function () {
        $('#tableBarata').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "→",
                    previous: "←"
                },
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [6] } // kolom aksi tidak bisa diurutkan
            ]
        });
    });
}
