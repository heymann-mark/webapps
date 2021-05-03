<?php
// the try/catch for these actions is in the caller, index.php

function add_meat($meat_name)
{
    global $db;
    $query = 'INSERT INTO meats
                 (m_status, meat_name)
              VALUES
                 (:m_status, :meat_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':m_status', 1); // newly created topping is active
    $statement->bindValue(':meat_name', $meat_name);
    $statement->execute();
    $statement->closeCursor();
}
function get_available_meats() {
    global $db;
    $query = 'SELECT * FROM meats where m_status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    $meats = $statement->fetchAll();
    return $meats;
}

?>
