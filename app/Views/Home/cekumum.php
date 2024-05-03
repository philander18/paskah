<?= $this->extend('Templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6" style="height: 100vh;">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="col-3 col-md-2 text-center">
                            <label class="text-dark">
                                Search :
                            </label>
                        </div>
                        <div class="col-5 col-md-6">
                            <input class="form-control form-control-sm d-inline mr-3" type="search" style="background: rgba(255, 255, 255, 0.5);" id="keyword" name="keyword">
                        </div>
                        <div class="col-4">
                            <a class="btn btn-light text-dark fw-bold" href="<?= base_url(); ?>Home" role="button" style="width: 80%">Home</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2 tabelDataPendaftaran">
                    <input type="hidden" name="baseurl" id="baseurl" value="<?= base_url(); ?>">
                    <table id="tabelDataPendaftaran" class="table table-striped" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <th class="text-center">Nama</th>
                                <th class="text-center">Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jemaat as $row) : ?>
                                <tr>
                                    <td class="text-center align-middle m-1 p-1 text-dark" style="width: 70%;">
                                        <a href="" class="link-primary modalpanitia" data-bs-toggle="modal" data-bs-target="#formpanitia" data-id="<?= $row["id"]; ?>" name="nama" id="nama">
                                            <?= $row["nama"]; ?>
                                        </a>
                                    </td>
                                    <td class="text-center align-middle m-1 p-1" style="width: 30%;">
                                        <?php if (is_null($row['bayar'])) : ?>
                                            <i class="fas fa-circle-xmark" id="status"></i>
                                        <?php else : ?>
                                            <?= number_format($row["bayar"], 0, ',', '.'); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if ($jemaat) : ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if ($pagination['first']) : ?>
                                    <li class="page-item">
                                        <a class="page-link text-dark linkD" href="#" aria-label="First" id="first" name="first" data-page="1">
                                            <span aria-hidden="false">First</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php if ($pagination['previous']) : ?>
                                    <li class="page-item">
                                        <a class="page-link text-dark linkD" href="#" aria-label="Previous" id="previous" name="previous" data-page="<?= $page - 1; ?>">
                                            <span aria-hidden=" true">Previous</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php foreach ($pagination['number'] as $number) : ?>
                                    <li class="page-item <?= $pagination['page'] == $number ? 'active' : '' ?>">
                                        <a class="page-link text-dark linkD" href="#" id="nomor<?= $number; ?>" name="nomor<?= $number; ?>" data-page="<?= $number; ?>">
                                            <span aria-hidden="true"><?= $number; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                                <?php if ($pagination['next']) : ?>
                                    <li class="page-item">
                                        <a class="page-link text-dark linkD" href="#" aria-label="Next" id="next" name="next" data-page="<?= $page + 1; ?>">
                                            <span aria-hidden=" true">Next</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php if ($pagination['last']) : ?>
                                    <li class="page-item">
                                        <a class="page-link text-dark linkD" href="#" aria-label="<?= $last; ?>" id="last" name="last" data-page="<?= $last; ?>">
                                            <span aria-hidden="true"><?= $last; ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                    <h5 class="text-black" style="text-shadow: 2px 2px white;">Jumlah Data : <?= $jumlah; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formpanitia" tabindex="-1" aria-labelledby="judulpanitia" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="judulpanitia">Detail Pendaftar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top:2px;">
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label class="text-dark fw-bold ms-2 mb-2" id="pic" name="pic">Belum dibayar</label>
                </div>
                <table class="table table-borderless" style="margin-bottom: 0px;">
                    <tr>
                        <div class="form-group">
                            <td style="width: 30%;">
                                <label for="modalnama" class="fw-bold">Nama</label>
                            </td>
                            <td style="width: 70%;">
                                <input class="form-control form-control-sm" type="text" id="modalnama" name="modalnama" disabled>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td style="width: 30%;">
                                <label for="hp" class="fw-bold">No HP</label>
                            </td>
                            <td style="width: 70%;">
                                <input class="form-control form-control-sm" type="text" id="hp" name="hp" disabled>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <td style="width: 30%;">
                                <label for="anggota" class="fw-bold">Anggota</label>
                            </td>
                            <td style="width: 70%;">
                                <textarea class="form-control" id="anggota" name="anggota" rows="3" placeholder="Daftar anggota" disabled></textarea>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <td style="width: 30%;">
                                <label for="transportasi" class="fw-bold">Transportasi</label>
                            </td>
                            <td style="width: 70%;">
                                <select class="form-select" aria-label=".form-select-sm" name="transportasi" id="transportasi" disabled>
                                    <option value="panitia">Panitia</option>
                                    <option value="pribadi">Pribadi</option>
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <td style="width: 30%;">
                                <label for="dewasa" class="fw-bold">Dewasa</label>
                            </td>
                            <td style="width: 70%;">
                                <select class="form-select" aria-label=".form-select-sm example" name="dewasa" id="dewasa" disabled>
                                    <?php for ($x = 0; $x <= 10; $x++) { ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <td style="width: 30%;">
                                <label for="anak" class="fw-bold">Anak</label>
                            </td>
                            <td style="width: 70%;">
                                <select class="form-select" aria-label=".form-select-sm example" name="anak" id="anak" disabled>
                                    <?php for ($x = 0; $x <= 10; $x++) { ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <td style="width: 30%;">
                                <label for="bayar" class="fw-bold">Bayar</label>
                            </td>
                            <td style="width: 70%;">
                                <input class="form-control form-control-sm" type="text" id="bayar" name="bayar" disabled>
                            </td>
                        </div>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="updatepanitia" class="btn btn-primary updatedata" data-bs-dismiss="modal" hidden>Update</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>