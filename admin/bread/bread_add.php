<?php include '../../view/header.php'; ?>
<main>
    <section>
    <h1>Add Bread</h1>
    <form action="index.php" method="post" id="add_bread_form">
        <input type="hidden" name="action" value="add_bread">

        <label>Bread Name:</label>
        <input type="text" name="bread_name" />
        <br>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add" />
        <br>
        <br>
    </form>
    <p>
        <a href="index.php?action=list_breads">View Bread List</a>
    </p>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
