<input type="hidden" name="baseurl" id="baseurl" value="<?= base_url(); ?>">
<div class="flash">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert" style="padding: 6px 12px; margin-bottom: 8px;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
</div>
<table id="tabelDataPendaftaran" class="table table-striped" style="width:100%">
    <thead>
        <tr class="table-dark">
            <th class="text-center">PIC</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($setoran as $row) : ?>
            <tr>
                <td class="text-center align-middle m-1 p-1 text-dark" style="width: 35%;">
                    <?= $row["pic"]; ?>
                </td>
                <td class="text-center align-middle m-1 p-1 text-dark" style="width: 30%;">
                    <?= number_format($row["jumlah"], 0, ',', '.'); ?>
                </td>
                <td class="text-center align-middle m-1 p-1" style="width: 35%;">
                    <?php if ($row['status'] == 0) : ?>
                        <i class="fas fa-circle-xmark" id="status"></i>
                        <?php if (in_groups('bendahara')) : ?>
                            <button type="button" id="status" class="btn btn-success btn-sm diterima text-dark ms-2 fw-bold" data-bs-toggle="modal" data-bs-target="#formterima" data-id="<?= $row["id"]; ?>">Accept</button>
                        <?php endif; ?>
                    <?php else : ?>
                        <i class="fas fa-circle-check" id="status"></i>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php foreach ($rekap as $row) : ?>
    <?php if ($row['pic'] == 'bendahara') : ?>
        <h4 class="text-black fw-bold" style="text-shadow: 2px 2px white;"><?= $row["pic"] . " : Rp " . number_format($row["total"], 2, ',', '.') ?></h4>
    <?php else : ?>
        <h4 class="text-black fw-bold" style="text-shadow: 2px 2px white;"><?= $row["pic"] . " : Rp " . number_format(($row["total"] - $row["kirim"]), 2, ',', '.') ?></h4>
    <?php endif; ?>
<?php endforeach; ?>
<script>
    $(document).ready(function() {
        $('.diterima').on('click', function() {
            $('#id').val($(this).data('id'))
        });
    });
</script>