<?php

require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');
session_start();


$email_regex = "/\w+@\w+/";
$password_regex = "/\w{8,}/";
$notempty_regex = "/\w+/";


session_start();


function validation_result($value, $regex){
    if (preg_match($regex,$value)){
        return $value;
    }
    else {
        return sprintf("Value '%s' failed using regex %s", $value, $regex);
    }
}

function all_valid($pairs){
    foreach($pairs as $pair){
        $value = $pair[0];
        $regex = $pair[1];
        if (!is_valid($value, $regex)){
            return false;
        }
    }
    return true;
}

function is_valid($value, $regex){
    return preg_match($regex, $value);
}



function display_login(){
    header("Location: view/login.php");

}
function display_registration(){
    header("Location: view/registration.php");
}

function validate_skills_list($skills){
    /* custom thing for the array */
    if (preg_match("/\w+, \w+/", $skills)){
        $skills_items = explode(", ", $skills);
        $skills_text = implode(", ", $skills_items);
        return true;
    }
    else {
        return false;
    }
}

function login($post){
    global $email_regex;
    global $password_regex;
    global $_SESSION;
    $pairs = [
        [$post["email"], $email_regex],
        [$post["password"], $password_regex]
    ];

    if (all_valid($pairs)){
        if(validate_user($post["email"], $post["password"])){
            /* set data so we can use this later */
            $res = getUser($post["email"], $post["password"]);
            $_SESSION["email"] = $res["email"];
            $_SESSION["firstname"] = $res["fname"];
            $_SESSION["lastname"] = $res["lname"];
            $_SESSION["userid"] = $res["id"];
            return true;
        }
    }
    else {
        return false;
    }
}

function register($post){
    global $notempty_regex;
    global $email_regex;
    global $password_regex;
    global $_SESSION;
    $pairs = [
        [$post["firstname"], $notempty_regex],
        [$post["lastname"], $notempty_regex],
        [$post["birthday"], $notempty_regex],
        [$post["email"], $email_regex],
        [$post["password"], $password_regex]
    ];
    /* insert */
    if (all_valid($pairs)){
        createNewUser($post["email"], $post["firstname"], $post["lastname"], $post["birthday"], $post["password"]);
        /* set data */
        $res = getUser($post["email"], $post["password"]);
        $_SESSION["email"] = $res["email"];
        $_SESSION["firstname"] = $res["fname"];
        $_SESSION["lastname"] = $res["lname"];
        $_SESSION["userid"] = $res["id"];
        return true;
    } else {
        return false;
    }
}
function add_question($post){
    global $_SESSION;
    $pairs = [
        [$post["name"], "/\w{3,}/"],
        [$post["body"], "/.{0,500}/"]
    ];
    /* insert */
    if (all_valid($pairs) and validate_skills_list($post["skills"])){
        enterQuestion($post["name"], $post["body"], $post["skills"], $_SESSION["email"], $_SESSION["userid"]);
        /* update the questions data */
        get_questions($_SESSION["email"]);
        return true;
    }
    else {
        return false;
    }
}

function edit_question($post){
    global $_SESSION;
    $pairs = [
        [$post["name"], "/\w{3,}/"],
        [$post["body"], "/.{0,500}/"]
    ];
    /* insert */
    if (all_valid($pairs) and validate_skills_list($post["skills"])){
        editQuestion($post["id"], $post["name"], $post["body"], $post["skills"]);
        /* update the questions data */
        get_questions($_SESSION["email"]);
        return true;
    }
    else {
        return false;
    }
}

function delete_question($post){
    global $_SESSION;
    deleteQuestion($post["id"]);
    get_questions($_SESSION["email"]);
}

function get_questions($user){
    global $_SESSION;
    $_SESSION["questions"] = getAllUsersQuestion($user);
}

function get_all_questions(){
    global $_SESSION;
    $_SESSION["all_questions"] = getAllUsersQuestion();
}

function display_one_question($post){
    global $_SESSION;
    $_SESSION["selected_question"] = getAQuestion($post["id"]);
    header("Location: view/view_question.php");
}

function display_questions(){
    header("Location: view/all_questions.php");
}

function display_add_question(){
    header("Location: view/add_question.php");
}

function display_edit_question($post){
    global $_SESSION;
    $_SESSION["selected_question"] = getAQuestion($post["id"]);
    header("Location: view/edit_question.php");
}

function logout(){
    global $_SESSION;
    session_destroy();
}