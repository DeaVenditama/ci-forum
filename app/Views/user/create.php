<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Tambah User</h1>
<?php
    $username = [
        'name' => 'username',
    ];
    $password = [
        'name' => 'password',
    ];
    $repeatPassword = [
        'name' => 'repeatPassword',
    ];
    $nama = [
        'name' => 'nama',
    ];
    $email = [
        'name' => 'email',
        'type' => 'email'
    ];
    $tanggal_lahir = [
        'name' => 'tanggal_lahir',
        'type' => 'date'
    ];
    $alamat = [
        'name' => 'alamat'
    ];
    $telp = [
        'name' => 'telp',
        'type' => 'number'
    ];
    $avatar = [
        'name' => 'avatar',
    ];
    $submit = [
        'name' => 'submit',
        'value' => 'Submit',
        'type' => 'submit',
        'class' => 'button'
    ];
?>
<div class="container">
    <?= form_open_multipart('user/create') ?>
        
        <?= form_label("Username","username") ?>
        <?= form_input($username) ?>

        <?= form_label("Password","password") ?>
        <?= form_password($password) ?>

        <?= form_label("Repeat Password","repeatPassword") ?>
        <?= form_password($repeatPassword) ?>

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

        <?= form_label("Avatar","avatar") ?>
        <?= form_upload($avatar) ?>

        <?= form_submit($submit) ?>

    <?= form_close() ?>
</div>
<?= $this->endSection() ?>