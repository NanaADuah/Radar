<hr>
<nav class="navbar">
    <center>
        <h5>Test Questions</h5>
    </center>

</nav>
<?php if (isset($total_questions)) : ?>
    <div><b>Total questions: </b> <?= $total_questions ?></div>
<?php endif; ?>

<hr>
<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = 0; ?>
    <?php foreach ($questions as $question) : $num++ ?>
        <div class="card my-3">
            <div class="card-header bg-secondary text-white">
                <strong>
                    Question <?= $num ?>
                </strong>
            </div>
            <div class="card-body">
                <h6 class="card-title"><?= esc($question->question) ?></h6>
                <div>
                    <?php if (file_exists($question->image)) : ?>
                        <img src="<?= ROOT ?>/<?= $question->image ?>" style="max-width:500px">
                    <?php endif; ?>

                    <?php
                    //NON-MULTIPLE CHOICE
                    if ($question->question_type == "objective" || $question->question_type == "subjective") : ?>

                        <input type="text" name="<?= $question->id ?>" placeholder="Answer" class="form-control">
                    <?php
                    //MULTIPLE CHOICE
                    elseif ($question->question_type == "multiple") : ?>

                        <div class="card" style="width:50%;text-align:left;padding:0px;font-weight:normal">
                            <ul class="list-group list-group-flush">
                                <?php $choices = json_decode($question->choices); ?>
                                <?php
                                foreach ($choices as $letter => $answer) : ?>
                                    <li class="list-group-item"><input style="cursor: pointer" type="radio" name="<?= $question->id ?>" value="<?= $letter ?>">
                                        <?= $letter ?>. <?= $answer ?>
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <br>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer text-muted">
                <?= esc($question->comment) ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<div>
    <a href="">
        <button class="btn text-white btn-sm btn-secondary border">
            <strong>
                Save
            </strong>
        </button>
    </a>
    <a href="">
        <button class="btn text-white btn-sm btn-warning border">
            <strong>
                Submit
            </strong>
        </button>
    </a>
</div>