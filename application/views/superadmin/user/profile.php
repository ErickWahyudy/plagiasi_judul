<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>
<?= $this->session->flashdata('pesan') ?>

<table class="table table-striped">
    <form action="" method="POST" enctype="multipart/form-data">
        <tr>
            <th class="col-md-2">Nama</th>
            <td>
                : <?= $nama ?>
            </td>
        </tr>
        <tr>
            <th>NIDN</th>
            <td>
                : <?= $nidn ?>
            </td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>
                : <?= $keterangan ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                : <?= $email ?>
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                : <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                        class="fa fa-key"></i> Ganti Password</a>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <a href="../superadmin/home" class="btn btn-primary">Kembali</a> &nbsp;&nbsp;
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editAkun"><i
                        class="fa fa-edit"></i> Perbarui Data</a>
            </td>
        </tr>

    </form>
</table>

<!-- Modal edit data akun -->
<div class="modal fade" id="editAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <input type="hidden" name="id_pengguna" value="<?= $id_pengguna ?>" class="form-control" readonly>
                        <tr>
                            <th>Nama</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nama" value="<?= $nama ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>NIDN</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="nidn" value="<?= $nidn ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="keterangan" value="<?= $keterangan ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="email" value="<?= $email ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Ganti Password</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                                        class="fa fa-key"></i> Ganti Password</a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                &nbsp;&nbsp;
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>

                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal ganti password  -->
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <input type="hidden" name="id_pengguna" value="<?= $id_pengguna ?>" class="form-control" readonly>
                        <tr>
                            <th>Masukkan Password Baru</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password" name="password" class="form-control"
                                    autocomplete="off" required>
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
<!-- End Modal -->

<?php endif; ?>

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
//edit akun
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/profile/api_edit/') ?>" + form_data.get('id_pengguna'),
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

//edit akun
$(document).on('submit', '#gantipassword', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/profile/api_password/') ?>" + form_data.get('id_pengguna'),
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
</script>


<?php $this->load->view('template/footer'); ?>
<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

//format tanggal indonesia
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>