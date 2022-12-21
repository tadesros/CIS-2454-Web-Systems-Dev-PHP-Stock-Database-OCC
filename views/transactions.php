<!DOCTYPE html>
<!--The model for creating classes,functions and use is based on the example demonstrated by Professor Eric Charnesky's 
  lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Transaction List</title>


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
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Stock ID</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Timestamp</th>
            </tr>
            <?php foreach ($transactions as $transaction) : ?>         
                <tr>
                    <td><?php echo $transaction->get_id(); ?></td> 
                    <td><?php echo $transaction->get_user_id(); ?></td>
                    <td><?php echo $transaction->get_stock_id(); ?></td>
                    <td><?php echo $transaction->get_quantity(); ?></td>
                    <td><?php echo $transaction->get_price(); ?></td>
                    <td><?php echo $transaction->get_time_stamp(); ?></td>                                  
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add Transaction</h2>
        <br>
        <!--ADD-->   
        <form action="transactions.php" method = "post">

            <label>User ID:</label>
            <input type="text" name="user_id"/><br>

            <label>Stock ID:</label>
            <input type="text" name="stock_id"/><br>

            <label>Quantity:</label>
            <input type="text" name="quantity"/><br> 

            <input type="hidden" name='action' value='insert'/>         

            <label>&nbsp;</label>
            <input type="submit" value="Add Transaction"/><br>  
        </form>

        </br>
        <h2>Update Transaction</h2>
        </br>

        <!--Update Transaction-->   
        <form action="transactions.php" method = "post">  
            <label>Transaction ID:</label>
            <input type="text" name="id"/><br>

            <label>User ID:</label>
            <input type="text" name="user_id"/><br>

            <label>Stock ID:</label>
            <input type="text" name="stock_id"/><br>

            <label>Quantity:</label>
            <input type="text" name="quantity"/><br> 

            <label>Price:</label>
            <input type="text" name="price"/><br>   

            <input type="hidden" name='action' value='update'/>         

            <label>&nbsp;</label>
            <input type="submit" value="Update Transaction"/><br>           

        </form>   

        <!--Delete-->
        <h2>Delete Transactions</h2>        
        <br>             
        <form action="transactions.php" method = "post">            

            <label>ID::</label>
            <input type="text" name="id"/><br>

            <input type="hidden" name='action' value='delete'/>            
            <label>&nbsp;</label>
            <input type="submit" value="Delete Transaction"/><br>              
        </form>  
    </body>    
    </br>
    <?php include ('footer.php'); ?>
</html>



