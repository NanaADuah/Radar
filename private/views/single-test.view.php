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
                <tr><th>Created by: </th><td><?= esc($row->user->user->firstname) ?> <?= esc($row->user->user->lastname) ?>
                <th>Date Created: </th><td><?= get_date($row->date) ?></td></td></tr>
                <?php $active = $row->disabled ? "Inactive":"Active";?>
                <tr><th>Status:</th><td colspan="4"><?=$active?></td></tr>

                <tr><th>Test Description:</th><td colspan="3"><?=esc($row->description)?></td></tr>
            </table>
            <?php if(Auth::access('lecturer')):?>
                <a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
                            <button class="btn btn-primary btn-sm float-end badge"><i class="fa fa-chevron" ></i>View Tests</button>
                        </a>
            <?php endif;?>
        </div>

        <?php
        switch ($page_tab) 
        {
            case 'view':
                include(views_path('test-tab-view'));
                break;
                
            case 'add-question':
                include(views_path('test-tab-add-question'));
                break; 

            case 'edit-question':
                include(views_path('test-tab-edit-question'));
                break; 

            case 'delete-question':
                include(views_path('test-tab-delete-question'));
                break; 

            case 'edit':
                include(views_path('test-tab-edit'));
                break;
                
            case 'delete':
                include(views_path('test-tab-delete'));
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