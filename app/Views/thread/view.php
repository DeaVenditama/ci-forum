<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1><?= $thread->judul ?></h1>
    <div class="container">
        <?= $thread->isi ?>
        <hr>
        <div class="flex-container">
            <div>
                <small>
                    Created By <?= $user->username ?> on <?= $kategori->kategori ?> at <?= $thread->created_at ?>
                </small>
            </div>
            <div style="margin-left:auto">
                <h1><a href="<?= base_url('reply/create/'.$thread->id) ?>" style="color:#16a085">Buat Reply</a></h1>
            </div>
        </div>
    </div>
    <hr>
        <div style="text-align:center"><h1>REPLY</h1></div>
    <hr>
    <?php foreach($reply->getResult() as $r): ?>
        <div class="container" style="margin-top:30px;">
            <div class="flex-container">
                <div style="text-align:center">
                    <img src="<?= base_url("uploads/".$r->avatar) ?>" style="width:50px" /><br>
                    <small><strong><?= $r->nama ?></strong></small><br>                
                    <small><?= $r->created_at ?></small>
                </div>
                <div style="margin-left:30px">
                    <?= $r->isi ?>
                </div>
            </div>
            <div style="float:right">
                <a href="<?= base_url('reply/edit/'.$r->id) ?>" style="color:#3498db" >Edit</a>
                <a href="<?= base_url('reply/delete/'.$r->id.'/'.$thread->id) ?>" style="color:#c0392b">Delete</a>
            </div>
        </div>
    <?php endforeach ?>
<?= $this->endSection() ?>