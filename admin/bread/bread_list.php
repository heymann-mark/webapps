<?php include '../../view/header.php'; ?>
<main>
    <section>
    <h1>Bread List</h1>
         <!-- display a list of toppings -->
        <ul>
        <?php foreach ($breads as $bread) : ?>
            <li>
            <?php echo $bread['bread_name']; ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <p>
        <a href=".?action=show_add_form">Add Bread</a>
    </p>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
