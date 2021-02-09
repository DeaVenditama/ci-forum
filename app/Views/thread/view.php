<?php
    $hidden = [
        'id_thread' => $thread->id,
        'id_user' => session()->get('id'),
        'star' => 0
    ];

    $submit = [
        'name' => 'submit',
        'value' => 'Rate!!',
        'type' => 'submit',
        'id' => 'btn_rating',
    ];
?>
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <h1><?= $thread->judul ?></h1>
    <div class="container">
        <?= $thread->isi ?>
        <hr>
        <div class="flex-container">
            <div>
                <div>
                    <?php
                        for($i=0;$i<5;$i++)
                        {
                            if(($i+1)<=$rating_result)
                            {
                                echo '<span class="fa fa-star checked"></span>';
                            }else{
                                echo '<span class="fa fa-star"></span>';
                            }
                        }
                    ?>
                </div>
                <button id="btn_rating">Berikan Rating</button>
                <br>
                <small>
                    Created By <a href="<?= base_url('user/view/'.$user->id) ?>" ><?= $user->username ?></a> on <?= $kategori->kategori ?> at <?= $thread->created_at ?>
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

    <div id="myModal" class="modal">
        <div class="modal-content">
            Berikan Rating Pada Thread ini
            <div>
                <span class="fa fa-star " id="f_star_1" onClick="rate(1)"></span>
                <span class="fa fa-star " id="f_star_2" onClick="rate(2)"></span>
                <span class="fa fa-star " id="f_star_3" onClick="rate(3)"></span>
                <span class="fa fa-star " id="f_star_4" onClick="rate(4)"></span>
                <span class="fa fa-star " id="f_star_5" onClick="rate(5)"></span>
            </div>
            <?= form_open('thread/rate') ?>
                <?= form_hidden($hidden) ?>
                <?= form_submit($submit) ?>
            <?= form_close() ?>
        </div>
    </div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btn_rating");
    btn.onclick = function(){
        modal.style.display = "block";
    }
    window.onclick = function(event){
        if(event.target==modal){
            modal.style.display = "none";
        }
    }

    function rate(id)
    {
        document.getElementsByName("star")[0].value = id;
        switch(id){
            case 1 : 
                checked("f_star_1");
                unchecked("f_star_2");
                unchecked("f_star_3");
                unchecked("f_star_4");
                unchecked("f_star_5");
                break;
            case 2 :
                checked("f_star_1");
                checked("f_star_2");
                unchecked("f_star_3");
                unchecked("f_star_4");
                unchecked("f_star_5");
                break;
            case 3 :
                checked("f_star_1");
                checked("f_star_2");
                checked("f_star_3");
                unchecked("f_star_4");
                unchecked("f_star_5");
                break;
            case 4 :
                checked("f_star_1");
                checked("f_star_2");
                checked("f_star_3");
                checked("f_star_4");
                unchecked("f_star_5");
                break;
            case 5 :
                checked("f_star_1");
                checked("f_star_2");
                checked("f_star_3");
                checked("f_star_4");
                checked("f_star_5");
                break;
            default:
        }
    }

    function checked(star_id)
    {
        var element = document.getElementById(star_id);
        element.classList.add("checked");
    }

    function unchecked(star_id)
    {
        var element = document.getElementById(star_id);
        element.classList.remove("checked");
    }


</script>
<?= $this->endSection() ?>