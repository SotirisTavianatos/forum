<html>
<head>
        <title>forum</title>
</head>
<body><!--form to fill for new message-->
       <form method="post" action="<?php echo base_url() ?>Message_controller/messageToDb">
       <p><label for="title">Write the title of your message:</label></p>
       <div><input type="text" name="title" placeholder="my title"></div>
        <p><label for="message">Write your message:</label></p>
        <textarea id="message" name="message" placeholder="my message" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" value="Post">
        </form>
</body>
</html>