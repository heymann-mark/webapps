<?php
// set up to execute on XAMPP
// set up a mysql user named sandwichShop_user on your own system

    $dsn = 'mysql:host=localhost;dbname=sandwichdb';
    $username = 'root';
    $location = '';
    $password = '';  // or your choice
    //error is "thrown" with $dbh =
    //but if dbh = had called another function, which called another function, which...
    //then the error would have bubbled up the call stack until we find
    //the catch clause which catches the PDOexception and names it $e
    //then we have some instructions on what to do with it
    //ATTR_ERRMODE: error reporting
    //setAttribute(ATTRIBUTE, OPTION);
    //the attribute is error reporting, it's an attribute of the PDO object
    //the option is to throw exceptions


try {
  //the double colon :: is the scope resolution operator
  //or also called Paamayim Nekudotayim, Hebrew letter
  //It's the same idea as Math.PI in Java, PDO is the name of the class,
  //and  ATTR_ERRMODE is a class attribute.
  //The double arrow opersaotr is just key to value for the
  //associative array
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/database_error.php');
    exit();
}
?>
