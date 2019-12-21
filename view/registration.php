<?php include('abstract-views/header.php'); ?>

    <form action="../index.php" name="registration" method="post">
        <input type="hidden" name="form_action" value="registration">

        <div class="form-group">
            <label for="firstname">firstname</label>
            <input type="text" class="form-control" name="firstname" id="firstname">

        </div>

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" name="lastname" id="lastname">
        </div>

        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" class="form-control" name="birthday" id="birthday">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>



        <button type="submit" class="btn btn-primary">Register</button>
    </form>

<?php include('abstract-views/footer.php'); ?>