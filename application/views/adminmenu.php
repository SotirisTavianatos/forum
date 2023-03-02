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
          <ul class="nav navbar-nav"><!--simple menu with links -->
            <li><a href="<?php echo base_url() ?>users_controller/adminupdate">my profile</a></li>
            <li><a href="<?php echo base_url() ?>users_controller/customers">customers</a></li>
            <li><a href="<?php echo base_url() ?>message_controller/allmessagehistory">all message history</a></li>
            <li><a href="<?php echo base_url() ?>users_controller/logout/admin">logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    </body>
</html>
