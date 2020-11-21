<?php
  //connect to mySQL
  $conn = mysqli_connect('localhost', 'chris', '12345', 'mixPizza');

  if(!$conn){
    echo "Connection Error" . mysqli_connect_error();
  }

 ?>
