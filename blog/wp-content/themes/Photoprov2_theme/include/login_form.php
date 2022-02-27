<div id="loginform">
    <div class="wrap">
    
		<form action="<?php bloginfo('url') ?>/wp-login.php" method="post">
			<p>
			<label for="log"> Username : <input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="22" /></label>
			<label for="pwd">Password : <input type="password" name="pwd" id="pwd" size="22" /> </label>
			<input type="submit" name="submit" value="Login" class="button2" />
			
			</p>
			
			<p class="desc"><a href="<?php bloginfo('url') ?>/wp-login.php?action=lostpassword">Lost password?</a></p>
			
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
		</form>
        
    </div>
</div>
