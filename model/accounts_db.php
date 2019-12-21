<?php


function createNewUser($firstname,$lastname,$email,$birthday,$password) {
    global $db;

    $query ="INSERT 'INSERT INTO accounts (fname, lname, email, birthday, password) VALUES(?,?,?,?,?,?)";
    $statement =$db->prepare($query);


    $statement->execute([$firstname,$lastname,$email,$birthday,$password]);

}

function validate_user($email,$password){
    global $db;
    $result = getUser($email,$password);
    return(isset($result));
}

function getUser($email,$password){
    global $db;
    $query ="SELECT `id`, `email`, `fname`, `lname`, `birthday` from `accounts` WHERE `email`=:email AND `password`=:password";
    $statement= $db->prepare($query);
    $statement->bindValue(':password',$password);
    $statement->bindValue(':email',$email);
    $statement->execute();
    $result =$statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}