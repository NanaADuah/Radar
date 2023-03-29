<hr>
<h5>

<?php if(is_object($question)):?>
    <center>Delete Question</center>
</h5>

<form method="post" enctype="multipart/form-data">
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissable fade show p-1" role="alerts">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <br><?= $error?>
            <?php endforeach ?>
            <span type="button" class="clone" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </span>
        </div>
    <?php endif;?>
    <div class="pb-1">
    </div>
    <div class="input-group mb-3 pt-2">
        <label class="input-group-text"><strong>Question</strong></label>
        <input name="question" readonly placeholder="Type your question here" value="<?=get_var('comment',$question->question)?>" class="form-control"></input>
    </div>
    <?php if(isset($_GET['type']) && $_GET['type'] == "objective"):?>
        <div class="input-group mb-3 pt-2">
            <label class="input-group-text" for="inputGroupFile01"><strong>Answer</strong></label>
            <input name="correct_answer" type="text" value="<?=get_var('answer',$question->correct_answer)?>" placeholder="Type the answer for the question here" class="form-control" id="inputGroupFile011">
        </div>
    <?php endif;?>
    <strong>
    Additional 
    </strong>
    <br>
    <div class="input-group mb-3 pt-2">
        <label class="input-group-text"><strong>Comment</strong></label>
        <input type="text" readonly value="<?=get_var('comment',$question->comment)?>" name="comment" placeholder="Comment (optional)" class="form-control"></input>
    </div>

    <?php if(isset($question->image) && file_exists($question->image)):?>
        <div>
            <img class="d-block mx-auto w-50%" src="<?=ROOT?>/<?=$question->image?>" style="max-width: 500px;">
            <br>
        </div>
    <?php endif;?>

    <a href="<?=ROOT?>/single_test/<?= $row->test_id?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back</button>
    </a>       
    <button class="btn btn-danger float-end">Delete Question</button>


</form>

<?php else:?>
<div>
<h3>
<center>
Question not found :(
</center>
</h3>
<hr>
<br>
<a href="<?=ROOT?>/single_test/<?= $row->test_id?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back</button>
    </a>    </div>
<?php endif;?>