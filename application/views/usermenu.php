<!DOCTYPE html>
<html>
	<head>
		<title>forum</title>
	</head>
	<body>
	<nav class="navbar">
      <div class="container">
        <div class="navbar-header">
         <h1>Forum</h1>
         <h2>hello <?php echo $this->session->userdata('firstname');?></h2>
        </div>
        <div id="navbar">
          <ul class="nav navbar-nav">
            <!--links with the possible actions for user-->
            <li><a href="<?php echo base_url() ?>users_controller/userupdate">my profile</a></li>
            <li><a href="<?php echo base_url() ?>users_controller/newmessage">new message</a></li>
            <li><a href="<?php echo base_url() ?>message_controller/messagehistory/<?php echo $this->session->userdata('id');?>">message history</a></li>
            <li><a href="<?php echo base_url() ?>message_controller/allmessages">all messages</a></li>
            <li><a href="<?php echo base_url() ?>users_controller/logout/user">logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    </body>
</html>
