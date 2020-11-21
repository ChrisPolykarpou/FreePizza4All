<?php
  //connect to mySQL
  $conn = mysqli_connect('localhost', 'root', 'CHr16091997', 'mixPizza');

  if(!$conn){
    echo "Connection Error" . mysqli_connect_error();
  }

 ?>
