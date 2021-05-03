<?php include '../../view/header.php'; ?>
<main>
    <section>
    <h1>Topping List</h1>
        <ul>
        <?php foreach ($toppings as $topping) : ?>
            <li>
            <?php echo $topping['topping_name']; ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <p>
        <a href=".?action=show_add_form">Add Topping</a>
    </p>
    </section>
</main>
<?php include '../../view/footer.php'; ?>
