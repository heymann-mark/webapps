<?php
// the try/catch for these actions is in the caller, index.php

function add_sauce($sauce_name)
{
    global $db;
    $query = 'INSERT INTO sauces
                 (sau_status, sauce_name)
              VALUES
                 (:sau_status, :sauce_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':sau_status', 1); // newly created topping is active
    $statement->bindValue(':sauce_name', $sauce_name);
    $statement->execute();
    $statement->closeCursor();
}
function get_available_sauces() {
    global $db;
    $query = 'SELECT * FROM sauces where sau_status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    $sauces = $statement->fetchAll();
    return $sauces;
}

?>
