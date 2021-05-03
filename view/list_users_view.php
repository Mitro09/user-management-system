
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

            
            <tr>
                <td>10</td>
                <td>Roberto</td>
                <td>Rossi</td>
                <td>
                    <a href="#" class="btn btn-secondary">edit</a>
                    <a href="delete_user.php?user_id=10" class="btn btn-danger">delete</a>
                </td>
            </tr>
        </table>
        
    </div>

</body>
</html>