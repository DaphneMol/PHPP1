<?php
require_once '../../../controllers/checkAdmin.php';
require_once '../../../controllers/connect.php';
require_once '../../../controllers/session.php';

$qry = $conn->query("SELECT * FROM user");

$users = [];

while ($row = $qry->fetch_assoc()) {
    array_push($users, $row);
}

if (isset($_GET['update'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare('UPDATE user SET firstName = ?, middleName = ?, lastName = ?, birthDate = ?, `e-mailadres` = ?, password = ? WHERE id = ?');
        $qry->bind_param('ssssssi', $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['birthDate'], $_POST['e-mail'], $hashedPassword, $_GET['update']);


        if ($qry->execute()) {
            echo ("<script>alert('User gewijzigd')</script>");
            header("Refresh:0; url=user_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

if (isset($_GET['delete'])) {

    $sql = 'DELETE FROM user WHERE id = ' . $_GET['delete'];
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo ("<script>alert('User has been deleted')</script>");
        header("Refresh:0; url=user_overzicht.php");
    } else {
        echo ("<script>alert('User doesn't exist or has already been deleted')</script>");
    }
}

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare("INSERT INTO user (firstName, middleName, lastName, birthDate, `e-mailadres`, password) VALUES (?,?,?,?,?,?)");
        $qry->bind_param('ssssss', $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['birthDate'], $_POST['e-mail'], $hashedPassword);
        if ($qry->execute()) {
            echo ("<script>alert('User toegevoegd')</script>");
            header("Refresh:0; url=user_overzicht.php");
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
    <title>Overzicht</title>
    <link rel="stylesheet" href="../../../assets/css/overzicht.css">
</head>

<body>
    <h1>Overzicht Gebruikers</h1>
    <table>
        <tr>
            <th>firstName</th>
            <th>middleName</th>
            <th>lastName</th>
            <th>birthDate</th>
            <th>e-mailadress</th>
            <th>password</th>
        </tr>
        <?php foreach ($users as $user) {

            if (isset($_GET['update']) && $user['id'] == $_GET['update']) { ?>
                <tr>
                    <form method="post" action="">
                        <td><input type="text" name="firstName" id="firstName" value="<?= $user['firstName'] ?>"></td>
                        <td><input type="text" name="middleName" id="middleName" value="<?= $user['middleName'] ?>"></td>
                        <td><input type="text" name="lastName" id="lastName" value="<?= $user['lastName'] ?>"></td>
                        <td><input type="date" name="birthDate" id="birthDate" value="<?= $user['birthDate'] ?>"></td>
                        <td><input type="email" name="e-mail" id="e-mail" value="<?= $user['e-mailadres'] ?>"></td>
                        <td><input type="password" name="password" id="password" value="" placeholder="******"></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <td><a class='blue' href='?delete=<?= $user['id'] ?>'>Delete</a></td>
                    </form>
                </tr>
            <?php } else { ?>

                <tr>
                    <td><?= $user['firstName'] ?></td>
                    <td><?= $user['middleName'] ?></td>
                    <td><?= $user['lastName'] ?></td>
                    <td><?= $user['birthDate'] ?></td>
                    <td><?= $user['e-mailadres'] ?></td>
                    <td>**********</td>
                    <td><a class='blue' href='?update=<?= $user['id'] ?>'>Update</a></td>
                    <td><a class='blue' href='?delete=<?= $user['id'] ?>'>Delete</a></td>
                </tr>
            <?php }
        }
        if (isset($_GET['add'])) { ?>
            <tr>
                <form method="post" action="">
                    <td><input type="text" name="firstName" id="firstName" value=""></td>
                    <td><input type="text" name="middleName" id="middleName" value=""></td>
                    <td><input type="text" name="lastName" id="lastName" value=""></td>
                    <td><input type="date" name="birthDate" id="birthDate" value=""></td>
                    <td><input type="email" name="e-mail" id="e-mail" value=""></td>
                    <td><input type="password" name="password" id="password" value=""></td>
                    <td><input type="submit" value="submit" name="submit"></td>
                    <td><a class='blue' href='user_overzicht.php'>Cancel</a></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <div class="addbutton"><a href="?add=1"><button>Add User</button></a></div>
    <div class="back"><a href="../../index.php"><button>Home</button></a></div>

</body>

</html>