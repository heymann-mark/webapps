<?php include '../../view/header.php'; ?>
<main>
    <section>
    <h1>Meat List</h1>
        <ul>
        <?php foreach ($meats as $meat) : ?>
            <li>
            <?php echo $meat['meat_name']; ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <p>
        <a href=".?action=show_add_form">Add Meat</a>
    </p>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
