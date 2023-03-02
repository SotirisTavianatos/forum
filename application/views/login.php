<html>
<head>
        <title>forum</title>
</head>
<body>
        <div class="form">
            <!--login form with an if to send action to correct controller-->
            <h1 style="font-size:22px;">Log in to your account</h1>
            <?php if($user_type == "customer"){?>
            <h2>customer <a style="text-decoration:none;color:black" href="<?php echo base_url() ?>users_controller/login/admin">admin</a></h2>
            <?php }
            else{?>
            <h2>admin <a style="text-decoration:none;color:black" href="<?php echo base_url() ?>users_controller/login/customer">customer</a></h2>
            <?php }?>
            <?php if($user_type == "customer"){?>
                <form method="post" action="<?php echo base_url() ?>users_controller/checklogin/customer">
            <?php }
            else{?>
                <form method="post" action="<?php echo base_url() ?>users_controller/checklogin/admin">
            <?php }?>
                <div class="form-group">
                    <div><input type="text" class="form-control" name="email" placeholder="email"></div>
                    <span class="text-danger"><?php echo form_error("email");?></span>
                </div>

                <div class="form-group">
                    <div><input type="password" class="form-control" name="password" placeholder="password"></div>
                    <span class="text-danger"><?php echo form_error("password");?></span>
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Ok" name="insert">
                </div>
                <?php echo $this->session->flashdata('login_error'); ?>
        </div>
        <?php if($user_type == "customer"){?>
        <a style="text-decoration:none;color:black" href="<?php echo base_url() ?>users_controller/register">NEW ACCOUNT</a>
        <?php }?>
    </body>
</html>
</body>
</html>