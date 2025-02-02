<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "rscs";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => 'RS Coming Soon',
        // Name that appears at the top of your panel
        'display_version'      => 1.0,
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'RS Coming Soon', 'redux-framework-demo' ),
        'page_title'           => __( 'RS Coming Soon', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 870,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );



    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title' => __( 'Settings ', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( '', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'  => 'el el-home'
    ) );





    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'redux-framework-demo' ),
        'id'         => 'general',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields'     => array(
		

            array(
                'id'       => 'logo_on',
                'type'     => 'switch',
                'title'    => __( 'Logo ?', 'redux-framework-demo' ),
                'options' => array('on', 'off'),
                'default'  => false,
            ),


            array(
                'id'       => 'logo_upload',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo Upload', 'redux-framework-demo' ),
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( 'Use 325x80 px for perfect size', 'redux-framework-demo' ),
                //'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
                'default'  => array(
                    'url'=>'http://i.imgur.com/wVbnRTi.png'
                    ),

                'required' => array( 'logo_on', '=', '1' ),
            ),		

            array(
                'id'       => 'bg_image_on',
                'type'     => 'switch',
                'title'    => __( 'Background Image ?', 'redux-framework-demo' ),
                'options' => array('on', 'off'),
                'default'  => false,
            ),


            array(
                'id'       => 'bg_image_upload',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Background Image Upload', 'redux-framework-demo' ),
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( 'Use 1920x1080 px for perfect size', 'redux-framework-demo' ),
                //'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
                'default'  => array(
                    'url'=>'http://i.imgur.com/UWgOaYw.jpg'
                    ),

                'required' => array( 'bg_image_on', '=', '1' ),
            ),


            array(
                'id'       => 'title',
                'type'     => 'text',
                'title'    => __( 'Title', 'redux-framework-demo' ),
                'desc'     => __( 'ex: your site name', 'redux-framework-demo' ),
                'default'  => __( 'Your Site Name', 'redux-framework-demo' ),

            ),


            array(
                'id'       => 'sub_title',
                'type'     => 'text',
                'title'    => __( 'Sub Title', 'redux-framework-demo' ),
                'desc'     => __( 'leave it blank if not needed ', 'redux-framework-demo' ),
                'default'  => __( 'Be ready, we are launching soon.', 'redux-framework-demo' ),

            ),



            array(
                'id'       => 'countdown',
                'type'     => 'switch',
                'title'    => __( 'Countdown ?', 'redux-framework-demo' ),
                'options' => array('true', 'false'),
                'default'  => true,
            ),

        
            array(
                'id'       => 'date',
                'type'     => 'date',
                'title'    => __( 'Set Countdown', 'redux-framework-demo' ),
                'subtitle' => __( 'No validation can be done on this field type', 'redux-framework-demo' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'redux-framework-demo' )
                //'required' => array( 'countdown', '=', '1' ),
            ),

		
            array(
                'id'       => 'timezone',
                'type'     => 'text',
                'title'    => __( 'Set Timezone', 'redux-framework-demo', 'redux-framework-demo' ),
                'default'  => __( '-8', 'redux-framework-demo', 'redux-framework-demo' ),
                //'required' => array( 'countdown', '=', '1' ),

            ),
		
		
		
			),
		)
	);





    Redux::setSection( $opt_name, array(
        'title'      => __( 'Subscribe Form', 'redux-framework-demo' ),
        'id'         => 'subs_form',
        'subsection' => true,
        'customizer_width' => '450px',
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '',
        'fields'     => array(
					
		
            array(
                'id'       => 'subs_title',
                'type'     => 'text',
                'title'    => __('Form Title', 'redux-framework-demo'),
                'default'  => __( 'Subscribe to get notified', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'subs_placeholder',
                'type'     => 'text',
                'title'    => __('Placeholer Text', 'redux-framework-demo'),
                'default'  => __( 'enter your e-mail', 'redux-framework-demo' ),
            ),

			array(
				'id'       => 'thankyou',
				'type'     => 'text',
				'title'    => __('Text after form submit', 'redux-framework-demo'),
				'default'  => __( 'Thank you for subscribing to our mailing list', 'redux-framework-demo' ),
			),
					
		
			),
		)
	);		
	

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Fonts', 'redux-framework-demo' ),
        'id'         => 'fonts',
        'subsection' => true,
        'customizer_width' => '450px',
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '',
        'fields'     => array(
					
        
            array(
                'id'       => 'font',
                'type'     => 'text',
                'title'    => __('Goolge Font Name', 'redux-framework-demo'),
                'default'  => __( 'Lato', 'redux-framework-demo' ),
                'desc'     => __( 'use "+" if font name has double word ex: Open+Sans', 'redux-framework-demo' )                
            ),			
					
		
			),
		)
	);		
	
	
	
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Translation', 'redux-framework-demo' ),
        'id'         => 'translation',
        'subsection' => true,
        'customizer_width' => '450px',
        'desc'       => __( 'Translate words into your language', 'redux-framework-demo' ),
        'fields'     => array(
					

                    array(
                        'id'       => 'days',
                        'type'     => 'text',
                        'title'    => __('Days', 'redux-framework-demo'),
                        'default'  => 'Days'
                    ),

                    array(
                        'id'       => 'hours',
                        'type'     => 'text',
                        'title'    => __('Hours', 'redux-framework-demo'),
                        'default'  => 'Hours'
                    ),

                    array(
                        'id'       => 'minutes',
                        'type'     => 'text',
                        'title'    => __('Minutes', 'redux-framework-demo'),
                        'default'  => 'Minutes'
                    ),

					array(
						'id'       => 'seconds',
						'type'     => 'text',
						'title'    => __('Seconds', 'redux-framework-demo'),
						'default'  => 'Seconds'
					),
					
		
			),
		)
	);	
	
	
	


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Media', 'redux-framework-demo' ),
        'id'         => 'services',
        'subsection' => true,
        'customizer_width' => '450px',
        //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '',
        'fields'     => array(
					




                    array(
                        'id'       => 'twitter',
                        'type'     => 'text',
                        'title'    => __('Twitter Link', 'redux-framework-demo'),
                        'desc'     => __( 'leave it blank if you do not want', 'redux-framework-demo' ) 
                    ),

                    array(
                        'id'       => 'facebook',
                        'type'     => 'text',
                        'title'    => __('Facebook Link', 'redux-framework-demo'),
                        'desc'     => __( 'leave it blank if you do not want', 'redux-framework-demo' ) 
                    ),

                    array(
                        'id'       => 'google_plus',
                        'type'     => 'text',
                        'title'    => __('Google Plus Link', 'redux-framework-demo'),
                        'desc'     => __( 'leave it blank if you do not want', 'redux-framework-demo' ) 
                    ),

                    array(
                        'id'       => 'instagram',
                        'type'     => 'text',
                        'title'    => __('Instagram Link', 'redux-framework-demo'),
                        'desc'     => __( 'leave it blank if you do not want', 'redux-framework-demo' ) 
                    ),
					

					
		
			),
		)
	);


	
		
    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
