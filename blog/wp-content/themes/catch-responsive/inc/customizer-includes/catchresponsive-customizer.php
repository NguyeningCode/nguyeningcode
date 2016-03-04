<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Catch Responsive
 * @since Catch Responsive 1.0 
 */

if ( ! defined( 'CATCHRESPONSIVE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * Implements Catchresponsive theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';

	/**
	  * Set priority of blogname (Site Title) to 1. 
	  *  Strangly, if more than two options is added, Site title is moved below Tagline. This rectifies this issue.
	  */
	$wp_customize->get_control( 'blogname' )->priority			= 1;

	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = catchresponsive_get_theme_options();

	$defaults = catchresponsive_get_default_theme_options();

	//Custom Controls
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-custom-controls.php';

	// Custom Logo (added to Site Title and Tagline section in Theme Customizer)
	$wp_customize->add_setting( 'catchresponsive_theme_options[logo]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo'],
		'sanitize_callback'	=> 'catchresponsive_sanitize_image'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'		=> __( 'Logo', 'catchresponsive' ),
		'priority'	=> 100,
		'section'   => 'title_tagline',
        'settings'  => 'catchresponsive_theme_options[logo]',
    ) ) );

    $wp_customize->add_setting( 'catchresponsive_theme_options[logo_disable]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo_disable'],
		'sanitize_callback' => 'catchresponsive_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchresponsive_theme_options[logo_disable]', array(
		'label'    => __( 'Check to disable logo', 'catchresponsive' ),
		'priority' => 101,
		'section'  => 'title_tagline',
		'settings' => 'catchresponsive_theme_options[logo_disable]',
		'type'     => 'checkbox',
	) );
	
	$wp_customize->add_setting( 'catchresponsive_theme_options[logo_alt_text]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo_alt_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'catchresponsive_logo_alt_text', array(
		'label'    	=> __( 'Logo Alt Text', 'catchresponsive' ),
		'priority'	=> 102,
		'section' 	=> 'title_tagline',
		'settings' 	=> 'catchresponsive_theme_options[logo_alt_text]',
		'type'     	=> 'text',
	) );

	$wp_customize->add_setting( 'catchresponsive_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'catchresponsive_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchresponsive_theme_options[move_title_tagline]', array(
		'label'    => __( 'Check to move Site Title and Tagline before logo', 'catchresponsive' ),
		'priority' => 103,
		'section'  => 'title_tagline',
		'settings' => 'catchresponsive_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );
	// Custom Logo End
	 
	// Color Scheme
	$wp_customize->add_setting( 'catchresponsive_theme_options[color_scheme]', array(
		'capability' 		=> 'edit_theme_options',
		'default'    		=> $defaults['color_scheme'],
		'sanitize_callback'	=> 'sanitize_key',
		'transport'         => 'postMessage',
	) );

	$schemes = catchresponsive_color_schemes();

	$choices = array();

	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_control( 'catchresponsive_theme_options[color_scheme]', array(
		'choices'  => $choices,
		'label'    => __( 'Color Scheme', 'catchresponsive' ),
		'priority' => 5,
		'section'  => 'colors',
		'settings' => 'catchresponsive_theme_options[color_scheme]',
		'type'     => 'radio',
	) );
	//End Color Scheme

	// Header Options (added to Header section in Theme Customizer)
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-header-options.php';

	//Theme Options
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-theme-options.php';
	
	//Featured Content Setting
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-featured-content-setting.php';
   	
	//Featured Slider
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-featured-slider.php';

	//Social Links
	require get_template_directory() . '/inc/customizer-includes/catchresponsive-customizer-social-icons.php';
	
	// Reset all settings to default
	$wp_customize->add_section( 'catchresponsive_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'catchresponsive' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'catchresponsive' ),
	) );

	$wp_customize->add_setting( 'catchresponsive_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'catchresponsive_reset_all_settings',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'catchresponsive_theme_options[reset_all_settings]', array(
		'label'    => __( 'Check to reset all settings to default', 'catchresponsive' ),
		'section'  => 'catchresponsive_reset_all_settings',
		'settings' => 'catchresponsive_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end

	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' 		=> 999,
		'title'   	 	=> __( 'Important Links', 'catchresponsive' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'catchresponsive_sanitize_important_link',
	) );

	$wp_customize->add_control( new Catchresponsive_Important_Links( $wp_customize, 'important_links', array(
        'label'   	=> __( 'Important Links', 'catchresponsive' ),
         'section'  	=> 'important_links',
        'settings' 	=> 'important_links',
        'type'     	=> 'important_links',
    ) ) );  
    //Important Links End
}
add_action( 'customize_register', 'catchresponsive_customize_register' );


/**
 * Sanitizes Checkboxes
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } 
    else {
        return '';
    }
}


/**
 * Sanitizes Custom CSS 
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_custom_css( $input ) {
	if ( $input != '' ) { 
        $input = str_replace( '<=', '&lt;=', $input ); 
        
        $input = wp_kses_split( $input, array(), array() ); 
        
        $input = str_replace( '&gt;', '>', $input ); 
        
        $input = strip_tags( $input ); 

        return $input;
 	}
    else {
    	return '';
    }
}

/**
 * Sanitizes images uploaded
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_image( $input ) {
	return esc_url_raw( $input );
}

/**
 * Sanitizes post_id in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_post_id( $input ) {
    //check if post exists
	if( get_post_status( $input ) ) {
		return $input;
    }
    else {
    	return '';
    }
}


/**
 * Sanitizes page in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_page( $input ) {
	if(  get_post( $input ) ){
		return $input;
	}
    else {
    	return '';
    }
}


/**
 * Sanitizes category list in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_category_list( $input ) {
	if ( $input != '' ) { 
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					); 
		
		$categories = ( get_categories( $args ) );

		$category_list 	=	array();
		
		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    } 
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}


/**
 * Sanitizes slider number
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_no_of_slider( $input ) {
	if ( absint( $input ) > 20 ) {
    	return 20;
    } 
    else {
    	return absint( $input );
    }
}

/**
 * Sanitizes custom social icons number
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_no_of_social_icons( $input ) {
	if ( absint( $input ) > 10 ) {
    	return 10;
    } 
    else {
    	return absint( $input );
    }
}


/**
 * Sanitizes footer code
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_footer_code( $input ) {
	return ( stripslashes( wp_filter_post_kses( addslashes ( $input ) ) ) );
}


/**
 * Sanitizes feature slider transition effects
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_sanitize_featured_slide_transition_effects( $input ) {
	$catchresponsive_featured_slide_transition_effects = array_keys( catchresponsive_featured_slide_transition_effects() );
	
	if ( in_array( $input, $catchresponsive_featured_slide_transition_effects ) ) {
		return $input;
	}
	else {
		$defaults = catchresponsive_get_default_theme_options();

		return $defaults['featured_slide_transition_effect'];
	}
}


/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_reset_all_settings( $input ) {
	if ( $input == 1 ) {
        // Set default values
        set_theme_mod( 'catchresponsive_theme_options', catchresponsive_get_default_theme_options() );
       
        // Flush out all transients	on reset
        catchresponsive_flush_transients();
    } 
    else {
        return '';
    }
}


/**
 * Dummy Sanitizaition function as it contains no value to be sanitized
 *
 * @since  Catchresponsive 1.2
 */
function create_sanitize_important_link() {
	return false;
} 


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for catchresponsive.
 * And flushes out all transient data on preview
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_customize_preview() {
	wp_enqueue_script( 'catchresponsive_customizer', get_template_directory_uri() . '/js/catchresponsive-customizer.min.js', array( 'customize-preview' ), '20120827', true );
	
	//Flush transients on preview
	catchresponsive_flush_transients();
}
add_action( 'customize_preview_init', 'catchresponsive_customize_preview' );


/**
 * Custom scripts and styles on customize.php for catchresponsive.
 *
 * @since Catch Responsive 1.0
 */
function catchresponsive_customize_scripts() {
	wp_register_script( 'catchresponsive_customizer_custom', get_template_directory_uri() . '/js/catchresponsive-customizer-custom-scripts.min.js', array( 'jquery' ), '20131028', true );

	$catchresponsive_misc_links = array(
							'upgrade_link' 				=> esc_url( 'http://catchthemes.com/themes/catch-responsive-pro/' ),
							'upgrade_text'	 			=> __( 'Upgrade To Pro &raquo;', 'catchresponsive' ),
							'WP_version'				=> get_bloginfo( 'version' ),
							'old_version_message'		=> __( 'Some settings might be missing or disorganized in this version of WordPress. So we suggest you to upgrade to version 4.0 or better.', 'catchresponsive' )
		);

	//Add Upgrade Button and old WordPress message via localized script
	wp_localize_script( 'catchresponsive_customizer_custom', 'catchresponsive_misc_links', $catchresponsive_misc_links );

	wp_enqueue_script( 'catchresponsive_customizer_custom' );

	wp_enqueue_style( 'catchresponsive_customizer_custom', get_template_directory_uri() . '/css/catchresponsive-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'catchresponsive_customize_scripts');