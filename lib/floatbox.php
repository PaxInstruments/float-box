<?php


/**
* 
*/
class FloatBox 
{
    static $version = "0.0.1";

    static $default_options = array(
        'floatbox-content' =>  "Hello world!",
        'floatbox-style' => "" );

    function __construct()
    {
        $this->options = get_option("floatbox");

        if(empty($this->options['floatbox-style'])){
            $this->options['floatbox-style'] = file_get_contents(FLOATBOX_PATH."/css/float-box.css");
            update_option("floatbox", $this->options);
        }
        
        
        
        add_action( 'init', array( $this, 'init' ) );
        //add_action( 'wp_footer', array( $this, 'load_js' ), 100 );
    }

    public function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'load_css') );
        //add_action('wp_head', array($this, 'load_css') );
        add_action('wp_footer', array($this, 'load_js') );
        add_action('wp_footer', array($this, 'draw_floatbox') );
    }

    public function load_css()
    {
        wp_enqueue_style('floatbox_style', plugins_url( '../css/float-box.css', __FILE__ ) );
        wp_enqueue_style('floatbox_style_custom', plugins_url( 'dynamic_style.php', __FILE__ ) );
        //self::draw_floatbox();
    }

    public function load_js()
    {
        //$post = get_post();
        #if($post->post_title != 'Home') return;

        wp_register_script('draw_floatbox', plugins_url( '../js/draw_floatbox.js', __FILE__ ),  array( 'jquery' ) );
        wp_enqueue_script('draw_floatbox');
        //self::draw_floatbox();
    }

    public function draw_floatbox()
    {

        ?>
<div class="floatBox">
    <div class="floatBoxClose">
        <img src="<?php  print plugins_url( '../images/close_button.png', __FILE__ ); ?>" />
    </div>
    <?php  print do_shortcode($this->options['floatbox-content']); ?>
</div>
        <?php
    }

    public function install()
    {
        update_option( 'floatbox_version', self::$version );
        add_option( 'floatbox', self::$default_options );
    }
}