<?php session_start() ?>

<?php include('abstract-views/header.php'); ?>
    <h2>Edit Question</h2>

    <form action="../index.php" name="edit_question" method="post">
        <input type="hidden" name="form_action" value="edit_question">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION["selected_question"]["id"]?>"  name="name" id="name">
        </div>

        <div class="form-group">
            <label for="body">body</label>
            <<textarea type="text" class="form-control" name="body" id="body"> <?php echo $_SESSION["selected_question"]["body"]?></textarea>
        </div>

        <div class="form-group">
            <label for="skills">skills</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION["selected_question"]["skills"]?>" name="skills" id="skills">
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>

<?php include('abstract-views/footer.php'); ?>