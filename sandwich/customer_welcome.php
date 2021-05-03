<?php include 'view/header.php'; ?>
<main>
    <section>
        <div>
            <h1>Available Sizes</h1>
            <table>
                <tr>
                    <th>Size</th>
                </tr>
                <?php foreach ($sizes as $size): ?>
                    <tr>
                        <td><?php echo $size['size_name']; ?> </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div>
            <h1>Available Breads</h1>
            <table>
                <tr>
                    <th>Bread</th>
                </tr>
                <?php foreach ($breads as $bread) : ?>
                    <tr>
                        <td><?php echo $bread['bread_name']; ?> </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div>
            <h1>Available meats</h1>
            <table>
                <tr>
                    <th>Meat</th>
                </tr>
                <?php foreach ($meats as $meat) : ?>
                    <tr>
                        <td><?php echo $meat['meat_name']; ?> </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div>
            <h1>Available sauces</h1>
            <table>
                <tr>
                    <th>Sauce</th>
                </tr>
                <?php foreach ($sauces as $sauce) : ?>
                    <tr>
                        <td><?php echo $sauce['sauce_name']; ?> </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div>
            <h1>Available Toppings</h1>
            <table>
                <tr>
                    <th>Topping</th>
                </tr>
                <?php foreach ($toppings as $topping) : ?>
                    <tr>
                        <td><?php echo $topping['topping_name']; ?> </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <form  action="index.php" method="post" id="add_product_form">
            <input type="hidden" name="action" value="select_customer">
            <label for="customer">Customer No:</label>
            <select name="customer" required="required">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option   <?php if ($customer == $i) {
                      echo 'selected = "selected"'; } ?>
                        value="<?php echo $i; ?>" > <?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select>
            <input style="float:none;" type="submit" value="Select Room" /> <br><br>
        </form>

        <?php

        if (count($customer_preparing_orders) + count($customer_ready_orders) == 0):
            echo 'No orders in progress for this customer';
        else:
            ?>
            <h2>Orders in progress for customer <?php echo $customer ?></h2>

            <table>
                <tr>
                    <th>Order ID</th>
                    <th>customer No</th>
                    <th>Size</th>
                    <th>Bread</th>
                    <th>Meats</th>
                    <th>Toppings</th>
                    <th>Sauces</th>
                    <th>Status</th>

                </tr>
                 <?php foreach ($customer_ready_orders as $customer_order) : ?>
                 <tr>
                   <td><?php echo $customer_order['id']; ?> </td>
                   <td><?php echo $customer_order['customer_id']; ?> </td>
                   <td><?php $sizes = $customer_order['size_name'];
                       foreach ($sizes as $s)
                        echo $s['size_name']. ' ';?></td>

                   <td><?php $breads = $customer_order['bread_name'];
                            foreach ($breads as $b)
                             echo $b['bread_name']. ' ';?></td>

                   <td><?php $meats = $customer_order['meats'];
                       foreach ($meats as $m)
                        echo $m['meat_name']. ' ';?></td>

                   <td><?php $toppings = $customer_order['toppings'];
                       foreach ($toppings as $t)
                        echo $t['topping_name']. ' ';?></td>

                    <td><?php $sauces = $customer_order['sauces'];
                              foreach ($sauces as $s)
                              echo $s['sauce_name']. ' ';?></td>
                    <td><?php echo 'Ready';?> </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php foreach ($customer_preparing_orders as $customer_order) : ?>
                  <tr>
                     <td><?php echo $customer_order['id']; ?> </td>
                     <td><?php echo $customer_order['customer_id']; ?> </td>
                     <td><?php $sizes = $customer_order['size_name'];
                         foreach ($sizes as $s)
                          echo $s['size_name']. ' ';?></td>

                      <td><?php $breads = $customer_order['bread_name'];
                              foreach ($breads as $b)
                               echo $b['bread_name']. ' ';?></td>

                     <td><?php $meats = $customer_order['meats'];
                         foreach ($meats as $m)
                          echo $m['meat_name']. ' ';?></td>

                     <td><?php $toppings = $customer_order['toppings'];
                         foreach ($toppings as $t)
                          echo $t['topping_name']. ' ';?></td>

                          <td><?php $sauces = $customer_order['sauces'];
                                foreach ($sauces as $s)
                                echo $s['sauce_name']. ' ';?></td>

                     <td><?php echo 'Preparing';?> </td>
                  </tr>
                  <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <?php if (count($customer_ready_orders)> 0):  ?>
            <form action="index.php" method="get">
                <input type="hidden" name="customer"
                       value="<?php echo $customer; ?>">
                <input type="hidden" name="action"
                       value="update_order_status">
                <input type="submit" value="Acknowledge Delivery of Sandwiches">
            </form>
         <?php endif; ?>
        <p class="last_paragraph">
            <a href="?action=order_sandwich&customer=<?php echo $customer; ?>">Order Sandwich</a>
        </p>
    </section>
</main>
<?php include 'view/footer.php'; ?>
