<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search " aria-describedby="basic-addon1">
        </div>
    </form>
    <?php if(Auth::access('lecturer')):?>
    <div>
        <a href="<?= ROOT ?>/single_class/studentremove/<?= $row->class_id ?>?select=true">
            <button class="btn btn-primary btn-sm"><i class="fa fa-minus"></i>Remove</button>
        </a>
        <a href="<?= ROOT ?>/single_class/studentadd/<?= $row->class_id ?>?select=true">
            <button class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-plus"></i>Add New</button>
        </a>
    </div>
    <?php endif; ?>
</nav>
<div>
    <?php if (is_array($students)) : ?>
        <div class="card-group">

            <?php foreach ($students as $stud) {
                $row = $stud->user;
                include(views_path('user'));
            }
            ?>
        </div>
    <?php else : ?>
        <center>
            <hr>
            <h4>
                No students were found.
            </h4>
        </center>
    <?php endif; ?>
    <?php $pager->display() ?>

</div>