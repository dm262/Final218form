<?php include('abstract-views/header.php'); ?>
<h2>Enter Question</h2>

    <form action="../index.php" name="addquestion" method="post">
        <input type="hidden" name="form_action" value="add_question">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="title">
        </div>

        <div class="form-group">
            <label for="body">body</label>
            <input type="text" class="form-control" name="body" id="body">
        </div>

        <div class="form-group">
            <label for="skills">skills</label>
            <input type="text" class="form-control" name="skills" id="skills">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php include('abstract-views/footer.php'); ?>