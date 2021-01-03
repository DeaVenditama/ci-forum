<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1>Update Thread : <?= $thread->judul ?></h1>
    <?php
        $id = [
            'id' => $thread->id
        ];
        $judul = [
            'name' => 'judul',
            'value' => $thread->judul,
        ];
        $isi = [
            'name' => 'isi',
            'id' => 'isi',
            'value' => $thread->isi,
        ];
        $id_kategori = [
            'name' => 'id_kategori',
            'options' => $arrayKategori,
            'selected' => $thread->id_kategori,
        ];
        $submit = [
            'name' => 'submit',
            'value' => 'Submit',
            'type' => 'submit',
            'class' => 'button'
        ];    
    ?>
    <div class="container">
        <?= form_open_multipart('thread/update/'.$thread->id) ?>

            <?= form_hidden($id) ?>

            <?= form_label("Judul","judul") ?>
            <?= form_input($judul) ?>

            <?= form_label("Kategori","id_kategori") ?>
            <?= form_dropdown($id_kategori) ?>

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
                    uploadUrl: "<?= base_url('thread/uploadImages') ?>",
                },
            }).then(editor=>{
                console.log(editor);
            }).catch(error=>{
                console.log(error);
            });
    </script>
<?= $this->endSection() ?>