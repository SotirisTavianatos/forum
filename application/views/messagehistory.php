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
                //message button with title and date on top
                    echo $message->title; 
                    echo " ";
                    echo $message->created_at; ?>
                </td>  </button>
            </tr>
            <tr style="display:none" id=<?php echo $message->id;?>>
                <td> <?php 
                    //the message content thats hidden
                    echo $message->message; }?>
                </td> 
            </tr>
        </table>

<script>
  function myFunction(id){
    let e = document.getElementById(id);
    //change to hidden if showing or change to show if hiiden
    if(e.style.display != 'none')
           e.style.display = 'none';
       else
           e.style.display = 'block';
  }
</script>
</body>
</html>