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
<table>
    <h3>Data Transportasi Panitia</h3>
    <tr>
        <td style="width: 50%;">
            <h3>Dewasa</h3>
            <table id="tb-item">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55%;"><strong>Nama</strong></th>
                        <th class="text-center" style="width: 40%;"><strong>Transportasi</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($total['dewasa_transportasi'] as $row) : ?>
                        <?php if ($row['transportasi'] == 'panitia') { ?>
                            <tr>
                                <td class="text-center text-wrap" style="width: 55%;"><?= $row["nama"]; ?></td>
                                <td class="text-center text-wrap" style="width: 40%;"><?= $row["transportasi"]; ?></td>
                            </tr>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </td>
        <td style="width: 50%;">
            <h3>Sekolah Minggu</h3>
            <table id="tb-item">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55%;"><strong>Nama</strong></th>
                        <th class="text-center" style="width: 40%;"><strong>Transportasi</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($total['SM'] as $row) : ?>
                        <?php if ($row['transportasi'] == 'panitia') { ?>
                            <tr>
                                <td class="text-center text-wrap" style="width: 55%;"><?= $row["nama"]; ?></td>
                                <td class="text-center text-wrap" style="width: 40%;"><?= $row["transportasi"]; ?></td>
                            </tr>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </td>
    </tr>
</table>
<h3>-<br><br><br></h3>
<table>
    <h3>Data Transportasi Pribadi</h3>
    <tr>
        <td style="width: 50%;">
            <h3>Dewasa</h3>
            <table id="tb-item">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55%;"><strong>Nama</strong></th>
                        <th class="text-center" style="width: 40%;"><strong>Transportasi</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($total['dewasa_transportasi'] as $row) : ?>
                        <?php if ($row['transportasi'] == 'pribadi') { ?>
                            <tr>
                                <td class="text-center text-wrap" style="width: 55%;"><?= $row["nama"]; ?></td>
                                <td class="text-center text-wrap" style="width: 40%;"><?= $row["transportasi"]; ?></td>
                            </tr>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </td>
        <td style="width: 50%;">
            <h3>Sekolah Minggu</h3>
            <table id="tb-item">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 55%;"><strong>Nama</strong></th>
                        <th class="text-center" style="width: 40%;"><strong>Transportasi</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($total['SM'] as $row) : ?>
                        <?php if ($row['transportasi'] == 'pribadi') { ?>
                            <tr>
                                <td class="text-center text-wrap" style="width: 55%;"><?= $row["nama"]; ?></td>
                                <td class="text-center text-wrap" style="width: 40%;"><?= $row["transportasi"]; ?></td>
                            </tr>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </td>
    </tr>
</table>