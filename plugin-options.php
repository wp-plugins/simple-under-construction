<?php
class simple_under_construction_options {

    //Holds the values to be used in the fields callbacks
    private $options;

    public function __construct(){

        add_action("admin_menu", array($this,"add_to_setting_menu"));
        add_action("admin_init", array($this,"page_init"));
    }

    public function add_to_setting_menu (){

        add_options_page( "Simple Under Construction", //page_title
                         "Simple Under Construction", //menu_title
                         "administrator", //capability
                         "simple-under-construction-settings", //menu_slug
                         array($this, "create_admin_page")); //callback function

    }

    public function create_admin_page (){

        $this->options = get_option ( 'simple_under_construction_settings' );

        ?>
            <div class="wrap">

                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-2">


                        <div id="post-body-content">
                            <div class="meta-box-sortables ui-sortable">
                                <div class="postbox">
                                    <h3><span class="dashicons dashicons-admin-generic"></span>Simple Under Construction Settings</h3>
                                    <div class="inside">
                                        <form method="post" action="options.php">
                                            <?php
                                            // This prints out all hidden setting fields
                                            settings_fields( 'simple_under_construction_settings_group' ); //option group
                                            do_settings_sections( 'simple-under-construction-settings' ); //settings page slug
                                            submit_button(); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!--post-body-content-->


                        <!-- sidebar -->
                        <div id="postbox-container-1" class="postbox-container">
                            <div class="meta-box-sortables">
                                <div class="postbox">
                                    <h3><span>About</span></h3>
                                    <div class="inside">
                                        Author: Shrinivas Naik <br>
                                        Plugin Homepage: <a href="http://www.techsini.com" target="_blank">Techsini.com</a> <br>
                                        Thank you for installing this plugin.
                                    </div> <!-- .inside -->
                                </div> <!-- .postbox -->

                                <div class="postbox">
                                    <h3><span>Rate This Plugin!</span></h3>
                                    <div class="inside">
                                        <p>Please <a href="https://wordpress.org/plugins/simple-under-construction/" target="_blank">rate this plugin</a> and share it to help the development.</p>
                                    </div> <!-- .inside -->
                                </div> <!-- .postbox -->

                                <div class="postbox">
                                    <h3><span>Our other WordPress Plugins</span></h3>
                                    <div class="inside">
                                      <ul>
                                      <li><a href="http://techsini.com/our-wordpress-plugins/fluid-notification-bar/">Fluid Notification Bar</a></li>
                                      <li><a href="http://techsini.com/our-wordpress-plugins/simple-adblock-notice/">Simple Adblock Notice</a></li>
                                      <li><a href="http://techsini.com/our-wordpress-plugins/elegant-subscription-popup/">Elegant Subscription Popup</a></li>
                                      <li><a href="http://masterblogster.com/plugins/disable-right-click/">Disable Right Click</a></li>
                                      <li><a href="http://masterblogster.com/plugins/ads-within-paragraph/">Ads Within Paragraph</a></li>
                                      </ul>
                                    </div> <!-- .inside -->
                                </div> <!-- .postbox -->

                            </div> <!-- .meta-box-sortables -->
                        </div> <!-- #postbox-container-1 .postbox-container -->


                    </div>
                </div>
            </div>
        <?php

    }

    public function page_init(){

        register_setting(
        'simple_under_construction_settings_group', // Option group
        'simple_under_construction_settings' // Option name
        );

        add_settings_section(
            'section1', // ID
            '', // Title
            array( $this, 'section_1_callback' ), // Callback
            'simple-under-construction-settings' // Page
        );

        add_settings_field(
            'general_settings', // ID
            '<span class="dashicons dashicons-welcome-write-blog"></span> General Settings', // Title
            array( $this, 'general_settings_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'suc_enabled', // ID
            'Enable Under Construction', // Title
            array( $this, 'suc_enabled_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'socialmedia_settings', // ID
            '<span class="dashicons dashicons-share"></span> <abbr title="Leave the links empty if you do not want to show the respective social media icons">Social Media Settings</abbr>', // Title
            array( $this, 'socialmedia_settings_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'googleplus_link', // ID
            'Google+ Link', // Title
            array( $this, 'googleplus_link_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'facebook_link', // ID
            'Facebook Link', // Title
            array( $this, 'facebook_link_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'twitter_link', // ID
            'Twitter Link', // Title
            array( $this, 'twitter_link_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'pinterest_link', // ID
            'Pinterest Link', // Title
            array( $this, 'pinterest_link_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'linkedin_link', // ID
            'Linkedin Link', // Title
            array( $this, 'linkedin_link_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

        add_settings_field(
            'credittoauthor', // ID
            'Wanna Give Credit to Author?', // Title
            array( $this, 'credittoauthor_callback' ), // Callback
            'simple-under-construction-settings', // Page
            'section1' // Section
        );

    }

    public function section_1_callback(){

    }

    public function general_settings_callback(){

    }

    public function suc_enabled_callback(){
        if(isset($this->options['suc_enabled'])){
            $fnbarenabled = $this->options['suc_enabled'];
        } else {
            $fnbarenabled = 0;
        }

        printf ('<label for="suc_enabled">
                <input type = "checkbox"
                    id = "suc_enabled"
                    name= "simple_under_construction_settings[suc_enabled]"
                    value = "1"' . checked(1, $fnbarenabled, false) . '/>'.
                ' Yes</label>');

    }

    public function socialmedia_settings_callback(){

    }

    public function googleplus_link_callback(){
        printf('<input type="text" class="regular-text" id="googleplus_link" name="simple_under_construction_settings[googleplus_link]" placeholder="http://www.google.com/example" value="%s" />',  isset( $this->options['googleplus_link'] ) ? esc_attr( $this->options['googleplus_link']) : '');
    }

    public function facebook_link_callback(){
        printf('<input type="text" class="regular-text" id="facebook_link" name="simple_under_construction_settings[facebook_link]" value="%s" />',  isset( $this->options['facebook_link'] ) ? esc_attr( $this->options['facebook_link']) : '');
    }

    public function twitter_link_callback(){
        printf('<input type="text" class="regular-text" id="twitter_link" name="simple_under_construction_settings[twitter_link]" value="%s" />',  isset( $this->options['twitter_link'] ) ? esc_attr( $this->options['twitter_link']) : '');
    }

    public function pinterest_link_callback(){
        printf('<input type="text" class="regular-text" id="pinterest_link" name="simple_under_construction_settings[pinterest_link]" value="%s" />',  isset( $this->options['pinterest_link'] ) ? esc_attr( $this->options['pinterest_link']) : '');
    }

    public function linkedin_link_callback(){
        printf('<input type="text" class="regular-text" id="linkedin_link" name="simple_under_construction_settings[linkedin_link]" value="%s" />',  isset( $this->options['linkedin_link'] ) ? esc_attr( $this->options['linkedin_link']) : '');
    }

    public function credittoauthor_callback(){

        if (!isset($this->options['credittoauthor']))
        {
            $this->options['credittoauthor'] = 0;
        }

        echo ('<input type = "checkbox"
                            id = "credittoauthor"
                            name= "simple_under_construction_settings[credittoauthor]"
                            value = "1"' . checked(1, $this->options['credittoauthor'], false) . '/>' );
    }

}

?>
