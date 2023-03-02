<html>
<head>
        <title>forum</title>
</head>
<body>
        <table>
        <?php
            foreach($messages as $message) {?>
            <tr> 
                <td> <button onclick="myFunction(<?php echo $message->id;?>)"> <?php 
                    //button with title and date on top 
                    echo $message->title; 
                    echo " ";
                    echo $message->created_at; ?>
                </td>  </button>
            </tr>
            <tr style="display:none" id=<?php echo $message->id;?>>
                <td> <?php 
                    //info that shows when buttons is clicked
                    echo "User";
                    echo "<br>";
                    echo "firstname:$message->firstname";
                    echo "<br>";
                    echo "lastname:$message->lastname"; 
                    echo "<br>";
                    echo "email:$message->email";?>
                </td> 
                <td> <?php 
                    echo "message";
                    echo "<br>";
                    echo $message->message; }?>
                </td> 
            </tr>
        </table>

<script>
  function myFunction(id){
    let e = document.getElementById(id);
    //hide or show when button is clicked
    if(e.style.display != 'none')
           e.style.display = 'none';
       else
           e.style.display = 'block';
    }
</script>
</body>
</html>