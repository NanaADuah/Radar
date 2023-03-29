<hr>
<nav class="navbar">
    <center>
        <h5>Test Questions</h5>
    </center>
    <div class="btn-group">
        <button type="button" class="btn btn-danger badge dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #5e5e5e;border-color: #3e3e3e;">
            <i class="fa fa-bars"></i>
            Add
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>?type=multiple">Add Multiple Choice Question</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>?type=objective">Add Objective Question</a></li>
            <li>
                <hr class="dropdown-divider">
                </hr>
            </li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>">Add Subjective Question</a></li>
        </ul>
    </div>

</nav>
<?php if (isset($total_questions)) : ?>
    <div><b>Total questions: </b> <?= $total_questions ?></div>
<?php endif; ?>

<hr>
<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = $total_questions + 1; ?>
    <?php foreach ($questions as $question) : $num-- ?>
        <div class="card my-3 shadow">
            <div class="card-header">
                <span class="bg-primary badge text-white rounded">
                    Question <?= $num ?>
                </span>
                <span class="float-end badge bg-secondary">
                    <?= get_date($question->date) ?>
                </span>
            </div>
            <div class="card-body">
                <?php
                $type = '';
                ?>
                <h6 class="card-title"><?= esc($question->question) ?></h6>
                <div>
                    <?php if (file_exists($question->image)) : ?>
                        <img src="<?= ROOT ?>/<?= $question->image ?>" style="max-width:500px">
                    <?php endif; ?>

                    <?php if ($question->question_type == "objective") :
                        $type = '?type=objective';
                    ?>
                        <p class="card-text"><span style="font-size: 1em;font-weight:bold">Answer: </span><?= esc($question->correct_answer) ?>
                        <?php elseif ($question->question_type == "multiple") :
                        $type = '?type=multiple';
                        ?>
                        <div class="card badge"style="width:50%;text-align:left;padding:0px;font-weight:normal" >
                            <div style="padding:0.5rem" class="card-header bg-secondary text-white">
                                <b>Multiple Choice Options</b> 
                            </div>
                            <ul class="list-group list-group-flush">
                                <?php $choices = json_decode($question->choices);?>
                                <?php
                                foreach($choices as $letter => $answer):?>
                                    <li class="list-group-item" 
                                        style="<?=$question->correct_answer == $letter ? 'background-color:#35dd35;color:white':''?>">
                                        <?=$letter?>: <?=$answer?>
                                        <i class="<?=trim($question->correct_answer) == trim($letter) ? 'fa fa-check float-end':''?>"></i>
                                    </li>

                                <?php endforeach;?>
                            </ul>
                        </div>
                        <br>
                        <p class="card-text"><span style="font-size:1em;font-weight:bold">Answer: </span><?= esc($question->correct_answer) ?>
                        <?php endif; ?>
                </div>


                <p class="card-text float-end">
                    <a href="<?= ROOT ?>/single_test/editquestion/<?= $row->test_id ?>/<?= $question->id ?><?= $type ?>">
                        <button class="btn btn-info text-white p-1 pe-0 badge"><i class="fa fa-edit"></i></button>
                    </a>
                    <a href="<?= ROOT ?>/single_test/deletequestion/<?= $row->test_id ?>/<?= $question->id ?><?= $type ?>">
                        <button class="btn btn-danger text-white p-1 pe-0 badge"><i class="fa fa-trash-alt"></i></button>
                    </a>
                </p>
            </div>
            <div class="card-footer text-muted">
                <?= esc($question->comment) ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>