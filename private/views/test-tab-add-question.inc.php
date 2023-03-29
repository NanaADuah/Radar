<hr>
<?php
$questionType = 'Subjective';
if (isset($_GET['type']) && $_GET['type'] == "objective") {
    $questionType = "objective";
} else
    if (isset($_GET['type']) && $_GET['type'] == "multiple") {
    $questionType = "Multiple Choice";
}
?>

<h5>
    <center>Add <?= ucwords($questionType) ?> Question</center>
</h5>

<form method="post" enctype="multipart/form-data">
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissable fade show p-1" role="alerts">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <br><?= $error ?>
            <?php endforeach ?>
            <span type="button" class="clone" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </span>
        </div>
    <?php endif; ?>
    <div class="pb-1">
    </div>
    <div class="input-group mb-3 pt-2">
        <label class="input-group-text"><strong>Question</strong></label>
        <input name="question" autofocus placeholder="Type your question here" value="<?= get_var('comment') ?>" class="form-control"></input>
    </div>
    <?php if (isset($_GET['type']) && $_GET['type'] == "objective") : ?>
        <div class="input-group mb-3 pt-2">
            <label class="input-group-text" for="inputGroupFile01"><strong>Answer</strong></label>
            <input name="correct_answer" type="text" value="<?= get_var('answer') ?>" placeholder="Type the answer for the question here" class="form-control" id="inputGroupFile011">
        </div>
    <?php elseif (isset($_GET['type']) && $_GET['type'] == "multiple") : ?>
        <div class="card">
            <div class="text-white bg-secondary card-header">
                Multiple Choice Answers <button class="btn btn-sm btn-secondary float-end badge shadow" type="button" onclick="addChoice()"><i class="fa fa-plus"></i> Add More</button>
            </div>
            <ul class="list-group list-group-flush choice-list">
                <?php if (isset($_POST['choice0'])) : ?>
                    <?php
                    $num = 0;
                    $letters = ['A', 'B', 'C', 'D', 'E'];

                    foreach ($_POST as $key => $value) {
                        if (strstr($key, 'choice')) {
                    ?>
                            <li class="list-group-item">
                                <?= $letters[$num] ?>: <input value="<?= $value ?>" type="text" class="form-control" name="<?=$key?>" placeholder="Type the answer here">
                                <label style="cursor: pointer;">
                                <input type="radio" value="<?=$letters[$num]?>" name="correct_answer" <?php $letters[$num] == $_POST['correct_answer'] ? 'checked': '';?>> Correct Selection
                                </label>
                            </li>
                    <?php
                            $num++;
                        }
                    }
                    ?>
                <?php else : ?>
                    <li class="list-group-item">
                        A: <input type="text" class="form-control" name="choice0" placeholder="Type the answer here">
                        <label style="cursor: pointer;">
                            <input value="A" type="radio"name="correct_answer"> Correct Selection
                        </label>
                    </li>
                    <li class="list-group-item">
                        B: <input type="text" class="form-control" name="choice1" placeholder="Type the answer here">
                        <label style="cursor: pointer;">
                        <input type="radio" value="B"  name="correct_answer"> Correct Selection
                        </label>
                    </li>
                <?php endif; ?>
            </ul>
        </div><br>
    <?php endif; ?>
    <strong>
        Additional
    </strong>
    <br>
    <div class="input-group mb-3 pt-2">
        <label class="input-group-text"><strong>Comment</strong></label>
        <input type="text" value="<?= get_var('comment') ?>" name="comment" placeholder="Comment (optional)" class="form-control"></input>
    </div>
    <div class="input-group mb-3 pt-2">
        <label class="input-group-text" for="inputGroupFile01"><i class="fa fa-image"></i>Image (optional)</label>
        <input name="image" type="file" class="form-control" id="inputGroupFile01">
    </div>


    <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back</button>
    </a>
    <button class="btn btn-danger float-end">Save Question</button>

</form>

<script>
    var letters = ['A', 'B', 'C', 'D', 'E'];

    function addChoice() {
        var choices = document.querySelector(".choice-list");
        if (choices.children.length < letters.length) {

            choices.innerHTML += `<li class="list-group-item">
                    ${letters[choices.children.length]}: <input type="text" class="form-control" name="choice${choices.children.length}" placeholder="Type the answer here">
                    <label style="cursor: pointer;"><input type="radio"  name="correct_answer" value="${letters[choices.children.length]}"> Correct Selection</label>
                </li>`
        } else {
            alert("Maximum choices allowed is 5!")
        }
    }
</script>