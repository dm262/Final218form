
<?php session_start(); ?>
<?php include './abstract-views/header.php'; ?>
<div class="container h-100 justify-content-center">

    <table class="table table-borderless">
        <tr>
            <th> <h1 class="border rounded"><?php echo $_SESSION["selected_question"]["title"]; echo " (Score: " . $_SESSION["selected_question"]["score"] . " )"?></h1></th>
        </tr>
        <tr>
            <th>Question: </th>
        </tr>
        <td><h5><?php echo $_SESSION["selected_question"]["body"];?></h5></td>
        <tr>
            <td><p><?php echo "Skills: " . $_SESSION["selected_question"]["skills"];?></p></td>
        </tr>

    </table>


</div>
<?php include './abstract-views/footer.php'; ?>
