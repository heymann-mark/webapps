<?php include '../view/header.php'; ?>

<main>
    <h1>Welcome to the Sandwich Shop</h1>
    <section>
    <form  action="index.php" method="get" id="form_order_sandwich">
        <input type="hidden" name="action" value="add_order">
        <label>Sandwich Size:</label><br>
        <?php foreach ($sizes as $size) : ?>
            <input type="radio" name="sandwich_size"  value="<?php echo $size['id']; ?>" required="required">
            <label><?php echo $size['size_name']; ?> </label>
            <br>
        <?php endforeach; ?><br>

        <label>Bread Type:</label><br>
        <?php foreach ($breads as $bread) : ?>
            <input type="radio" name="bread_type"  value="<?php echo $bread['id']; ?>" required="required">
            <label><?php echo $bread['bread_name']; ?> </label>
            <br>
        <?php endforeach; ?><br>

        <label>Toppings:</label><br>
        <?php foreach ($toppings as $topping) : ?>
            <input type="checkbox" name="sandwich_topping[]"  value="<?php echo $topping['id']; ?>" >
            <label><?php echo $topping['topping_name']; ?> </label><br>
        <?php endforeach;  ?> <br>

        <label>Meats:</label><br>
        <?php foreach ($meats as $meat) : ?>
            <input type="checkbox" name="meat_type[]"  value="<?php echo $meat['id']; ?>" >
            <label><?php echo $meat['meat_name']; ?> </label><br>
        <?php endforeach;  ?> <br>

        <label>Sauces:</label><br>
        <?php foreach ($sauces as $sauce) : ?>
            <input type="checkbox" name="sauce_type[]"  value="<?php echo $sauce['id']; ?>" >
            <label><?php echo $sauce['sauce_name']; ?> </label><br>
        <?php endforeach;  ?> <br>

        <label for="customer">Customer No:</label>
        <select name="customer" required="required">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option <?php if ($customer == $i) { echo 'selected = "selected"';}?>
                    value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
            <?php endfor; ?>
        </select><br><br>

        <label>Quantity:</label> <input type='number' name="n" min="1" max="1000"><br><br>

        <input type="submit" value="Order Sandwich" /> <br><br>

    </form>
    </section>
</main>
<?php include '../view/footer.php'; ?>
