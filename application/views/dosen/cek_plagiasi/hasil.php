<?php $this->load->view('template/header'); ?>
<style>
    .highlight {
        background-color: yellow; /* Ganti warna latar belakang sesuai preferensi Anda */
    }
</style>
<h4>Judul skripsi anda: <strong><?= $userTitle ?></strong></h4>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Judul Skripsi</th>
                <th>Persentase</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Membuat array asosiatif yang berisi judul, nama mahasiswa, nim, dan kemiripan
            $dataForSorting = array();
            foreach ($matchingData as $data) {
                $dataForSorting[] = array(
                    'nama_mahasiswa' => $data['nama_mahasiswa'],
                    'nim' => $data['nim'],
                    'judul' => $data['judul_skripsi'],
                    'kemiripan' => min($data['kemiripan'], 100)
                );
            }

            // Fungsi untuk mengurutkan array berdasarkan kemiripan
            // usort($dataForSorting, function ($a, $b) {
            //     return $a['kemiripan'] < $b['kemiripan'];
            // });

            $no = 1;
            foreach ($dataForSorting as $data) {
                $nama_mahasiswa = $data['nama_mahasiswa'];
                $nim = $data['nim'];
                $nama_judul_skripsi = $data['judul'];
                $similarity = $data['kemiripan'];

                $colorClass = '';

                if ($similarity >= 60) {
                    $colorClass = 'bg-red'; // Merah untuk kemiripan di atas 60% dan 100%
                } elseif ($similarity >= 45) {
                    $colorClass = 'bg-yellow'; // Kuning untuk kemiripan di antara 45% dan 59.9%
                } elseif ($similarity >= 26) {
                    $colorClass = 'bg-blue'; // Biru untuk kemiripan di antara 26% dan 44.9%
                } elseif ($similarity >= 0) {
                    $colorClass = 'bg-green'; // Hijau untuk kemiripan di antara 0% dan 25.9%
                }

                // Membagi judul menjadi kata-kata
                $userTitleWords = explode(' ', strtolower($userTitle));
                $judulSkripsiWords = explode(' ', strtolower($nama_judul_skripsi));

                // Menyimpan kata-kata yang sama
                $matchingWords = array_intersect($userTitleWords, $judulSkripsiWords);

                // Menyusun ulang judul dengan kata-kata yang sama diberi latar belakang warna
                $highlightedTitle = '';

                foreach ($judulSkripsiWords as $word) {
                    if (in_array($word, $userTitleWords)) {
                        $highlightedTitle .= "<span class='highlight'>$word</span> ";
                    } else {
                        $highlightedTitle .= "$word ";
                    }
                }
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $nama_mahasiswa ?></td>
                    <td><?= $nim ?></td>
                    <td><?= rtrim($highlightedTitle) ?></td>
                    <td>
                        <span class="<?= $colorClass ?> font-weight-bold"><?= number_format($similarity, 2) ?> %</span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('template/footer'); ?>
