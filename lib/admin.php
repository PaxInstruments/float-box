<?php

class FloatBoxAdmin {
  protected $options;

  public function __construct() {
    $this->options = get_option( 'floatbox' );

    add_action( 'admin_init', array( $this, 'admin_init' ) );
    add_action( 'admin_menu', array( $this, 'floatbox_admin_menu' ) );
  }

  public function admin_init()
  {
      register_setting( 'floatbox', 'floatbox', array( $this, 'floatbox_validate_options' ) );
      add_settings_section( 'floatbox_content_section',
         'Content Settings', 
         array( $this, 'init_default_settings' ), 'floatbox' );
      add_settings_field( 'floatbox_content', 
        'Floatbox Content', 
        array( $this, 'floatbox_content_textarea' ), 
        'floatbox', 
        'floatbox_content_section' );
  }

  function init_default_settings() {

  }


  public function floatbox_admin_menu()
  {
    add_options_page( 'Floatbox', 'Floatbox', 'manage_options', 'floatbox', array ( $this, 'floatbox_options_page' ) );
  }

  function floatbox_options_page() {
      if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
      }
      ?>
      <div class="wrap">
        <h2>Floatbox Options</h2>
        <form action="options.php" method="POST">
          <?php settings_fields( 'floatbox' ); ?>
          <?php do_settings_sections( 'floatbox' ); ?>
          <?php submit_button(); ?>
        </form>
      </div>
      <?php
  }

  public function floatbox_validate_options($inputs)
  {
      foreach ( $inputs as $key => $input ) {
        $inputs[ $key ] = is_string( $input ) ? trim( $input ) : $input;
      }

      //$inputs['url'] = untrailingslashit( $inputs['url'] );
      return $inputs;
  }

  public function floatbox_content_textarea()
  {
       self::text_area( 'floatbox-content', 'The content of the floatbox.' );
  }

  function text_area( $option, $description) {
      $options = $this->options;

      if ( array_key_exists( $option, $options ) ) {
        $value = $options[$option];
      } else {
        $value = '';
      }

      ?>
      <textarea cols=100 rows=6 id='floatbox_<?php echo $option?>' name='floatbox[<?php echo $option?>]'><?php echo esc_textarea( $value ); ?></textarea>
      <p class="description"><?php echo $description ?></p>
      <?php

  }

  function text_input( $option, $description ) {
      $options = $this->options;

      if ( array_key_exists( $option, $options ) ) {
        $value = $options[$option];
      } else {
        $value = '';
      }

      ?>
      <input id='floatbox_<?php echo $option?>' name='floatbox[<?php echo $option?>]' type='text' value='<?php echo esc_attr( $value ); ?>' class="regular-text ltr" />
      <p class="description"><?php echo $description ?></p>
      <?php

  }
}
