<?php

session_start();

$errors = "";

require "functions.php";

function connect(){
    $connection = dbConnection();

    if( $connection ){
        $sql = "SELECT * FROM admins WHERE email = ? and password = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param("ss", $_POST['email'], $_POST['password']);
        $statement->execute();

        $query = $statement->get_result();
        if($query->num_rows >= 1){
            $_SESSION['user'] = $query->fetch_assoc()['name'];
            header("Location: admin.php");
        }else{
            echo "<span class='err'>Either the email or the password are wrong</span>";
        }
    }else{
        echo "There was an error with the database, try later.";
    }
}

if( isset($_POST['submit']) ){
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if( isset($_SESSION['user']) ){
    $articlesConnection = dbConnection();
    if( $articlesConnection->errno ){
        $articlesList = "<span>Sorry, there was an error with the database</span>";
    }else{
        $sql = "SELECT title from articles";
        $query = $articlesConnection->prepare($sql);
        $query->execute();

        $result = $query->get_result();

        if($result->num_rows == 0){
            $errors .= "<span><p>There are no articles yet.</p> <br> <a href='new-article.php' class='new-article'>Create a new article</a></span>";
        }

    }
}

require "views/admin.view.php";