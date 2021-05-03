
<?php include __DIR__."/head.php"?>
<?php include __DIR__."/header.php"?>

    <div class="container">

        <table class="table">
            <tr>
                <th>ID</th>
                <th>nome</th>
                <th>cognome</th>
                <th>action</th>
            </tr>

            <?php foreach($users as $user){ ?>
                <tr>
                    <td><?= $user->getUserId() ?></td>
                    <td><?= $user->getFirstName() ?></td>
                    <td><?= $user->getLastName() ?></td>
                    <td>
                        <a href="edit_user.php?user_id=<?=$user->getUserId()?>" class="btn btn-secondary">edit </a>
                        <a href="delete_user.php?user_id=<?= $user->getUserId() ?>" class="btn btn-danger">delete </a>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <a href="./add_user_form.php" class="btn btn-secondary">Back </a>
    </div>

</body>
</html>