<?= $this->extend('layout/template');?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mt-3">Detail Penulis</h2>
            <div class="card">
                <div class="card-header">
                    Detail Data Penulis
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $penulis['name']; ?></h5>
                    <p class="card-text"><b>Alamat:</b> <?= $penulis['address']; ?></p>
                    <p class="card-text"><b>Nomor Telpon:</b> <?= $penulis['phone']; ?></p>
                    <p class="card-text"><b>Email:</b> <?= $penulis['email']; ?></p>
                    <p class="card-text"><b>Dibuat pada:</b> <?= $penulis['created_at']; ?></p>
                    <p class="card-text"><b>Terakhir Diperbarui:</b> <?= $penulis['updated_at']; ?></p>

                    <a href="/penulis">Kembali ke Daftar Penulis</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>