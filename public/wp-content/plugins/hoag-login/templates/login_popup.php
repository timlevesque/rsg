
<div class="login-form-container py-3">
<p><?php _e( 'If you haven\'t created an account yet,', 'personalize-login' ); ?> <a class="" href="/register"><?php _e( 'Register here', 'personalize-login' ); ?></a>.</p>
    <form method="post" action="<?php echo wp_login_url(); ?>">
        <div class="form-group">
            <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
            <input class="form-control" type="text" name="log" id="user_login">
        </div>
        <div class="form-group">
            <label for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
            <input class="form-control" type="password" name="pwd" id="user_pass">
            <a class="small forgot-password" href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Forgot your password?', 'personalize-login' ); ?></a>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
        </div>
    </form>
</div>