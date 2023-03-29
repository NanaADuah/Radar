<?php
$image = get_image($row->image, $row->gender);
?>

<div class="card shadow m-2 badge text-black p-0 border-" style="max-width:15rem;min-width:15rem;">
    <div class="card-header bg-secondary text-white" style="text-align: left;">
        <div class="width:50%">
            <h6 class="card-title"><?= $row->firstname ?></h6>
            <h6><?= $row->lastname ?></h6>
        </div>
    </div>
    <hr style="margin-top: 0px;margin-bottom: 0px;">
    <div class="card-body p-0 pb-2 text-center ">
    <div>
        <img class= "card-img-top rounded-circle p-2 float-start" style="max-width: 80px" src="<?= $image ?>" alt="card image cap">
        <div class="card-text  p-2"> <h6>
        <?= ucwords(str_replace("_", " ", $row->rank)) ?></div>
        </h6>
    </div>
    <div>
    <h6>
        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn  badge btn-primary">Profile</a>
        <?php if (isset($_GET['select'])) : ?>
            <button class="btn btn-danger badge" name="selected" value="<?= $row->user_id ?>">Select</button>
        <?php endif; ?>
    </h6>
    </div>
    </div>
</div>