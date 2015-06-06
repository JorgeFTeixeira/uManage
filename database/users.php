<?php

function createUser($name, $email, $username, $password) {
  global $conn;
  $stmt = $conn->prepare("INSERT INTO users (name, email, username, password, register_date) VALUES (:name, :email, :username, :password, :data) ");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':data', date("Y/m/d"));
  $stmt->execute();
}

function isLoginCorrect($username, $password) {

  global $conn;
  $stmt = $conn->prepare("SELECT *
    FROM users
    WHERE username= :username AND password= :password"
    );
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_NUM);
  if($rows>1){
    return true;
  }
  return false;
}

/*function viewUsers(){
  global $conn;
    /*$stmt = $conn->prepare( "SELECT * FROM Utilizador" );
    $stmt->execute();
    return $stmt;*/


   /* $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
    } else {
      echo "0 results";
    }

  }*/

function getUser(){
  global $conn;
  $username = $_SESSION['username'];
  $stmt = $conn->prepare("SELECT * FROM users WHERE username= :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  return $stmt->fetch();
}

function getUserProj(){
  global $conn;
  $username = $_SESSION['username'];
  $stmt = $conn->prepare("SELECT name, description FROM project, users_project,(SELECT users_id FROM users WHERE username=:username) AS iduser WHERE project.coordenator_id=iduser.users_id OR users_project.users_id=iduser.users_id");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  return $stmt->fetchAll();
}

  ?>
