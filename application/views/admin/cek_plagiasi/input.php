<?php $this->load->view('template/header'); ?>

    <!-- Main content -->
    <section class="content text-center">
          <h3><i class="fa fa-info text-green"></i> Ketikkan judul skripsi yang ingin dicek plagiasi</h3>
          <form method="post" action="<?= site_url('admin/cek_plagiasi/calculate_similarity') ?>">
            <div class="input-group">
              <input type="text" name="nama_judul_skripsi" class="form-control" placeholder="Masukkan Judul Skripsi" required="" autocomplete="off">
              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
    </section>
    <!-- /.content -->

    <script>
        //add data
        $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/cek_plagiasi/api_check_plagiasi') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.status) {
                        $('#modalTambahJudulSkripsi');
                        $('#add')[0].reset();
                        swal({
                            title: "Berhasil",
                            text: "Data berhasil ditambahkan",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE",
                        }).then(function() {
                            window.location.href = "<?= site_url('admin/cek_plagiasi/lihat') ?>";
                        });
                    } else {
                        // Hapus tag HTML dari pesan error
                        var errorMessage = $('<div>').html(data.message).text();
                        swal({
                            title: "Gagal",
                            text: errorMessage, // Menampilkan pesan error dari server
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menampilkan pesan error jika terjadi kesalahan pada AJAX request
                    swal({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim data",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OK",
                    });
                }
            });
        });
    });
    </script>

    <?php $this->load->view('template/footer'); ?>