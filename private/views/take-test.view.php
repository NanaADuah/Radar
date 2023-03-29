<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav")?>
<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs", ['crumbs' => $data['crumbs']]) ?>
    <?php if ($row) : ?>
        <div class="row">
            <center>
                <h4><?= esc(ucwords($row->test)) ?></h4>
            </center>
            <table class="table table-hover table-striped table-bordered">
                <tr><th>Class: </th><td><?=$row->user->class ?> 
                <th>Test Date: </th><td><?= get_date($row->date) ?></td></td></tr>

            </table>
        </div>

        <?php
        switch ($page_tab) 
        {
            case 'view':
                include(views_path('take-test-tab-view'));
                break;

            default:
                break;
        }
        
        ?>

    <?php else : ?>
        <center>
            <h4>Class not found</h4>
        </center>
    <?php endif; ?>

</div>

<?php $this->view("includes/footer") ?>