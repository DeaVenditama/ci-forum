<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1>Lihat Pesan</h1>
    <div class="container">
        <div>
            From : <?= $sender->nama ?><br>
            To : <?= $recipient->nama ?><br>
        </div>
        <hr>
        <h4>Message : </h4>
        <?= $messages->message ?>
        <hr>
        <a href="<?= base_url("messages/create/".$sender->id) ?>">Balas Pesan</a>
    </div>
<?= $this->endSection() ?>