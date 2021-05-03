<?php
require('../../util/main.php');
require('../../model/database.php');
require('../../model/bread_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_bread';
    }
}
if ($action == 'list_bread') {
  try {
    $breads = get_available_breads();
    include('bread_list.php');
  } catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/database_error.php');
    exit();
  }
}
else if ($action == 'show_add_form') {
    include('bread_add.php');
}
else if ($action == 'add_bread') {
    $breads_name = filter_input(INPUT_POST, 'bread_name');
    if ($breads_name == NULL || $breads_name == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('errors/error.php');
        //once topping is added, no more need to look at this page
        exit();
    }
    else {
      try {
        add_bread($breads_name);
      } catch (PDOException $e) {
      $error_message = $e->getMessage();
      include('errors/database_error.php');
      exit();
    }
        header("Location: .");
    }
}
?>
