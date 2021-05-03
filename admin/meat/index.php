<?php
require('../../util/main.php');
require('../../model/database.php');
require('../../model/meat_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_meats';
    }
}
if ($action == 'list_meats') {
  try {
    $meats = get_available_meats();
    include('meat_list.php');
  } catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/database_error.php');
    exit();
  }
}
else if ($action == 'show_add_form') {
    include('meat_add.php');
}
else if ($action == 'add_meat') {
    $meats = filter_input(INPUT_POST, 'meat_name');

    if ($meats == NULL || $meats == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('errors/error.php');
        //once topping is added, no more need to look at this page
        exit();
    }
    else {
      try {  echo "meat;;;;".  $meats;
       add_meat($meats);
      } catch (PDOException $e) {
      $error_message = $e->getMessage();
      include('errors/database_error.php');
      exit();
    }
        header("Location: .");
    }
}
?>
