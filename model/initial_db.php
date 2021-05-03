<?php
function initial_db() {
  //this will do for now, but it is considered a bad
  //practice. Another program will show how to use OOD + Dependency injection
    global $db;
    try {
    $query='delete from order_topping;';
    $query.='delete from order_sauce;';
    $query.='delete from order_meat;';
    $query.='delete from bread_type;';
    $query.='delete from meats;';
    $query.='delete from sauces;';
    $query.='delete from toppings;';
    $query.='delete from sandwich_size;';
    $query.='delete from sandwich_orders;';
    $query.='delete from sandwich_sys_tab;';

    $query.='insert into sandwich_sys_tab values (1, 1, 1, 1);';

    $query.="insert into toppings values (1,1,'Tomatoes');";
    $query.="insert into toppings values (2,1,'Lettuce');";
    $query.="insert into toppings values (3,1,'Onions');";

    $query.="insert into sandwich_size(1,1,'small');";
    $query.="insert into sandwich_size(2,1,'medium');";
    $query.="insert into sandwich_size(3,1,'large');";

    $query.="insert into sauces values (1,1,'Italian');";
    $query.="insert into sauces values (2,1,'Mayo');";
    $query.="insert into sauces values (3,1,'Mustard');";
    $query.="insert into sauces values (4,1,'Oil');";
    $query.="insert into sauces values (5,1,'Vinegar');";

    $query.="insert into meats values(1,1,'Veggie');";
    $query.="insert into meats values(2,1,'Turkey');";
    $query.="insert into meats values(3,1,'Salami');";
    $query.="insert into meats values(4,1,'Beef');";

    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/database_error.php');
    exit();
    }
    return $statement;
}

?>
