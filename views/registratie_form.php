<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Formulier</title>
    <link rel="stylesheet" href="../assets/css/registratie_form.css">
</head>

<body>
    <form method="post" action="#">
        <h3>SHOESHOE</h3>
        <fieldset>
            <legend>Accountgegevens</legend>
            <div>
                <label for="firstname">Firstname <span>*</span></label>
                <input type="text" name="firstname" id="firstname" required="required" />
            </div>
            <div>
                <label for="lastname">Lastname <span>*</span></label>
                <input type="text" name="firstname" id="firstname" required="required" />
            </div>
            <div>
                <label for="email">E-mail <span>*</span></label>
                <input type="email" name="email" id="email" required="required" placeholder="name@example.com" />
            </div>

        </fieldset>
        <fieldset>
            <legend>Address</legend>
            <div>
                <label for="street">Street<span> *</span></label>
                <input type="text" name="street" id="street" required="required" />
            </div>
            <div>
                <label for="hn">House number<span> *</span></label>
                <input type="text" name="hn" id="hn1" required="required" />
            </div>
            <div>
                <label for="hna">House number addon <span>*</span></label>
                <input type="text" name="hna" id="hna" required="required" />
            </div>
            <div>
                <label for="zipcode">Zipcode <span>*</span></label>
                <input type="text" name="zipcode" id="zipcode" required="required" />
            </div>
            <div>
                <label for="city">City<span> *</span></label>
                <input type="text" name="city" id="city1" required="required" />
            </div>
        </fieldset>
        <fieldset>
            <legend>Payment </legend>

            <div>
                <label for="ideal">IDEAL</label>
                <input type="radio" name="sex" value="ideal" id="ideal"><br>
                <label for="paypal">Paypal</label>
                <input type="radio" name="sex" value="paypal" id="paypal"> <br>
            </div>
            <div class="select">
        </fieldset>
        <a class="order_shop" href="../views/shopping_cart.php">Shopping card</a>

        <fieldset>
            <div>

                <input type="submit" value="Verzenden" name="submit">

            </div>
        </fieldset>
    </form>
</body>

</html>