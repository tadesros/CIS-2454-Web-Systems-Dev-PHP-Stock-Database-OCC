<!DOCTYPE html>

<!--The model for creating classes,functions and use is based on the example demonstrated by Professor Eric Charnesky's 
  lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU -->

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
            
            
            table {
                text-align: left;
                position: relative;
                border-collapse: collapse;
                background-color: #f6f6f6;
            }/* Spacing */
            td, th {
                border: 1px solid #999;
                padding: 20px;
            }
            th {
                background: brown;
                color: white;
                border-radius: 0;
                position: sticky;
                top: 0;
                padding: 10px;
            }
            .primary{
                background-color: #000000
            }

            tfoot > tr  {
                background: black;
                color: white;
            }
            tbody > tr:hover {
                background-color: #ffc107;
            }
            
            
            
            
            
            
            
            
            
            
            
        </style>
    </head>

    <?php include ('topNavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr> 
                <th>ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Cash Balance</th>

            </tr>
            <?php foreach ($users as $user) : ?>         
                <tr>
                    <td><?php echo $user->get_id(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_email_address(); ?></td>
                    <td><?php echo $user->get_cash_balance(); ?></td>

                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add or Update User</h2>
        <br>
        <!--Insert-->   
        <form action="users.php" method = "post">

            <label>Name:</label>
            <input type="text" name="name"/><br>

            <label>Email-Address:</label>
            <input type="text" name="email_address"/><br>

            <label>Cash Balance:</label>
            <input type="text" name="cash_balance"/><br> 

            <input type="hidden" name='action' value='insert_or_update'/>


            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>


            <label>&nbsp;</label>
            <input type="submit" value="Submit"/><br>           

        </form>
        <!--Delete-->
        <h2>Delete User</h2>        
        <br>             
        <form action="users.php" method = "post">            
            <label>Delete User:</label>
            <label>Email-Address:</label>
            <input type="text" name="email_address"/><br>

            <input type="hidden" name='action' value='delete'/>            
            <label>&nbsp;</label>
            <input type="submit" value="Delete User"/><br>              
        </form>  
    </body>    
    </br>
    <?php include ('footer.php'); ?>
</html>

