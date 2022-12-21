<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Users List</title>

        <style type="text/css" media="screen">
            label {
                display: inline-block;
                width: 110px;
                color: #777777;
            }
            input {
                padding: 5px 10px;
            }
        </style>



    </head>
    <?php include ('topNavigation.php'); ?>
    </br>
    <body>   
        <h2>Login</h2>

        <?php echo $message ?>

        <!--Insert-->   
        <form action="login.php" method = "post">

            <label>Email-Address:</label>
            <input type="text" name="email_address"/><br>

            <label>Password:</label>
            <input type="password" name="password"/><br> 

            <label>&nbsp;</label>
            <input type="submit" value="Login"/><br>           

        </form>  

    </body>
    <?php include ('footer.php'); ?>
</html><!-- comment -->