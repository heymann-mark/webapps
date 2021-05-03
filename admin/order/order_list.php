<?php include '../../view/header.php'; ?>
<main>
    <h1>Current Orders Report</h1>
    <section>
        <h2>Orders Ready but not delivered</h2>
        <?php if (count($ready_orders) > 0): ?>
            <?php foreach ($ready_orders as $ready_order) : ?>
                <?php echo " ID:" . $ready_order['id']; ?>
                <?php echo "Customer ID:" . $ready_order['customer_id']; ?><br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Ready orders</p>
        <?php endif; ?>

        <h2>Orders Preparing: Any ready now?</h2>
        <?php if (count($preparing_orders) > 0): ?>
            <?php foreach ($preparing_orders as $preparing_order) : ?>
                <?php echo "ID:" . $preparing_order['id']; ?>
                <?php echo "customer id:" . $preparing_order['customer_id']."<br>"; ?>
             <?php endforeach; ?>
        <?php else: ?>
            <p>No orders are being prepared in Oven</p>
        <?php endif; ?>
        <br>
        <form  action="index.php" method="post" >
            <input type="hidden" name="action" value="change_to_ready">
            <input type="submit" value="Mark Oldest Sandwich Ready" />
            <br>
        </form>
        <br>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
