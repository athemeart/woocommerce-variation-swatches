<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('ATA_WC_Variation_Swatches_Options' ) ):

class ATA_WC_Variation_Swatches_Options {
	/**
	 * The single instance of the class
	 *
	 * @var ATA_WC_Variation_Swatches_Admin
	 */
	protected static $instance = null;
	
    private $settings_api;

	/**
	 * Main instance
	 *
	 * @return ATA_WC_Variation_Swatches_Admin
	 */
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	/**
	 * Class constructor.
	 */
    function __construct() {
		require_once 'class.settings-api.php';
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
       // add_options_page( 'Settings API', 'Settings API', 'woocommerce', 'settings_api_test', array($this, 'plugin_page') );
		   add_submenu_page( 'woocommerce', 'Variation Swatches ', 'Smart Swatches', 'manage_options', 'ata-variation-swatches', array($this, 'plugin_page') ); 
    }

    function get_settings_sections() {
		
        $sections = array(
			array(
                'id'    => 'general_settings',
                'title' => __( 'General Settings', 'smart-variation-swatches' )
            ),
			
			 array(
                'id'    => 'atawc_label',
                'title' => __( 'Label Swatches  Settings', 'smart-variation-swatches' )
            ),
            array(
                'id'    => 'atawc_color',
                'title' => __( 'Color Swatches  Settings', 'smart-variation-swatches' )
            ),
            array(
                'id'    => 'atawc_images',
                'title' => __( 'Images Swatches Settings', 'smart-variation-swatches' )
            ),
			array(
                'id'    => 'archive_settings',
                'title' => __( 'Shop / Archive', 'smart-variation-swatches' )
            ),
			array(
                'id'    => 'atawc_tutorials',
                'title' => __( 'Tutorials', 'smart-variation-swatches' )
            ),
            
			 
        );
        return $sections;
    }
	

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
		  
		'atawc_tutorials' => array(
			array(
				'name'    => '__swatches_display_on_archive',
				'label'   => __( 'Enable Swatches', 'smart-variation-swatches' ),
				'type'    => 'tutorials',
				'default' => 'on',
				'desc'    => __( 'Show Swatches on archive / shop page', 'smart-variation-swatches' ),
			),
			
		),
		 'archive_settings' => array(
				
		
				
				array(
                    'name'    => '__swatches_display_on_archive',
                    'label'   => __( 'Enable Swatches', 'smart-variation-swatches' ),
                    'type'    => 'checkbox',
                    'default' => 'on',
					'desc'    => __( 'Show Swatches on archive / shop page', 'smart-variation-swatches' ),
                ),
				
				
				
				
			),
			
			
		 'general_settings' => array(
				array(
					'name'    => '__price_update_on',
					'label'   => __( 'Variable Price range Show', 'smart-variation-swatches' ),
					'type'    => 'text',
					'default' => 'price',
					'desc'    => __( 'Replace the Variable Price range by the chosen css class', 'smart-variation-swatches' ),
				),
				
				array(
                    'name'    => '__swatches_tooltip',
                    'label'   => __( 'Tooltip Color', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#000'
                ),
				array(
                    'name'    => '__swatches_bg',
                    'label'   => __( 'Tooltip Background', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),
				
				array(
                    'name'    => '__swatches_tick_sing_color',
                    'label'   => __( 'Tick sign Color', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#000'
                ),
				
				array(
                    'name'    => '__search_widgets',
                    'label'   => __( 'Product filter by Swatches/ attributes  ', 'smart-variation-swatches' ),
                    'type'    => 'html',
					'desc'    => '<a href="https://athemeart.com/blog/docs/smart-variation-swatches-plugins-documentation/product-filter-by-swatches/" target="_blank">Learn more ! how to add product filter widgets </a>',
                   
                ),
				
				
			),
			
			
            'atawc_label' => array(
				array(
                    'name'    => 'lebel_variation_style',
                    'label'   => __( 'Swatches Type', 'smart-variation-swatches' ),
                    'type'    => 'select',
                    'default' => 'square',
                    'options' => array(
                        'square' => __( 'Square', 'smart-variation-swatches' ),
                        'round'  => __( 'Circle', 'smart-variation-swatches' ),
						'round_corner'  => __( 'Round corner', 'smart-variation-swatches' ),
                    )
                ),
                array(
                    'name'              => 'lebel_variation_width',
                    'label'             => __( 'Button Width', 'smart-variation-swatches' ),
                    'default' 			=> 40,
                    'type'              => 'number',
                    'sanitize_callback' => 'number'
                ),
				array(
                    'name'              => 'lebel_variation_height',
                    'label'             => __( 'Button Height', 'smart-variation-swatches' ),
                    'default' 			=> 40,
                    'type'              => 'number',
                    'sanitize_callback' => 'number'
                ),
				array(
                    'name'              => 'lebel_variation_size',
                    'label'             => __( 'Font Size', 'smart-variation-swatches' ),
                    'default' 			=> 13,
                    'type'              => 'number',
                    'sanitize_callback' => 'number',
					'desc'    => __( 'PX', 'smart-variation-swatches' ),
                ),
				
				
               	array(
                    'name'    => 'lebel_variation_color',
                    'label'   => __( 'Button Color', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),
				array(
                    'name'    => 'lebel_variation_background',
                    'label'   => __( 'Button Background', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#000'
                ),
				array(
                    'name'    => 'lebel_variation_border',
                    'label'   => __( 'border Color', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#000'
                ),
				
				array(
                    'name'    => 'swatches_hover_settings',
                    'label'   =>'',
                    'type'    => 'html',
                  
                ),
				array(
                    'name'    => 'lebel_variation_color_hover',
                    'label'   => __( 'Hover Color', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#000'
                ),
				
				array(
                    'name'    => 'lebel_variation_background_hover',
                    'label'   => __( 'Hover Background', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#c8c8c8'
                ),
				
				
				array(
                    'name'    => 'lebel_variation_border_hover',
                    'label'   => __( 'Hover border', 'smart-variation-swatches' ),
                    'type'    => 'color',
                    'default' => '#c8c8c8'
                ),
				array(
                    'name'    => 'swatches_hover_settings_2',
                    'label'   =>'',
                    'type'    => 'html',
                  
                ),
				array(
                    'name'    => 'lebel_variation_tooltip',
                    'label'   => __( 'Color Swatches tooltip', 'smart-variation-swatches' ),
                    'type'    => 'select',
                    'default' => 'yes',
                    'options' => array(
                        'yes' => __( 'Yes', 'smart-variation-swatches' ),
                        'no'  => __( 'No', 'smart-variation-swatches' ),
                    )
                ),
				array(
                    'name'    => 'lebel_variation_ingredient',
                   'label'   => __( 'Active / Selected item ingredient', 'smart-variation-swatches' ),
                    'type'    => 'select',
                    'default' => 'opacity',
                    'options' => array(
                        'tick_sign' => __( 'Tick sign', 'smart-variation-swatches' ),
                        'opacity'  => __( 'Opacity', 'smart-variation-swatches' ),
						'zoom_up'  => __( 'Zoom Up', 'smart-variation-swatches' ),
						'zoom_down'  => __( 'Zoom Down', 'smart-variation-swatches' ),
                    )
                ),
            ),
            'atawc_color' => array(
               array(
                    'name'    => 'color_variation_style',
                    'label'   => __( 'Swatches Type', 'smart-variation-swatches' ),
                    'type'    => 'select',
                    'default' => 'round',
                    'options' => array(
                        'square' => __( 'Square', 'smart-variation-swatches' ),
                        'round'  => __( 'Circle', 'smart-variation-swatches' ),
						'round_corner'  => __( 'Round corner', 'smart-variation-swatches' ),
                    )
                ),
               
				
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }


}


endif;
