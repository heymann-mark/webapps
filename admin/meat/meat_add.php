<?php include '../../view/header.php'; ?>
<main>
    <section>
    <h1>Add Meat</h1>
    <form action="index.php" method="post" id="add_meat_form">
        <input type="hidden" name="action" value="add_meat">

        <label>Meat Name:</label>
        <input type="text" name="meat_name" />
        <br>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add" />
        <br>
        <br>
    </form>
    <p>
        <a href="index.php?action=list_meats">View Meat List</a>
    </p>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
