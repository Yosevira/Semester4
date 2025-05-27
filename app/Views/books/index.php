<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Buku</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($buku as $b) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $b ['sampul'];?>" alt="" class="sampul"></td>
                        <td><?= $b['judul']; ?></td>
                        <td><a href="/books/detail/<?= $b['slug'];?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <a href="/books/create" class="btn btn-primary mb-3">Tambah Data Buku</a>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?php if (session()->getFlashdata('pesan')) : ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('pesan'); ?>
</div>
<?php endif; ?>