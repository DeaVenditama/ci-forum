<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1>Reply Thread : <i><?= $thread->judul ?></i></h1>
    <?php
        $hidden_data = [
            'id_thread' => $thread->id,
            'id_user' => session()->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('id'),
        ];
        $isi = [
            'name' => 'isi',
            'id' => 'isi',
        ];
        $submit = [
            'name' => 'submit',
            'value' => 'Submit',
            'type' => 'submit',
            'class' => 'button'
        ];    
    ?>
    <div class="container">
        <?= form_open_multipart('reply/create/'.$thread->id) ?>
            
            <?= form_hidden($hidden_data) ?>

            <?= form_label("Isi","isi") ?>
            <?= form_textarea($isi) ?>

            <?= form_submit($submit) ?>

        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script src="<?= base_url('ckeditor5/ckeditor.js') ?>"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#isi'),{
                ckfinder:{
                    uploadUrl: "<?= base_url('reply/uploadImages') ?>",
                },
            }).then(editor=>{
                console.log(editor);
            }).catch(error=>{
                console.log(error);
            });
    </script>
<?= $this->endSection() ?>