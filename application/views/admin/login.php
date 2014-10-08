<!-- Main wrapper -->
<div>
    <div class="login">
        <a href="#" title="" class="login-logo"><img src="logoc4ca.png?1" width="75%" alt=""/></a><br />
        <br />
        <!-- Login block -->
        <div class="well">
            <div class="navbar">
                <div class="navbar-inner">
                    <h6><i class="font-user"></i>Admin Login</h6>
                </div>
            </div>
            <form action="" method="POST" class="row-fluid">
		        <input type="hidden" name="operation" value="set" />
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls"><input class="span12" type="text" name="username" placeholder="username" autofocus /></div>
                    <?php echo form_error('username'); ?>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Password:</label>
                    <div class="controls"><input class="span12" type="password" name="password" placeholder="password" /></div>
                    <?php echo form_error('password'); ?>
                </div>
                <div class="login-btn"><input type="submit" value="Login" name="login" class="btn btn-info btn-block btn-large" /></div>
            </form>
<?php
if(isset($message) and  $message!=''){
	echo '<span style="font-size:12px">'.$message.'</span>';
}
else if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
    echo '<span style="font-size:16px;color:#F00;margin:12px">'.$msg.'</span>';
}
else if(isset($error) and  $error!=''){
    echo '<span style="font-size:16px;color:#F00;margin:12px">'.$error.'</span>';
}

?> 
        </div>
        <!-- /login block -->

    </div>

</div>
<!-- /main wrapper -->

</body>
</html>         