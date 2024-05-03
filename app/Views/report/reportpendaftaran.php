<style>
    p,
    span,
    table {
        font-size: 12px
    }

    table {
        width: 100%;
    }

    table#tb-item tr th,
    table#tb-item tr td {
        border: 1px solid #000;
    }

    h3 {
        text-align: center;
        font-weight: bold;
    }

    .text-center {
        text-align: center;
    }

    .text-wrap {
        white-space: normal;
    }
</style>
<h3>Data Pendaftaran</h3>
<table id="tb-item">
    <thead>
        <tr>
            <th class="text-center" style="width: 4%;"><strong>No</strong></th>
            <th class="text-center" style="width: 16%;"><strong>Nama</strong></th>
            <th class="text-center" style="width: 14%;"><strong>HP</strong></th>
            <th class="text-center" style="width: 23%;"><strong>Anggota</strong></th>
            <th class="text-center" style="width: 12%;"><strong>Transportasi</strong></th>
            <th class="text-center" style="width: 8%;"><strong>Dewasa</strong></th>
            <th class="text-center" style="width: 6%;"><strong>Anak</strong></th>
            <th class="text-center" style="width: 7%;"><strong>Bayar</strong></th>
            <th class="text-center" style="width: 10%;"><strong>Update</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($jemaat as $row) : ?>
            <tr>
                <td class="text-center text-wrap" style="width: 4%;">
                    <?= $i; ?>
                </td>
                <td class="text-wrap" style="width: 16%; <?= ($row["bayar"] == "") ? "background-color: red;" : ""; ?>"><?= $row["nama"]; ?></td>
                <td class="text-center text-wrap" style="width: 14%;"><?= $row["hp"]; ?></td>
                <td style="width: 23%;">
                    <?php foreach (preg_split("/\r\n|\n|\r/", $row["anggota"]) as $anggota) : ?>
                        <?php if ($anggota <> "") { ?>
                            <br><?= $anggota; ?>
                        <?php }; ?>
                    <?php endforeach; ?>
                </td>
                <td class="text-center" style="width: 12%; <?= ($row["transportasi"] == "panitia") ? "background-color: yellow;" : ""; ?>"><?= $row["transportasi"]; ?></td>
                <td class="text-center" style="width: 8%; "><?= $row["dewasa"]; ?></td>
                <td class="text-center" style="width: 6%; <?= ($row["anak"] >= 1) ? "background-color: green;" : ""; ?>"><?= $row["anak"]; ?></td>
                <td class="text-center" style="width: 7%;"><?= $row["bayar"]; ?></td>
                <td class="text-center text-wrap" style="width: 10%;"><?= date('d-m-Y', strtotime($row["updated_at"])); ?></td>
            </tr>
            <?php $i += 1; ?>
        <?php endforeach; ?>
        <tr>
            <td style="width: 69%; border: none"></td>
            <td class="text-center" style="width: 8%;"><?= $total["dewasa"]; ?></td>
            <td class="text-center" style="width: 6%;"><?= $total["anak"]; ?></td>
            <td class="text-center" style="width: 17%;">Rp <?= number_format($total["bayar"], 0, ',', '.'); ?></td>
        </tr>
    </tbody>
</table>
<h4>Total dewasa yang sudah bayar : <?= $total["dewasa_bayar"]; ?> Orang -> Rp <?= number_format($total["bayar"], 2, ',', '.'); ?></h4>
<h4>Total dewasa yang belum bayar : <?= ($total["dewasa"] - $total["dewasa_bayar"]); ?> Orang -> berpotensi mendapat Rp <?= number_format((($total["dewasa"] - $total["dewasa_bayar"]) * 50000), 0, ',', '.'); ?></h4>
<h4 style="color: red;">Total target keikutsertaan dewasa yang perlu dikejar : <?= 150 - $total["dewasa"]; ?> Orang lagi</h4>
<h4>Total Anak yang ikut : <?= $total["anak"]; ?> Anak<br></h4>
<h4><strong>Rincian Uang Masuk<strong></h4>
<table id="tb-item" style="width: 50%;">
    <tbody>
        <tr>
            <th class="text-center"><strong>Sumber</strong></th>
            <th class="text-center"><strong>Jumlah</strong></th>
        </tr>
        <tr>
            <td style="font-weight: normal;">Pendaftaran</td>
            <td style="text-align: right; font-weight: normal;">Rp <?= number_format($total["bayar"], 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-weight: normal;">Donasi Konsumsi Anak</td>
            <td style="text-align: right; font-weight: normal;">Rp <?= number_format(500000, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="font-weight: normal;">Donasi Ibu Sahale</td>
            <td style="text-align: right; font-weight: normal;">Rp <?= number_format(500000, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td class="text-center"><strong>Total</strong></td>
            <td style="text-align: right;">Rp <?= number_format(($total['bayar'] + 5000000 + 500000), 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td class="text-center"><strong>Rencana Pengeluaran</strong></td>
            <td style="text-align: right;">Rp <?= number_format(13240000, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td class="text-center"><strong>Kekurangan Dana</strong></td>
            <td style="text-align: right; color: red;">Rp <?= number_format((($total['bayar'] + 500000 + 500000) - 13240000), 2, ',', '.'); ?></td>
        </tr>
    </tbody>
</table><br>
<h4><strong>Rekap Kebutuhan Transportasi<strong></h4>
<table id="tb-item" style="width: 40%;">
    <thead>
        <tr>
            <th class="text-center"><strong>Kelompok</strong></th>
            <th class="text-center"><strong>Panitia</strong></th>
            <th class="text-center"><strong>Pribadi</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center" style="font-weight: normal;">Dewasa</td>
            <td class="text-center" style="font-weight: normal; color: red;"><?= $total["transportasi_dewasa"]; ?></td>
            <td class="text-center" style="font-weight: normal;"><?= $total['dewasa'] - $total["transportasi_dewasa"]; ?></td>
        </tr>
        <tr>
            <td class="text-center" style="font-weight: normal;">Anak</td>
            <td class="text-center" style="font-weight: normal; color: red;"><?= $total["transportasi_anak"]; ?></td>
            <td class="text-center" style="font-weight: normal;"><?= $total['anak'] - $total["transportasi_anak"]; ?></td>
        </tr>
    </tbody>
</table>