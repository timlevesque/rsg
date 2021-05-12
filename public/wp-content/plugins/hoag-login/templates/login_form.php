<!-- Show errors if there are any -->
<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
        <div class="login-error alert alert-warning" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ( $attributes['registered'] ) : ?>
    <div class="alert alert-info login-info" role="alert">
        <?php
            printf(
                __( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'personalize-login' ),
                get_bloginfo( 'name' )
            );
        ?>
    </div>
<?php endif; ?>
<?php if ( $attributes['lost_password_sent'] ) : ?>
    <div class="alert alert-info login-info" role="alert">
        <?php _e( 'Check your email for a link to reset your password.', 'personalize-login' ); ?>
    </div>
<?php endif; ?>
<!-- Show logged out message if user just logged out -->
<?php if ( $attributes['logged_out'] ) : ?>
    <div class="alert alert-info login-info" role="alert">
        <?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
    </div>
<?php endif; ?>
<?php if ( $attributes['password_updated'] ) : ?>
    <div class="alert alert-info login-info" role="alert">
        <?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="login-form-container py-3 text-left">
            <p><?php _e( 'If you haven\'t created an account yet,', 'personalize-login' ); ?> <a class="" href="/register"><?php _e( 'Register here', 'personalize-login' ); ?></a>.</p>
            <form method="post" action="<?php echo wp_login_url(); ?>">
                <div class="form-group text-left">
                    <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
                    <input class="form-control" type="text" name="log" id="user_login">
                </div>
                <div class="form-group text-left">
                    <label for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
                    <input class="form-control" type="password" name="pwd" id="user_pass">
                    <a class="small forgot-password" href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Forgot your password?', 'personalize-login' ); ?></a>
                </div>
                <div class="form-group text-left">
                    <input class="btn btn-primary" type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
                </div>
            </form>
        </div>
    </div>
</div>