<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Update User</h1>
<?php
    $id = [
        'id' => $user->id,
    ];
    $username = [
        'name' => 'username',
        'value' => $user->username
    ];
    $nama = [
        'name' => 'nama',
        'value' => $user->nama
    ];
    $email = [
        'name' => 'email',
        'type' => 'email',
        'value' => $user->email
    ];
    $tanggal_lahir = [
        'name' => 'tanggal_lahir',
        'type' => 'date',
        'value' => $user->tanggal_lahir
    ];
    $alamat = [
        'name' => 'alamat',
        'value' => $user->alamat
    ];
    $telp = [
        'name' => 'telp',
        'type' => 'number',
        'value' => $user->telp
    ];
    $avatar = [
        'name' => 'avatar',
        'value' => null
    ];
    $submit = [
        'name' => 'submit',
        'value' => 'Submit',
        'type' => 'submit',
        'class' => 'button'
    ];
?>
<div class="container">
    <?= form_open_multipart('user/update/'.$user->id) ?>
        
        <?= form_hidden($id) ?>

        <?= form_label("Username","username") ?>
        <?= form_input($username) ?>

        <?= form_label("Nama","nama") ?>
        <?= form_input($nama) ?>

        <?= form_label("Tanggal Lahir","tanggal_lahir") ?>
        <?= form_input($tanggal_lahir) ?>

        <?= form_label("Email","email") ?>
        <?= form_input($email) ?>

        <?= form_label("Nomor Telp/Hp","telp") ?>
        <?= form_input($telp) ?>

        <?= form_label("Alamat","alamat") ?>
        <?= form_textarea($alamat) ?>
        
        Current Avatar<br>
        <img src="<?= base_url('uploads/'.$user->avatar) ?>" width="300px" style="padding:20px" /><br>

        <?= form_label("Avatar","avatar") ?>
        <?= form_upload($avatar) ?>

        <?= form_submit($submit) ?>

    <?= form_close() ?>
</div>
<?= $this->endSection() ?>