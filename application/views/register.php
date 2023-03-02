<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>forum</title>
    <style>
        .text-danger p{
            color:red;
            margin-top:0;
        }
    </style>
    </head>
    <body>
        <div class="form">
            <!--from to fill for registration-->
            <h1 style="font-size:22px;">Registration form</h1>
            <form method="post" action="<?php echo base_url() ?>users_controller/validate/-1">
                <div class="form-group">
                    <div><input type="text" class="form-control" name="name" placeholder="Name"></div>
                    <span class="text-danger"><?php echo form_error("name");?></span>
                </div>

                <div class="form-group">
                    <div><input type="text" class="form-control" name="lastname" placeholder="Lastname"></div>
                    <span class="text-danger"><?php echo form_error("lastname");?></span>
                </div>

                <div class="form-group">
                    <div><input type="text" class="form-control" name="email" placeholder="email"></div>
                    <span class="text-danger"><?php echo form_error("email");?></span>
                </div>

                <div class="form-group">
                    <div><input type="password" class="form-control" name="password" placeholder="password"></div>
                    <span class="text-danger"><?php echo form_error("password");?></span>
                </div>

                <div class="form-group">
                    <div><input type="password" class="form-control" name="confirm_password" placeholder="confirm password"></div>
                    <span class="text-danger"><?php echo form_error("confirm_password");?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Register" name="insert">
                </div>

        </div>
    </body>
</html>