<?php
require_once '../../../controllers/checkAdmin.php';
require_once '../../../controllers/connect.php';
require_once '../../../controllers/session.php';

$qry = $conn->query("SELECT * FROM admin");

$admins = [];

while ($row = $qry->fetch_assoc()) {
    array_push($admins, $row);
}

if (isset($_GET['update'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare('UPDATE admin SET username = ?, password = ? WHERE id = ?');
        $qry->bind_param('ssi', $_POST['username'],  $hashedPassword, $_GET['update']);


        if ($qry->execute()) {
            echo ("<script>alert('Admin account gewijzigd')</script>");
            header("Refresh:0; url=admin_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

if (isset($_GET['delete'])) {

    $sql = 'DELETE FROM admin WHERE id = ' . $_GET['delete'];
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo ("<script>alert('Admin account has been deleted')</script>");
        header("Refresh:0; url=admin_overzicht.php");
    } else {
        echo ("<script>alert('Admin account doesn't exist or has already been deleted')</script>");
    }
}

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare("INSERT INTO admin (username, password) VALUES (?,?)");
        $qry->bind_param('ss', $_POST['username'], $hashedPassword);
        if ($qry->execute()) {
            echo ("<script>alert('Admin account toegevoegd')</script>");
            header("Refresh:0; url=admin_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Admins</title>
    <link rel="stylesheet" href="../../../assets/css/overzicht.css">
</head>

<body>
    <h1>Overzicht Admin Accounts</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php foreach ($admins as $admin) {

            if (isset($_GET['update']) && $admin['id'] == $_GET['update']) { ?>
                <tr>
                    <form method="post" action="">
                        <td><input type="email" name="username" id="username" value="<?= $admin['username'] ?>"></td>
                        <td><input type="password" name="password" id="password" value="" placeholder="******"></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <td><a class='blue' href='?delete=<?= $admin['id'] ?>'>Delete</a></td>
                    </form>
                </tr>
            <?php } else { ?>

                <tr>
                    <td><?= $admin['username'] ?></td>
                    <td>**********</td>
                    <td><a class='blue' href='?update=<?= $admin['id'] ?>'>Update</a></td>
                    <td><a class='blue' href='?delete=<?= $admin['id'] ?>'>Delete</a></td>
                </tr>
            <?php }
        }
        if (isset($_GET['add'])) { ?>
            <tr>
                <form method="post" action="">
                    <td><input type="email" name="username" id="username" value=""></td>
                    <td><input type="password" name="password" id="password" value=""></td>
                    <td><input type="submit" value="submit" name="submit"></td>
                    <td><a class='blue' href='admin_overzicht.php'>Cancel</a></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <div class="addbutton"><a href="?add=1"><button>Add Admin</button></a></div>
    <div class="back"><a href="../../index.php"><button>Home</button></a></div>

</body>

</html>