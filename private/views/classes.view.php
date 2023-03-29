<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs", ['crumbs' => $crumbs]) ?>
    <center>
        <h5>Classes</h5>
    </center>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div style="margin-left:10px;" class="input-group">
                <div class="input-group-prepend">
                    <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                </div>
                <input type="text" value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" name="find" class="form-control" placeholder="Search" aria-label="Search " aria-describedby="basic-addon1">
            </div>
        </form>
        <?php if (Auth::access('lecturer')) : ?>
            <a href="<?= ROOT ?>/classes/add">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-plus"></i>Add New</button>
            </a>
        <?php endif ?>
    </nav>
    <?php include(views_path('classes')) ?>

</div>

<?php $this->view("includes/footer") ?>