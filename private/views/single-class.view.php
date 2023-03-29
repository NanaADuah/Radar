<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav")?>
<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs", ['crumbs' => $data['crumbs']]) ?>
    <?php if ($row) : ?>
        <div class="row">
            <center>
                <h4><?= esc(ucwords($row->class)) ?></h4>
            </center>
            <table class="table table-hover table-striped table-bordered">
                <tr><th>Created by: </th><td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?>
                <th>Date Created: </th><td><?= get_date($row->date) ?></td></td></tr>
            </table>
        </div>
        <hr>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == "lecturers" ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">Lecturers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'students' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Tests</a>
            </li>
        </ul>

        <?php
        switch ($page_tab) 
        {
            case 'lecturers':
                include(views_path('class-tab-lecturers'));
                break;
                
            case 'students':
                include(views_path('class-tab-students'));
                break;
                
            case 'tests':
                if(Auth::access('lecturer'))
                {
                    include(views_path('class-tab-tests'));
                }else
                {
                    include(views_path('access-denied'));
                }
                break;
                
            case 'lecturer-add':

                include(views_path('class-tab-lecturers-add'));
                break;  

            case 'student-add':
                include(views_path('class-tab-students-add'));
                break;  

            case 'lecturer-remove':
                include(views_path('class-tab-lecturers-remove'));
                break;

            case 'student-remove':
                include(views_path('class-tab-students-remove'));
                break;
                
            case 'students-add':
                include(views_path('class-tab-students-add'));
                break;
                
            case 'test-add':
                include(views_path('class-tab-test-add'));
                break; 

            case 'test-edit':
                include(views_path('class-tab-test-edit'));
                break;

            case 'test-delete':
                include(views_path('class-tab-test-delete'));
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