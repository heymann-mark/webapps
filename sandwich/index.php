<?php
require('../util/main.php');
require('../model/database.php');
require('../model/order_db.php');
require('../model/topping_db.php');
require('../model/size_db.php');
require('../model/sauce_db.php');
require('../model/meat_db.php');
require('../model/bread_db.php');
//There won't be anything posted yet
//so the student_welcome page will show

//here INPUT_POST says that filter_input should get the
//data from the same source that is the input of $_POST
//POST will be empty unless you fill it
//an alternative would have been $action = $_POST['action']
//
//after clicking on student services the first time,
//$action will be NULL, setting $action to 'student_welcome'
//$customer will be NULL as well, so we set that to 1
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'customer_welcome';
    }
}

$customer = filter_input(INPUT_POST,'customer',FILTER_VALIDATE_INT);

if ($customer == NULL) {
    $customer = filter_input(INPUT_GET, 'customer');
    if ($customer == NULL || $customer == FALSE) {
       $customer = 1;
    }
}

//Once you click on the button 'select customer'
//in student_welcome, page is refreshed
//$action is now select_customer
//if you look at the functions, they use a PDO, $db
//so will return an error that can be caught
//by the first catch, which is here
//seee model/database for how errors will be handled
if ($action == 'customer_welcome'|| $action == 'select_customer') {
    try {
      $sizes = get_available_sizes();
      $breads = get_available_breads();
      $toppings =  get_available_toppings();
      $sauces = get_available_sauces();
      $meats =  get_available_meats();
      $customer_preparing_orders =  get_preparing_orders_of_customer($customer);
      $customer_ready_orders =  get_ready_orders_of_customer($customer);
  } catch (PDOException $exception) {
      $error_message = $exception->getMessage();
      include('errors/database_error.php');
      exit();
    }
    include('customer_welcome.php');
}
 else if ($action == 'order_sandwich') {
     try{
       $sizes = get_available_sizes();
       $breads = get_available_breads();
       $toppings= get_available_toppings();
       $sauces = get_available_sauces();
       $meats =  get_available_meats();
     } catch (PDOException $e) {
      $error_message = $e->getMessage();
      include('errors/database_error.php');
      exit();
    }
     include ('order_sandwich.php');
    }
    elseif ($action=='add_order') {
      echo "adding order"."<br>";
        $size_id = filter_input(INPUT_GET,'sandwich_size',FILTER_VALIDATE_INT);
        $bread_id = filter_input(INPUT_GET,'bread_type',FILTER_VALIDATE_INT);
        $customer = filter_input(INPUT_GET,'customer',FILTER_VALIDATE_INT);
        $n = filter_input(INPUT_GET,'n',FILTER_VALIDATE_INT);

        try {
        $current_day = get_current_day();
        $order_id = get_order_id()+1;

        } catch (PDOException $e) {
            echo "error: ".$e."<br>";
            $error_message = $e->getMessage();
            include('errors/database_error.php');
            exit();
        }
        $status=1;
        $topping_ids = filter_input(INPUT_GET,'sandwich_topping',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $meat_ids  = filter_input(INPUT_GET,'meat_type',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $sauce_ids  = filter_input(INPUT_GET,'sauce_type',FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($size_id == NULL || $size_id == FALSE||$topping_ids==NULL ) {
          $error = "Invalid size or topping data. Check Name field and try again."."$size_id"." $customer";
        include('errors/error.php');
        }
        try {
          echo "size-id ".$size_id;
            for ($i=0; $i<$n; $i++) {
                add_order($customer, $size_id, $bread_id, $current_day, $status, $sauce_ids, $meat_ids, $topping_ids);
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('errors/database_error.php');
            exit();
        }
        header("Location: .?customer=$customer");
    }
    elseif ($action=='update_order_status') {
        try {
        update_to_finished($customer);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('errors/database_error.php');
             exit();
        }
        header("Location: .?customer=$customer");
}


?>
