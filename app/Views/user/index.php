<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>User</h1>
<a href="<?= base_url('user/create') ?>" class="button" >Tambah User</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $key=>$user): ?>
            <tr>
                <td><?= ($key+1) ?></td>
                <td><a href="<?= base_url('user/view/'.$user->id) ?>"><?= $user->username ?></a></td>
                <td><?= $user->nama ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <a href="<?= base_url('user/update/'.$user->id) ?>">Update</a>
                    <a href="<?= base_url('user/delete/'.$user->id) ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>