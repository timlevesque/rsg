<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
        <div class="alert alert-secondary my-3" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ( $attributes['lost_password_sent'] ) : ?>
        <div class="alert alert-info login-info my-5" role="alert">
            <?php _e( 'Check your email for a link to reset your password.', 'personalize-login' ); ?>
        </div>
<?php else: ?>
    <div id="password-lost-form" class="py-3">
    <?php if ( $attributes['show_title'] ) : ?>
        <h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
    <?php endif; ?>
    <p>
        <?php
            _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'personalize_login'
            );
        ?>
    </p>
    <form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
        <div class="form-group">
            <label for="user_login"><?php _e( 'Email', 'personalize-login' ); ?>
            <input class="form-control" type="text" name="user_login" id="user_login">
        </div>
        <div class="form-group lostpassword-submit">
            <input type="submit" name="submit" class="lostpassword-button btn btn-primary"
                   value="<?php _e( 'Reset Password', 'personalize-login' ); ?>"/>
        </div>
    </form>
</div>
<?php endif; ?>
