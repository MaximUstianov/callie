<?php
/**
 * Customizer settings for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

if ( ! class_exists( 'TwentyTwenty_Customize' ) ) {
	/**
	 * CUSTOMIZER SETTINGS
	 */
	class TwentyTwenty_Customize {

		/**
		 * Register customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function register( $wp_customize ) {

			/**
			 * Site Title & Description.
			 * */
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'twentytwenty_customize_partial_blogname',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'twentytwenty_customize_partial_blogdescription',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'custom_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'twentytwenty_customize_partial_site_logo',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'retina_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'twentytwenty_customize_partial_site_logo',
				)
			);

			/**
			 * Site Identity
			 */

			/* 2X Header Logo ---------------- */
			$wp_customize->add_setting(
				'retina_logo',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'retina_logo',
				array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'priority'    => 10,
					'label'       => __( 'Retina logo', 'twentytwenty' ),
					'description' => __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'twentytwenty' ),
				)
			);

			// Header & Footer Background Color.
			$wp_customize->add_setting(
				'header_footer_background_color',
				array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'header_footer_background_color',
					array(
						'label'   => __( 'Header &amp; Footer Background Color', 'twentytwenty' ),
						'section' => 'colors',
					)
				)
			);

			// Enable picking an accent color.
			$wp_customize->add_setting(
				'accent_hue_active',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
					'transport'         => 'postMessage',
					'default'           => 'default',
				)
			);

			$wp_customize->add_control(
				'accent_hue_active',
				array(
					'type'    => 'radio',
					'section' => 'colors',
					'label'   => __( 'Primary Color', 'twentytwenty' ),
					'choices' => array(
						'default' => _x( 'Default', 'color', 'twentytwenty' ),
						'custom'  => _x( 'Custom', 'color', 'twentytwenty' ),
					),
				)
			);

			/**
			 * Implementation for the accent color.
			 * This is different to all other color options because of the accessibility enhancements.
			 * The control is a hue-only colorpicker, and there is a separate setting that holds values
			 * for other colors calculated based on the selected hue and various background-colors on the page.
			 *
			 * @since Twenty Twenty 1.0
			 */

			// Add the setting for the hue colorpicker.
			$wp_customize->add_setting(
				'accent_hue',
				array(
					'default'           => 344,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'absint',
					'transport'         => 'postMessage',
				)
			);

			// Add setting to hold colors derived from the accent hue.
			$wp_customize->add_setting(
				'accent_accessible_colors',
				array(
					'default'           => array(
						'content'       => array(
							'text'      => '#000000',
							'accent'    => '#cd2653',
							'secondary' => '#6d6d6d',
							'borders'   => '#dcd7ca',
						),
						'header-footer' => array(
							'text'      => '#000000',
							'accent'    => '#cd2653',
							'secondary' => '#6d6d6d',
							'borders'   => '#dcd7ca',
						),
					),
					'type'              => 'theme_mod',
					'transport'         => 'postMessage',
					'sanitize_callback' => array( __CLASS__, 'sanitize_accent_accessible_colors' ),
				)
			);

			// Add the hue-only colorpicker for the accent color.
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'accent_hue',
					array(
						'section'         => 'colors',
						'settings'        => 'accent_hue',
						'description'     => __( 'Apply a custom color for links, buttons, featured images.', 'twentytwenty' ),
						'mode'            => 'hue',
						'active_callback' => function() use ( $wp_customize ) {
							return ( 'custom' === $wp_customize->get_setting( 'accent_hue_active' )->value() );
						},
					)
				)
			);

			// Update background color with postMessage, so inline CSS output is updated as well.
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

			/**
			 * Theme Options
			 */

			$wp_customize->add_section(
				'options',
				array(
					'title'      => __( 'Theme Options', 'twentytwenty' ),
					'priority'   => 40,
					'capability' => 'edit_theme_options',
				)
			);
			
			$wp_customize->add_setting(
				'Copyright text',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'Copyright &copy;2021 All rights reserved | Made with ',
				)
			);
			
			$wp_customize->add_control(
				'Copyright text',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'label'    => __('Copyright text', 'twentytwenty' ),
				)
			);
			
			$wp_customize->add_setting(
				'Footer text',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'Nec feugiat nisl pretium fusce id velit ut tortor pretium.',
				)
			);
			
			$wp_customize->add_control(
				'Footer text',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'label'    => __('Footer text', 'twentytwenty' ),
				)
			);
			
			$wp_customize->add_setting(
				'Facebook link',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'https://www.facebook.com/',
				)
			);

			$wp_customize->add_control(
				'Facebook link',
				array(
					'type'     => 'text',
					'section'  => 'options',
					'label'    => __('Facebook link', 'twentytwenty' ),
				)
			);

            $wp_customize->add_setting(
                'Twitter link',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.twitter.com/',
                )
            );

            $wp_customize->add_control(
                'Twitter link',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Twitter link', 'twentytwenty' ),
                )
            );
            $wp_customize->add_setting(
                'GooglePlusLink',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.google.com/',
                )
            );

            $wp_customize->add_control(
                'GooglePlusLink',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('GooglePlusLink', 'twentytwenty' ),
                )
            );
            $wp_customize->add_setting(
                'Instagram Link',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.google.com/',
                )
            );

            $wp_customize->add_control(
                'Instagram Link',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Instagram Link', 'twentytwenty' ),
                )
            );

            //
            $wp_customize->add_setting(
                'Facebook Author link',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.facebook.com/',
                )
            );

            $wp_customize->add_control(
                'Facebook Author link',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Facebook Author link', 'twentytwenty' ),
                )
            );

            $wp_customize->add_setting(
                'Twitter Author link',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.twitter.com/',
                )
            );

            $wp_customize->add_control(
                'Twitter Author link',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Twitter Author link', 'twentytwenty' ),
                )
            );
            $wp_customize->add_setting(
                'Author GooglePlusLink',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.google.com/',
                )
            );

            $wp_customize->add_control(
                'Author GooglePlusLink',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Author GooglePlusLink', 'twentytwenty' ),
                )
            );
            $wp_customize->add_setting(
                'Instagram Author Link',
                array(
                    'capability'        => 'edit_theme_options',
                    'default'           => 'https://www.google.com/',
                )
            );

            $wp_customize->add_control(
                'Instagram Author Link',
                array(
                    'type'     => 'text',
                    'section'  => 'options',
                    'label'    => __('Instagram Author Link', 'twentytwenty' ),
                )
            );
            //

            $wp_customize->add_setting( 'img-upload',
                array(
                    'default' => '',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'img-upload',
                    array(
                        'label' => __('img-upload', 'twentytwenty' ),
                        'section' => 'options',
                        'settings' => 'img-upload'
                    )
                )
            );


			/**
			 * Template: Cover Template.
			 */
			$wp_customize->add_section(
				'cover_template_options',
				array(
					'title'       => __( 'Cover Template', 'twentytwenty' ),
					'capability'  => 'edit_theme_options',
					'description' => __( 'Settings for the "Cover Template" page template. Add a featured image to use as background.', 'twentytwenty' ),
					'priority'    => 42,
				)
			);

			/* Overlay Fixed Background ------ */

			$wp_customize->add_setting(
				'cover_template_fixed_background',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'cover_template_fixed_background',
				array(
					'type'        => 'checkbox',
					'section'     => 'cover_template_options',
					'label'       => __( 'Fixed Background Image', 'twentytwenty' ),
					'description' => __( 'Creates a parallax effect when the visitor scrolls.', 'twentytwenty' ),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'cover_template_fixed_background',
				array(
					'selector' => '.cover-header',
					'type'     => 'cover_fixed',
				)
			);

			/* Separator --------------------- */

			$wp_customize->add_setting(
				'cover_template_separator_1',
				array(
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new TwentyTwenty_Separator_Control(
					$wp_customize,
					'cover_template_separator_1',
					array(
						'section' => 'cover_template_options',
					)
				)
			);

			/* Overlay Background Color ------ */

			$wp_customize->add_setting(
				'cover_template_overlay_background_color',
				array(
					'default'           => twentytwenty_get_color_for_area( 'content', 'accent' ),
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cover_template_overlay_background_color',
					array(
						'label'       => __( 'Overlay Background Color', 'twentytwenty' ),
						'description' => __( 'The color used for the overlay. Defaults to the accent color.', 'twentytwenty' ),
						'section'     => 'cover_template_options',
					)
				)
			);

			/* Overlay Text Color ------------ */

			$wp_customize->add_setting(
				'cover_template_overlay_text_color',
				array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cover_template_overlay_text_color',
					array(
						'label'       => __( 'Overlay Text Color', 'twentytwenty' ),
						'description' => __( 'The color used for the text in the overlay.', 'twentytwenty' ),
						'section'     => 'cover_template_options',
					)
				)
			);

			/* Overlay Color Opacity --------- */

			$wp_customize->add_setting(
				'cover_template_overlay_opacity',
				array(
					'default'           => 80,
					'sanitize_callback' => 'absint',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'cover_template_overlay_opacity',
				array(
					'label'       => __( 'Overlay Opacity', 'twentytwenty' ),
					'description' => __( 'Make sure that the contrast is high enough so that the text is readable.', 'twentytwenty' ),
					'section'     => 'cover_template_options',
					'type'        => 'range',
					'input_attrs' => twentytwenty_customize_opacity_range(),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'cover_template_overlay_opacity',
				array(
					'selector' => '.cover-color-overlay',
					'type'     => 'cover_opacity',
				)
			);
		}

		/**
		 * Sanitization callback for the "accent_accessible_colors" setting.
		 *
		 * @static
		 * @access public
		 * @since Twenty Twenty 1.0
		 * @param array $value The value we want to sanitize.
		 * @return array Returns sanitized value. Each item in the array gets sanitized separately.
		 */
		public static function sanitize_accent_accessible_colors( $value ) {

			// Make sure the value is an array. Do not typecast, use empty array as fallback.
			$value = is_array( $value ) ? $value : array();

			// Loop values.
			foreach ( $value as $area => $values ) {
				foreach ( $values as $context => $color_val ) {
					$value[ $area ][ $context ] = sanitize_hex_color( $color_val );
				}
			}

			return $value;
		}

		/**
		 * Sanitize select.
		 *
		 * @param string $input The input from the setting.
		 * @param object $setting The selected setting.
		 * @return string The input from the setting or the default setting.
		 */
		public static function sanitize_select( $input, $setting ) {
			$input   = sanitize_key( $input );
			$choices = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @param bool $checked Whether or not a box is checked.
		 * @return bool
		 */
		public static function sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true === $checked ) ? true : false );
		}

	}

	// Setup the Theme Customizer settings and controls.
	add_action( 'customize_register', array( 'TwentyTwenty_Customize', 'register' ) );

}

/**
 * PARTIAL REFRESH FUNCTIONS
 * */
if ( ! function_exists( 'twentytwenty_customize_partial_blogname' ) ) {
	/**
	 * Render the site title for the selective refresh partial.
	 */
	function twentytwenty_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'twentytwenty_customize_partial_blogdescription' ) ) {
	/**
	 * Render the site description for the selective refresh partial.
	 */
	function twentytwenty_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}

if ( ! function_exists( 'twentytwenty_customize_partial_site_logo' ) ) {
	/**
	 * Render the site logo for the selective refresh partial.
	 *
	 * Doing it this way so we don't have issues with `render_callback`'s arguments.
	 */
	function twentytwenty_customize_partial_site_logo() {
		twentytwenty_site_logo();
	}
}


/**
 * Input attributes for cover overlay opacity option.
 *
 * @return array Array containing attribute names and their values.
 */
function twentytwenty_customize_opacity_range() {
	/**
	 * Filters the input attributes for opacity
	 *
	 * @param array $attrs {
	 *     The attributes
	 *
	 *     @type int $min Minimum value
	 *     @type int $max Maximum value
	 *     @type int $step Interval between numbers
	 * }
	 */
	return apply_filters(
		'twentytwenty_customize_opacity_range',
		array(
			'min'  => 0,
			'max'  => 90,
			'step' => 5,
		)
	);
}
