<?= $this->extend('Templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6" style="height: 100vh;">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <a class="btn btn-light text-dark fw-bold" href="<?= base_url(); ?>pdf/cetakSetor" role="button" style="width: 80%">Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-md-2 text-center">
                            <label class="text-dark">
                                Search :
                            </label>
                        </div>
                        <div class="col-5 col-md-6">
                            <input class="form-control form-control-sm d-inline mr-3" type="search" style="background: rgba(255, 255, 255, 0.5);" id="keywordsetoran" name="keywordsetoran">
                        </div>
                        <div class="col-4">
                            <a class="btn btn-light text-dark fw-bold" href="<?= base_url(); ?>Home" role="button" style="width: 80%">Home</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2 tabelDataSetoran">
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formterima" tabindex="-1" aria-labelledby="judulterima" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="judulterima">Konfirmasi Setoran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top:2px;">
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label class="text-dark fw-bold ms-2 mb-2" id="accept" name="accept">Sudah terima uang?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                <button type="button" id="confirmterima" class="btn btn-primary terima" data-bs-dismiss="modal">YA</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>