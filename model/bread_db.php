<?php
// the try/catch for these actions is in the caller, index.php

function add_bread($bread_name)
{
    global $db;
    $query = 'INSERT INTO bread_type
                 (b_status, bread_name)
              VALUES
                 (:b_status, :bread_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':b_status', 1); // newly created topping is active
    $statement->bindValue(':bread_name', $bread_name);
    $statement->execute();
    $statement->closeCursor();
}
function get_available_breads() {
    global $db;
    $query = 'SELECT * FROM bread_type where b_status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    $bread_types = $statement->fetchAll();
    return $bread_types;
}

?>
