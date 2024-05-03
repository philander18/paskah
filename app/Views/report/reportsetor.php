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
<h3>Data Setoran</h3>
<table id="tb-item">
    <thead>
        <tr>
            <th class="text-center" style="width: 25%;"><strong>PIC</strong></th>
            <th class="text-center" style="width: 25%;"><strong>Jumlah</strong></th>
            <th class="text-center" style="width: 25%;"><strong>Status</strong></th>
            <th class="text-center" style="width: 25%;"><strong>Update</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($setoran as $row) : ?>
            <tr>
                <td class="text-center text-wrap" style="width: 25%;"><?= $row["pic"]; ?></td>
                <td class="text-center text-wrap" style="width: 25%;"><?= $row["jumlah"]; ?></td>
                <td class="text-center text-wrap" style="width: 25%;"><?= $row["status"]; ?></td>
                <td class="text-center text-wrap" style="width: 25%;"><?= $row["updated_at"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>