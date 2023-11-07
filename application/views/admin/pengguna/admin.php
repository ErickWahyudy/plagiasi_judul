<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "admin"):
?>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPengguna"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIDN</th>
                <th>Keterangan</th>
                <th>Email</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $pengguna): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pengguna['nama'] ?></td>
                <td><?= $pengguna['nidn'] ?></td>
                <td><?= $pengguna['keterangan'] ?></td>
                <td><?= $pengguna['email'] ?></td>
                <td>
                    <?php 
                    if($pengguna['id_level'] == 1){
                        echo "Superadmin";
                    }elseif($pengguna['id_level'] == 2){
                        echo "Admin";
                    }elseif($pengguna['id_level'] == 3){
                        echo "Juri";
                    }
                    ?>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $pengguna['id_pengguna'] ?>"><i class="fa fa-edit"></i> Edit</a>
                    <a href="" class="btn btn-info" data-toggle="modal"
                        data-target="#ganti_password<?= $pengguna['id_pengguna'] ?>"><i class="fa fa-key"></i> Ganti
                        Password</a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data -->
    <div class="modal fade" id="modalTambahPengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" class="form-control" placeholder="nama"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>NIDN</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nidn" class="form-control" placeholder="nidn"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th> Keterangan</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="keterangan" class="form-control" placeholder="keterangan"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" class="form-control" placeholder="email"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" class="form-control" placeholder="password"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Level</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_level" class="form-control">
                                        <?php foreach($level as $lev): ?>
                                        <?php if($lev['id_level'] == 2): ?>
                                        <option value="<?= $lev['id_level'] ?>">
                                            <?= $lev['level'] ?>
                                        </option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
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

    <!-- Modal edit data pengguna-->
    <?php foreach($data as $pengguna): ?>
    <div class="modal fade" id="edit<?= $pengguna['id_pengguna'] ?>" tabindex="-1" role="dialog"
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
                                <th>ID pengguna</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_pengguna" value="<?= $pengguna['id_pengguna'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" value="<?= $pengguna['nama'] ?>" class="form-control"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>NIDN</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nidn" value="<?= $pengguna['nidn'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th> Keterangan</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="keterangan" value="<?= $pengguna['keterangan'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="email" value="<?= $pengguna['email'] ?>" autocomplete="off"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal"
                                        data-target="#ganti_password<?= $pengguna['id_pengguna'] ?>"><i
                                            class="fa fa-key"></i> Ganti Password</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Level</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_level" class="form-control">
                                        <option value="">--Pilih Level--</option>
                                        <?php $no=1; foreach($level as $lev): ?>
                                        <option value="<?= $lev['id_level'] ?>"
                                            <?php if($pengguna['id_level']==$lev['id_level']){echo "selected";} ?>>
                                            <?= $no ?>. <?= $lev['level'] ?>
                                        </option>
                                        <?php $no++; endforeach; ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)"
                                        onclick="hapuspengguna('<?= $pengguna['id_pengguna'] ?>')"
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

    <!-- Modal ganti password  -->
    <?php foreach($data as $pengguna): ?>
    <div class="modal fade" id="ganti_password<?= $pengguna['id_pengguna'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="gantipassword" method="post">
                            <input type="hidden" name="id_pengguna" value="<?= $pengguna['id_pengguna'] ?>"
                                class="form-control" readonly>
                            <tr>
                                <th>Masukkan Password Baru</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" id="password" name="password" class="form-control"
                                        required="">
                                    <input type="checkbox" onclick="viewPassword()"> Lihat Password
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                </th>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->


    <script type="text/javascript">
    //view password
    function viewPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>

    <script>
    //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/pengguna/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.status) {
                        $('#modalTambahPengguna');
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
    
    //edit file
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/pengguna/api_edit/') ?>" + form_data.get(
                'id_pengguna'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_pengguna'));
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

    //ganti password
    $(document).on('submit', '#gantipassword', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/pengguna/api_password/') ?>" + form_data.get(
                'id_pengguna'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#gantipassword' + form_data.get('id_pengguna'));
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

    //ajax hapus pengguna
    function hapuspengguna(id_pengguna) {
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
                    url: "<?php echo site_url('admin/pengguna/api_hapus/') ?>" + id_pengguna,
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

    <?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
?>