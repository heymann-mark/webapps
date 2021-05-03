<?php
function get_preparing_orders() {
    global $db;
    $query = 'SELECT * FROM sandwich_orders where status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}
function get_ready_orders() {
    global $db;
    $query = 'SELECT * FROM sandwich_orders where status=2';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}
function get_preparing_orders_of_customer($customer) {
    global $db;
    $query = 'SELECT * FROM sandwich_orders where status=1 and customer_id=:customer';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer',$customer);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    $orders = add_bread_to_orders($orders);
    $orders = add_size_to_orders($orders);
    $orders = add_meats_to_orders($orders);
    $orders = add_sauces_to_orders($orders);
    $orders = add_toppings_to_orders($orders);
    return $orders;
}

function get_ready_orders_of_customer($customer) {
    global $db;
    $query = 'SELECT * FROM sandwich_orders where status=2 and customer_id=:customer';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer',$customer);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    $orders = add_bread_to_orders($orders);
    $orders = add_size_to_orders($orders);
    $orders = add_meats_to_orders($orders);
    $orders = add_sauces_to_orders($orders);
    $orders = add_toppings_to_orders($orders);
    return $orders;
}
// helper to above two functions
function add_bread_to_orders($orders) {
for ($i=0; $i<count($orders);$i++) {
        $bread = get_orders_bread($orders[$i]['bread_id']);
        $orders[$i]['bread_name'] = $bread; // add toppings to order
}
    return $orders;
}
function add_size_to_orders($orders) {
  for ($i=0; $i<count($orders);$i++) {
        $size = get_orders_size($orders[$i]['size_id']);
        $orders[$i]['size_name'] = $size; // add toppings to order
  }
    return $orders;
}
function add_toppings_to_orders($orders) {
      for ($i=0; $i<count($orders);$i++) {
        $toppings = get_orders_toppings($orders[$i]['id']);
        $orders[$i]['toppings'] = $toppings; // add toppings to order
    }
    return $orders;
}
function add_meats_to_orders($orders) {
      for ($i=0; $i<count($orders);$i++) {
        $meats = get_orders_meats($orders[$i]['id']);
        $orders[$i]['meats'] = $meats; // add toppings to order
    }
    return $orders;
}
function add_sauces_to_orders($orders) {
      for ($i=0; $i<count($orders);$i++) {
        $sauces = get_orders_sauces($orders[$i]['id']);
        $orders[$i]['sauces'] = $sauces; // add toppings to order
    }
    return $orders;
}
// helper to above function
function get_orders_bread($bread_id) {
    global $db;
    $query = 'select B.bread_name from bread_type B where B.id =:bread_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':bread_id',$bread_id);
    $statement->execute();
    $bread = $statement->fetchAll();
    $statement->closeCursor();
    return $bread;
}
function get_orders_size($size_id) {
    global $db;
    $query = 'select S.size_name from sandwich_size S where S.id=:size_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':size_id',$size_id);
    $statement->execute();
    $size = $statement->fetchAll();
    $statement->closeCursor();
    return $size;
}
function get_orders_toppings($order_id) {
    global $db;
    $query = 'select T.topping_name from toppings T,order_topping OT where OT.topping_id=T.id and OT.order_id=:order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id',$order_id);
    $statement->execute();
    $toppings = $statement->fetchAll();
    $statement->closeCursor();
    return $toppings;
}
function get_orders_meats($order_id) {
    global $db;
    $query = 'select M.meat_name from meats M,order_meat OM where OM.meat_id=M.id and OM.order_id=:order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id',$order_id);
    $statement->execute();
    $meats = $statement->fetchAll();
    $statement->closeCursor();
    return $meats;
}
function get_orders_sauces($order_id) {
    global $db;
    $query = 'select S.sauce_name from sauces S,order_sauce OS where OS.sauce_id=S.id and OS.order_id=:order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id',$order_id);
    $statement->execute();
    $sauces = $statement->fetchAll();
    $statement->closeCursor();
    return $sauces;
}
function change_to_ready($id) {
    global $db;
    $query = 'UPDATE sandwich_orders SET status=2 WHERE status=1 and id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $statement->closeCursor();
}

function get_oldest_preparing_id() {
    global $db;
    $query = 'SELECT min(id) id FROM sandwich_orders where status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    $id = $statement->fetch()['id'];
    $statement->closeCursor();
    return $id;
}

function get_todays_orders($day) {
    global $db;
    $query = 'SELECT * FROM sandwich_orders where day=:day';
    $statement = $db->prepare($query);
    $statement->bindValue(':day',$day);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function get_current_day() {
    global $db;
    $query = 'SELECT * FROM sandwich_sys_tab';
    $statement = $db->prepare($query);
    $statement->execute();
    $currentday = $statement->fetch();
    $statement->closeCursor();
    $current_day = $currentday['current_day'];
    return $current_day;
}

function update_next_day($next_day){
    global $db;
    $query = 'UPDATE sandwich_sys_tab SET current_day=:next_day';
    $statement = $db->prepare($query);
    $statement->bindValue(':next_day', $next_day);
    $statement->execute();
    $statement->closeCursor();
}

function change_to_finished($current_day) {
    global $db;
    $query = 'UPDATE sandwich_orders SET status=3 WHERE day=:current_day';
    $statement = $db->prepare($query);
    $statement->bindValue(':current_day',$current_day);
    $statement->execute();
    $statement->closeCursor();
}

function update_to_finished($customer) {
    global $db;
    $query = 'UPDATE sandwich_orders SET status=3 WHERE status = 2 and customer_id = :customer';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer',$customer);
    $statement->execute();
    $statement->closeCursor();
}

function get_order_id() {
    global $db;
    $query = 'SELECT * FROM sandwich_sys_tab';
    $statement = $db->prepare($query);
    $statement->execute();
    $toppingid = $statement->fetch();
    $statement->closeCursor();
    $next_order_id = $toppingid['next_order_id'];
    return $next_order_id;
}

function add_order($customer, $size_id, $bread_id, $current_day, $status, $sauces, $meats, $toppings) {
    global $db;
    $query = 'INSERT INTO sandwich_orders(customer_id, bread_id, size_id, day, status)
    VALUES (:customer_id,:bread_id, :size_id, :current_day, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id',$customer);
    $statement->bindValue(':bread_id',$bread_id);
    $statement->bindValue(':size_id',$size_id);
    $statement->bindValue(':current_day',$current_day);
    $statement->bindValue(':status',$status);
    $statement->execute();
    $statement->closeCursor();
    foreach ($sauces as $s) {
        add_order_sauce($s);
    }
    foreach ($meats as $m) {
        add_order_meat($m);
    }
    foreach ($toppings as $t) {
        add_order_topping($t);
    }
}
function add_order_sauce($sauce_id) {
    global $db;
    $query = 'INSERT INTO order_sauce(order_id, sauce_id) VALUES (last_insert_id(),:sauce_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':sauce_id', $sauce_id);
    $statement->execute();
    $statement->closeCursor();
}
// helper to add_order: uses last_insert_id() to pick up auto_increment value
function add_order_topping($topping_id) {
    global $db;
    $query = 'INSERT INTO order_topping(order_id, topping_id) VALUES (last_insert_id(),:topping_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping_id', $topping_id);
    $statement->execute();
    $statement->closeCursor();
}
function add_order_meat($meat_id) {
    global $db;
    $query = 'INSERT INTO order_meat(order_id, meat_id) VALUES (last_insert_id(),:meat_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':meat_id', $meat_id);
    $statement->execute();
    $statement->closeCursor();
}
