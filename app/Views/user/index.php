<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>User</h1>
<a href="<?= base_url('user/create') ?>" class="button" >Tambah User</a>
<?= $this->endSection() ?>