<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1>Kirim Pesan ke <?= $recipient->nama ?></h1>
    <?php
        $hidden = [
            'id_sender' => session()->get('id'),
            'id_recipient' => $recipient->id,
            'is_read' => 0,
            'created' => date("Y-m-d H:i:s"),
        ];
        
        $message = [
            'name' => 'message',
        ];

        $submit = [
            'value' => 'Kirim',
            'type' => 'submit',
            'class' => 'button'
        ];    
    ?>
    <div class="container">
        <?= form_open('messages/create/'.$recipient->id) ?>

            <?= form_hidden($hidden) ?>

            <?= form_label("Pesan", "message") ?>
            <?= form_textarea($message) ?>

            <?= form_submit($submit) ?>

        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>