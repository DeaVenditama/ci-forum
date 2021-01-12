<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Threads</h1>
<a href="<?= base_url('thread/create') ?>" class="button">Buat Thread/Postingan Baru</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Thread</th>
            <th>Kategori</th>
            <th>Posted By</th>
            <?php if(session()->get('role')==0): ?>
                <th>Action</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($threads->getResult() as $key=>$thread): ?>
            <tr>
                <td><?= $offset+$key+1 ?></td>
                <td>
                    <a href="<?= base_url('thread/view/'.$thread->id) ?>">
                        <?= $thread->judul ?></td>
                    </a>
                <td><?= $thread->kategori ?></td>
                <td><?= $thread->nama ?></td>
                <?php if(session()->get('role')==0): ?>
                    <td>
                        <a href="<?= base_url('thread/update/'.$thread->id) ?>">Update</a>
                        <a href="<?= base_url('thread/delete/'.$thread->id) ?>">Delete</a>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'custom_pagination') ?>
<?= $this->endSection() ?>