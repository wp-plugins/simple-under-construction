<?php
/**
* Plugin Name: Simple Under Construction
* Plugin URI: http://techsini.com/our-wordpress-plugins/simple-under-construction
* Description: Simple under construction adds a mobile friendly, animated under construction page to your website with social media icons.
* Version: 1.0.0
* Author: Shrinivas
* Author URI: http://www.techsini.com
* License: GPL2
*/

if(!class_exists('simple_under_construction')){

	class simple_under_construction{


		public function __construct(){

			//Activate the plugin for first time
			register_activation_hook(__FILE__, array($this, "activate"));

			//Load scipts and styles
			add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
			add_action('wp_enqueue_scripts', array($this, 'register_styles'));

			//Initialize settings page
            require_once(plugin_dir_path(__FILE__) . "plugin-options.php");
            $simple_under_construction_options = new simple_under_construction_options;

			//Run the plugin in footer
			add_action('wp_footer', array($this, 'run_plugin'));

			//Store options in a variable
            $this->options = get_option( 'simple_under_construction_settings' );
		}


		public function activate(){
			//Set default options for the plugin
            $initial_settings = array(
                'suc_enabled'     	=> '1',
                'googleplus_link'   => 'https://google.com/+Techsini',
                'facebook_link'     => '',
                'twitter_link'      => '',
                'pinterest_link'    => '',
                'linkedin_link'     => '',
				'credittoauthor'	=> '0'

                );
            add_option("simple_under_construction_settings", $initial_settings);

            //Show activation notice
            add_action('admin_notices', array($this,'show_activation_message'));
		}

		public function deactivate(){

		}

		public function register_scripts(){
			//wp_enqueue_script('jquery');
		}

		public function register_styles(){
			wp_enqueue_style( 'SimpleUnderConstruction', plugins_url('css/style.css', __FILE__) );
		}

		function show_activation_message(){
          echo '<div class="updated"><p><b>Simple Under Construction</b> has been activated successfully. Head over to plugin <a href="'. esc_url( get_admin_url(null, 'options-general.php?page=simple-under-construction-settings') ) .'">Settings</a></p></div>';
        }

		public function run_plugin() {

			//Get general settings
            if(isset($this->options["suc_enabled"])){
                $suc_enabled = $this->options["suc_enabled"];
            } else {
                $suc_enabled = 0;
            }

            //Social Media Settings
            $googleplus_link = isset($this->options["googleplus_link"]) ? $this->options["googleplus_link"] : '';
            $facebook_link = isset($this->options["facebook_link"]) ? $this->options["facebook_link"] : '';
            $twitter_link = isset($this->options["twitter_link"]) ? $this->options["twitter_link"] : '';
            $pinterest_link = isset($this->options["pinterest_link"]) ? $this->options["pinterest_link"] : '';
            $linkedin_link = isset($this->options["linkedin_link"]) ? $this->options["linkedin_link"] : '';

			$credit = $this->options['credittoauthor'];

			if($suc_enabled == 1 && !is_user_logged_in()) {
				?>


				<style type="text/css">
					body::-webkit-scrollbar {
					display: none;
					}
				</style>

				<div class="simpleunderconstruction_wrapper">

					<br>

					<h2>WE ARE AT WORK</h2>

					<p><?php echo bloginfo('name') ?> is under construction, we are launching soon!. <br> Thank you for visiting our website.</p>
					<!-- Look how semantic! -->
					<div id="construction"></div>
					<!-- Just a single DIV! -->

					<br>
					<br>

					<ul class="soc_suc">
						<?php if(!empty($googleplus_link)) {?>
                        <li><a class="soc-google" href="<?php echo $googleplus_link ?>"></a></li>
                        <?php } ?>
                        <?php if(!empty($facebook_link)) {?>
                        <li><a class="soc-facebook" href="<?php echo $facebook_link ?>"></a></li>
                        <?php } ?>
                        <?php if(!empty($twitter_link)) {?>
                        <li><a class="soc-twitter" href="<?php echo $twitter_link ?>"></a></li>
                        <?php } ?>
                        <?php if(!empty($pinterest_link)) {?>
                        <li><a class="soc-pinterest" href="<?php echo $pinterest_link ?>"></a></li>
                        <?php } ?>
                        <?php if(!empty($linkedin_link)) {?>
                        <li><a class="soc-linkedin soc-icon-last" href="<?php echo $linkedin_link ?>"></a></li>
                        <?php } ?>
					</ul>

					<br>

					<?php
                            if($credit == "1"){
                                echo "<br><a class='credittoauthor' href='http://techsini.com' target='_blank'>WordPress Plugin by TECHSINI</a>";
                            }
                    ?>

				</div>

				<?php
			}

		}

	}

}


$simple_under_construction = new simple_under_construction();

?>
