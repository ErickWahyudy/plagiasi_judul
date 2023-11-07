<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJudulSkripsi"><i class="fa fa-plus"></i>
    Tambah</a>
    <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalImportExcel"><i class="fa fa-upload"></i> Impor dari Excel</a> -->
<br /><br /><br />
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Judul Skripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $judul_skripsi): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $judul_skripsi['nama_mahasiswa'] ?></td>
                <td><?= $judul_skripsi['nim'] ?></td>
                <td><?= $judul_skripsi['nama_judul_skripsi'] ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $judul_skripsi['id_judul_skripsi'] ?>"><i class="fa fa-edit"></i> Edit</a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data -->
    <div class="modal fade" id="modalTambahJudulSkripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>Nama Mahasiswa</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Nama Mahasiswa"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nim" class="form-control" placeholder="NIM"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Judul Skripsi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_judul_skripsi" class="form-control" placeholder="Judul Skripsi"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal impor data dari Excel -->
    <!-- <div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Impor Data dari Excel</h4>
                    <a href="<?= site_url('admin/judul_skripsi/buatTemplateExcel') ?>" class="btn btn-success">Unduh Template Excel</a>

                </div>
                <div class="modal-body">
                    <form id="importExcelForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excelFile">Pilih File Excel:</label>
                            <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls">
                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="importExcelBtn">Impor</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal -->

    <!-- Modal edit data judul skripsi-->
    <?php foreach($data as $judul_skripsi): ?>
    <div class="modal fade" id="edit<?= $judul_skripsi['id_judul_skripsi'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="edit" method="post">
                            <tr>
                                <th>ID Judul Skripsi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_judul_skripsi" value="<?= $judul_skripsi['id_judul_skripsi'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Mahasiswa</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_mahasiswa" value="<?= $judul_skripsi['nama_mahasiswa'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nim" value="<?= $judul_skripsi['nim'] ?>" class="form-control"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Judul Skripsi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_judul_skripsi" value="<?= $judul_skripsi['nama_judul_skripsi'] ?>" class="form-control"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)"
                                        onclick="hapusjudulskripsi('<?= $judul_skripsi['id_judul_skripsi'] ?>')"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->

    <script>
        //add data
        $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/judul_skripsi/api_add') ?>",
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
                            location.reload();
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

        $(document).ready(function() {
        $('#importExcelForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "<?= site_url('admin/judul_skripsi/api_imporExcel') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        $('#modalImportExcel');
                        $('#importExcelForm')[0].reset();
                        swal({
                            title: "Berhasil",
                            text: "Data berhasil diimpor",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "Gagal",
                            text: data.message,
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
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



    //edit
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/judul_skripsi/api_edit/') ?>" + form_data.get('id_judul_skripsi'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_judul_skripsi'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            },
            //memanggil swall ketika gagal
            error: function(data) {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });

    //ajax hapus
    function hapusjudulskripsi(id_judul_skripsi) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/judul_skripsi/api_hapus/') ?>" + id_judul_skripsi,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Dihapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Dihapus",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
            }
        });
    }
    </script>
    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>
