<?php

include "controller.php";


if (empty($_POST)){
    /* entry point, no post - just display login */
    display_login();
}
else {

    switch ($_POST["form_action"]) {
        case "login":
            if (login($_POST)) {
                get_questions($_SESSION["email"]);
                display_questions();

            } else {
                /* if failed just redirect back to login */
                display_login();
            }
            break;
        case "display_registration":
            display_registration();
            break;
        case "registration":
            if (register($_POST, $_SESSION)) {
                display_questions($_POST, $_SESSION);
            } else {
                display_login();
            }
            break;
        case "display_edit_question":
            display_edit_question($_POST);
            break;
        case "display_add_question":
            display_add_question();
            break;
        case "add_question":
            add_question($_POST, $_SESSION);
            display_questions();
            break;
        case "edit_question":
            edit_question($_POST,$_SESSION);
            display_questions();
            break;
        case "delete_question":
            delete_question($_POST, $_SESSION);
            display_questions();
            break;
    }


}