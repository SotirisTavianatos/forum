<html>
<head>
        <title>forum</title>
</head>
<body>
        <table>
        <?php
            foreach($customers as $customer) {?>
            <tr> 
                <td> <button onclick="myFunction(<?php echo $customer->id;?>)"> <?php //button with customer name and last interactive date on it 
                    echo "customer: $customer->lastname"; 
                    echo " ";
                    echo "last interactive: $customer->last_interactive"; ?>
                </td>  </button>
            </tr>
            <tr style="display:none" id=<?php echo $customer->id;?>>
                <td> <?php //the info that shows if the button is clicked
                    echo "firstname:$customer->firstname";
                    echo "<br>";
                    echo "lastname:$customer->lastname"; 
                    echo "<br>";
                    echo "email:$customer->email";?>
                </td> 
                <td> <!--some links for the admin actions-->
                    <li><a href="<?php echo base_url() ?>users_controller/deleteuser/<?php echo $customer->id;?>" onclick="return confirm('Are you sure you want to delete this user?')">delete user</a></li>
                    <li><a href="<?php echo base_url() ?>users_controller/edituser/<?php echo $customer->id;?>">edit user</a></li>
                    <li><a href="<?php echo base_url() ?>message_controller/messagehistory/<?php echo $customer->id;?>">show users messages</a></li> 
                </td> 
            </tr>
            <?php }?>
        </table>

<script>
  function myFunction(id){
    let e = document.getElementById(id);
    //hide and show when the button is clicked
    if(e.style.display != 'none')
           e.style.display = 'none';
       else
           e.style.display = 'block';
    }
</script>
</body>
</html>