<?php
require_once '../../../controllers/checkAdmin.php';
require_once '../../../controllers/connect.php';
require_once '../../../controllers/session.php';

$qry = $conn->query("SELECT * FROM customer");

$customers = [];

while ($row = $qry->fetch_assoc()) {
    array_push($customers, $row);
}

if (isset($_GET['update'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare('UPDATE customer SET gender = ?, firstName = ?, middleName = ?, lastName = ?, street = ?, houseNumber = ?, houseNumber_addon = ?, zipCode = ?, city = ?, phone = ?, `e-mailadres` = ?, password = ?, newsletter_subscription = ? WHERE id = ?');
        $qry->bind_param('sssssisssissii', $_POST['gender'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['street'], $_POST['houseNumber'], $_POST['houseNumber_addon'], $_POST['zipCode'], $_POST['city'], $_POST['phone'], $_POST['e-mail'], $hashedPassword, $_POST['newsletter_subscription'], $_GET['id']);


        if ($qry->execute()) {
            echo ("<script>alert('Customer gewijzigd')</script>");
            header("Refresh:0; url=customer_overzicht.php");
        } else {
            echo "Error: " . $qry->error;
        }
    }
}

if (isset($_GET['delete'])) {

    $sql = 'DELETE FROM customer WHERE id = ' . $_GET['delete'];
    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        echo ("<script>alert('Customer has been deleted')</script>");
        header("Refresh:0; url=customer_overzicht.php");
    } else {
        echo ("<script>alert('Customer doesn't exist or has already been deleted')</script>");
    }
}

if (isset($_GET['add'])) {
    if (isset($_POST['submit'])) {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare("INSERT INTO customer (gender, firstName, middleName, lastName, street, houseNumber, houseNumber_addon, zipCode, city, phone, `e-mailadres`, password, newsletter_subscription) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $qry->bind_param('sssssisssissi', $_POST['gender'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['street'], $_POST['houseNumber'], $_POST['houseNumber_addon'], $_POST['zipCode'], $_POST['city'], $_POST['phone'], $_POST['e-mail'], $hashedPassword, $_POST['newsletter_subscription']);
        if ($qry->execute()) {
            echo ("<script>alert('Customer account toegevoegd')</script>");
            header("Refresh:0; url=customer_overzicht.php");
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
    <h1>Overzicht Customers</h1>
    <table>
        <tr>
            <th>Gender</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Street</th>
            <th>House Number</th>
            <th>Addon</th>
            <th>Zip Code</th>
            <th>City</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th>Password</th>
            <th>Newsletter</th>
        </tr>
        <?php foreach ($customers as $customer) {

            if (isset($_GET['update']) && $customer['id'] == $_GET['update']) { ?>
                <tr>
                    <form method="post" action="">
                        <td><select name="gender" id="gender">
                                <option value="Man">Man</option>
                                <option value="Vrouw">Vrouw</option>
                                <option value="Anders">Anders</option>
                            </select></td>
                        <td><input type="text" name="firstName" id="firstName" value="<?= $customer['firstName'] ?>"></td>
                        <td><input type="text" name="middleName" id="middleName" value="<?= $customer['middleName'] ?>"></td>
                        <td><input type="text" name="lastName" id="lastName" value="<?= $customer['lastName'] ?>"></td>
                        <td><input type="text" name="street" id="street" value="<?= $customer['street'] ?>"></td>
                        <td><input type="number" name="houseNumber" id="houseNumber" value="<?= $customer['houseNumber'] ?>"></td>
                        <td><input type="text" name="houseNumber_addon" id="houseNumber_addon" value="<?= $customer['houseNumber_addon'] ?>"></td>
                        <td><input type="text" name="zipCode" id="zipCode" value="<?= $customer['zipCode'] ?>"></td>
                        <td><input type="text" name="city" id="city" value="<?= $customer['city'] ?>"></td>
                        <td><input type="text" name="phone" id="phone" value="<?= $customer['phone'] ?>"></td>
                        <td><input type="email" name="e-mail" id="e-mail" value="<?= $customer['e-mailadres'] ?>"></td>
                        <td><input type="password" name="password" id="password" value="" placeholder="*********"></td>
                        <td><select name="newsletter_subscription" id="newsletter_subscription">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                        <td><a class='blue' href='?delete=<?= $customer['id'] ?>'>Delete</a></td>
                    </form>
                </tr>
            <?php } else { ?>

                <tr>
                    <td><?= $customer['gender'] ?></td>
                    <td><?= $customer['firstName'] ?></td>
                    <td><?= $customer['middleName'] ?></td>
                    <td><?= $customer['lastName'] ?></td>
                    <td><?= $customer['street'] ?></td>
                    <td><?= $customer['houseNumber'] ?></td>
                    <td><?= $customer['houseNumber_addon'] ?></td>
                    <td><?= $customer['zipCode'] ?></td>
                    <td><?= $customer['city'] ?></td>
                    <td><?= $customer['phone'] ?></td>
                    <td><?= $customer['e-mailadres'] ?></td>
                    <td>*********</td>
                    <td><?php if ($customer['newsletter_subscription'] == 1) echo "yes";
                        else echo "no"; ?></td>
                    <td><a class='blue' href='?update=<?= $customer['id'] ?>'>Update</a></td>
                    <td><a class='blue' href='?delete=<?= $customer['id'] ?>'>Delete</a></td>
                </tr>
            <?php }
        }
        if (isset($_GET['add'])) { ?>
            <tr>
                <form method="post" action="">
                    <td><select name="gender" id="gender">
                            <option value="Man">Man</option>
                            <option value="Vrouw">Vrouw</option>
                            <option value="Anders">Anders</option>
                        </select></td>
                    <td><input type="text" name="firstName" id="firstName" value=""></td>
                    <td><input type="text" name="middleName" id="middleName" value=""></td>
                    <td><input type="text" name="lastName" id="lastName" value=""></td>
                    <td><input type="text" name="street" id="street" value=""></td>
                    <td><input type="number" name="houseNumber" id="houseNumber" value=""></td>
                    <td><input type="text" name="houseNumber_addon" id="houseNumber_addon" value=""></td>
                    <td><input type="text" name="zipCode" id="zipCode" value=""></td>
                    <td><input type="text" name="city" id="city" value=""></td>
                    <td><input type="text" name="phone" id="phone" value=""></td>
                    <td><input type="email" name="e-mail" id="e-mail" value=""></td>
                    <td><input type="password" name="password" id="password" value="" placeholder="*********"></td>
                    <td><select name="newsletter_subscription" id="newsletter_subscription">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select></td>
                    <td><input type="submit" value="submit" name="submit"></td>
                    <td><a class='blue' href='customer_overzicht.php'>Cancel</a></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <div class="addbutton"><a href="?add=1"><button>Add Customer</button></a></div>
    <div class="back"><a href="../../index.php"><button>Home</button></a></div>

</body>

</html>