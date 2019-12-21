<?php 

function getAllUsersQuestion($ownerEmail){
    global $db;

    $query ="SELECT `id`, `title`, `body`, `skills`, `score` FROM `questions` WHERE `owneremail`=:ownerEmail";

    $statement = $db->prepare($query);
    $statement->bindValue(':owneremail',$ownerEmail);
    $statement->execute();

    $questions =$statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $questions;
}

function getAQuestion ($id){
    global $db;

    $query ="SELECT `id`, `title`, `body`, `skills`, `score` FROM `questions` WHERE `id`=:id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();

    $questions =$statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $questions;
}

function enterQuestion($name,$body,$skills,$email,$ownerid) {
    global $db;

    $query  = "INSERT INTO `questions` (`owneremail`, `ownerid`, `createddate`, `title`, `body`, `skills`) VALUES (?,?,?,?,?,?)";
    $statement = $db->prepare($query);
    $date = date("Y-m-d h:m:s");
    $statement->execute([$name,$body,$date,$skills.$email,$ownerid]);
    $success = "Your question has been received";

}

function editQuestion($id,$name,$body,$skills){
    global $db;
    $query  = "UPDATE `questions` SET `title`=:title, `body`=:body, `skills`=:skills WHERE `id`=:id";
    $statement = $db->prepare($query);
    $statement ->bindValue(':title',$name);
    $statement ->bindValue(':body',$body);
    $statement ->bindValue(':skills',$skills);
    $statement ->bindValue(':id',$id);
    $statement ->execute();



}
function deleteQuestion($id){
    global $db;
    $query = "DELETE from `questions` WHERE `id`=:id" ;
    $statement =$db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();

}