<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Buku</h2>

            <?php if ($validation->hasError('judul') || $validation->hasError('penulis') || $validation->hasError('penerbit')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php if ($validation->hasError('judul')) : ?>
                    <li><?= $validation->getError('judul'); ?></li>
                    <?php endif; ?>
                    <?php if ($validation->hasError('penulis')) : ?>
                    <li><?= $validation->getError('penulis'); ?></li>
                    <?php endif; ?>
                    <?php if ($validation->hasError('penerbit')) : ?>
                    <li><?= $validation->getError('penerbit'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('pesan'); ?></div>
            <?php endif; ?>

            <form action="/books/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul"
                            name="judul" autofocus value="<?= old('judul') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>"
                            id="penulis" name="penulis" value="<?= old('penulis') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>"
                            id="penerbit" name="penerbit" value="<?= old('penerbit') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('penerbit'); ?>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="<?= base_url('img/no-cover.jpg'); ?>" class="img-thumbnail img-preview"
                            alt="Preview Sampul">
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="file"
                                class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>"
                                id="sampul" name="sampul" onchange="previewImg()">
                            <label class="input-group-text" for="sampul">Upload</label>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('sampul'); ?>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>