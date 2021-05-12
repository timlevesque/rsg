<!-- Show errors if there are any -->
<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
        <div class="login-error alert alert-warning my-3" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<div class ="row">
    <div id="register-form" class="col-md-8 offset-md-2">
        <?php if ( $attributes['show_title'] ) : ?>
            <h3><?php _e( 'Register', 'personalize-login' ); ?></h3>
        <?php endif; ?>
    
        <form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
            <div class="form-group text-left">
                <label for="email"><?php _e( 'Email', 'personalize-login' ); ?> <strong>*</strong></label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
    
            <div class="form-group text-left">
                <label for="first_name"><?php _e( 'First name', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="first_name" id="first-name">
            </div>
    
            <div class="form-group text-left">
                <label for="last_name"><?php _e( 'Last name', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="last_name" id="last-name">
            </div>

            <div class="form-group text-left">
                <label for="address"><?php _e( 'Address', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="address" id="address">
            </div>

            <div class="form-group text-left">
                <label for="city"><?php _e( 'City', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="city" id="city">
            </div>        

            <div class="form-group text-left">
                <label for="zip"><?php _e( 'Zip', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="zip" id="zip">
            </div>              

            <div class="form-group text-left">
                <label for="phone"><?php _e( 'Phone', 'personalize-login' ); ?></label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>                
    
            <div class="form-group text-left">
                <?php _e( 'Note: Your password will be generated automatically and sent to your email address.', 'personalize-login' ); ?>
            </div>
    
            <div class="form-group signup-submit text-left">
                <input type="submit" name="submit" class="btn btn-primary register-button"
                    value="<?php _e( 'Register', 'personalize-login' ); ?>"/>
            </div>
        </form>
    </div>
</div>