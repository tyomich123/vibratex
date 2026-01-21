<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Functions which displays html parts of theme on output
 */

/**
 * Opening and close wrappers
 */
if ( !function_exists('vibratex_wrapper_open') ) {

	function vibratex_wrapper_open() {

		echo '<div class="container main-wrapper">';
	}
	add_action( 'vibratex_wrapper_open', 'vibratex_wrapper_open' );

	function vibratex_wrapper_close() {

		echo '</div>';
	}	
	add_action( 'vibratex_wrapper_close', 'vibratex_wrapper_close' );

	function vibratex_content_open() {

		$header_wrapper = vibratex_get_pageheader_wrapper();
		$navbar_layout = vibratex_get_navbar_layout();

		if ( empty($navbar_layout[1]) ) {

			$navbar_layout = [];
			$navbar_layout[1] = 'transparent-full';
		}

		echo '<div class="lte-content-wrapper '.esc_attr($header_wrapper.' lte-layout-'.$navbar_layout[1]).'">';
	}
	add_action( 'vibratex_content_open', 'vibratex_content_open' );

	function vibratex_content_close() {

		echo '</div>';
	}
	add_action( 'vibratex_content_close', 'vibratex_content_close' );

	function vibratex_footer_open() {

		global $wp_query;

		$footer_layout = $default = 'default';

	    if ( function_exists( 'FW' ) ) {

	        $footer_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );   
	    }

	    if ( is_null($footer_layout) ) {

	    	$footer_layout = $default;
	    }

	    $footer_layout = apply_filters ('vibratex_copyright_layout', $footer_layout);

		echo '<div class="lte-footer-wrapper lte-footer-layout-'.esc_attr($footer_layout).'">';
	}
	add_action( 'vibratex_footer_open', 'vibratex_footer_open' );

	function vibratex_footer_close() {

		echo '</div>';
	}
	add_action( 'vibratex_footer_close', 'vibratex_footer_close' );	
}


/**
 * Display html code with topbar section
 */
if ( !function_exists( 'vibratex_the_topbar_block' ) ) {

	function vibratex_the_topbar_block( $navbar_layout ) {

		global $wp_query;

	    if ( function_exists( 'FW' ) ) {

	    	$topbar_layout = 'hidden';
	        $topbar_layout = fw_get_db_settings_option( 'topbar' );

	        if ( $topbar_layout != 'hidden' ) {

	        	$topbar_id = fw_get_db_settings_option( 'topbar-section' );
	        }

        	$topbar_layout_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'topbar-layout' );    	
	        if ( $topbar_layout_page == 'hidden' AND $topbar_layout_page != 'default' ) {

	        	unset($topbar_section);
	        }
	        	else
	        if ( !empty($topbar_layout_page) && $topbar_layout_page != 'default' ) {

	        	$topbar_id = $topbar_layout_page;
        	}

	        if ( !empty($topbar_id) && $topbar_id != 'disabled' ) {

				if ( function_exists('pll_get_post') ) {

					$topbar_id = pll_get_post($topbar_id);
				}
					else
				if ( has_filter('wpml_object_id') ) {

					$topbar_id = apply_filters( 'wpml_object_id', $topbar_id, 'sections' );
				}

	        	if ($topbar_layout == 'desktop') {

	        		$topbar_class = ' hidden-ms hidden-xs hidden-sm';
	        	}
	        		else
	        	if ($topbar_layout == 'desktop-tablet') {

	        		$topbar_class = ' hidden-ms hidden-xs';
	        	}	    
	        		else
	        	if ($topbar_layout == 'mobile') {

	        		$topbar_class = ' visible-ms visible-xs';
	        	}	    	        	    	
	        		else {

	        		$topbar_class = '';
	        	}



	            echo '<div class="lte-topbar-block'.esc_attr($topbar_class).' lte-background-main lte-topbar-before-'.esc_attr($navbar_layout).'"><div class="container">';

          			echo vibratex_get_the_topbar_block($topbar_id);

	            echo '</div></div>';

	            return true;
	        }

	        return false;
	    }

	    return false;
	}

	/**
	 * Generates elementor view ready for display
	 */
	function vibratex_get_the_topbar_block($topbar_id) {

        if ( class_exists("\\Elementor\\Plugin") ) {

                $pluginElementor = \Elementor\Plugin::instance();
                return $pluginElementor->frontend->get_builder_content_for_display($topbar_id);
        }	  		
	}
}

/**
 * Display html code of "before footer" section
 */
if ( !function_exists( 'vibratex_the_before_footer' ) ) {

	function vibratex_the_before_footer() {

		global $wp_query;

		if ( is_404() ) {

			return false;
		}

	    if ( function_exists( 'FW' ) ) {

	    	$layout_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'before-footer-layout' );

	    	// Getting global settings
        	if ( !empty( $layout_page ) AND $layout_page != 'default' ) {

        		$id = $layout_page;
        	}
        		else
        	if ( $layout_page !== '' ) {

        		$id = fw_get_db_settings_option( 'before-footer-section' );
       		}

        	if ( !empty( $id ) ) {

				if ( function_exists('pll_get_post') ) {

					$page_id = pll_get_post($id);
				}
					else
				if ( has_filter('wpml_object_id') ) {

					$page_id = apply_filters( 'wpml_object_id', $id, 'sections' );
				}
					else {

        			$page_id = $id;
				}         		
        	}
        	
	        if ( !empty($page_id) && $page_id != 'disabled' ) {

	            echo '<div class="lte-before-footer-wrapper"><div class="lte-before-footer"><div class="lte-container">';
	            echo vibratex_get_the_before_footer($page_id);
	            echo '</div></div></div>';
	        }        	
	    }

	    return true;
	}


	/**
	 * Generates elementor view ready for display
	 */
	function vibratex_get_the_before_footer($section_id) {

        if ( class_exists("\\Elementor\\Plugin") ) {

                $pluginElementor = \Elementor\Plugin::instance();
                return $pluginElementor->frontend->get_builder_content_for_display($section_id);
        }	  		
	}		

}

/**
 * Display html code with footer subscribe section
 */
if ( !function_exists( 'vibratex_the_subscribe_block' ) ) {
	
	function vibratex_the_subscribe_block() {

		global $wp_query;

	    if ( function_exists( 'FW' ) ) {

	        $copyright_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );
	        if ( $copyright_layout == 'simple' OR $copyright_layout == 'copyright' OR $copyright_layout == 'copyright-transparent' ) {

	        	return false;	
	        }    	

	        if ( is_404() ) {

	        	return false;
	        }

	    	$subscribe_layout = 'visible';

	        $subscribe_layout_global = fw_get_db_settings_option( 'subscribe-section' );
        	$subscribe_id = fw_get_db_settings_option( 'subscribe-section' );

	        if ( !empty($subscribe_id) ) {

		        if ( !empty($subscribe_layout_global) ) {

		        	$subscribe_layout = 'visible';
		        }
		            else
		        if ( $subscribe_layout_global == 'hidden' OR empty($subscribe_layout_global) ) {

		        	$subscribe_layout = 'disabled';
		        }

		        if ( $subscribe_layout != 'disabled' ) {

		        	$subscribe_layout_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'subscribe-layout' );
			        if ( $subscribe_layout_global == 'default' OR $subscribe_layout_page == 'disabled' ) {

			        	$subscribe_layout = $subscribe_layout_page;
			        }

		        	if ( !empty( $subscribe_id ) ) {

						if ( function_exists('pll_get_post') ) {

							$page_id = pll_get_post($subscribe_id);
						}
							else
						if ( has_filter('wpml_object_id') ) {

							$page_id = apply_filters( 'wpml_object_id', $subscribe_id, 'sections' );
						}
							else {

		        			$page_id = $subscribe_id;
						}         		
		        	}
		        }

		        if ( !empty($page_id) AND !empty($subscribe_layout) AND $subscribe_layout != 'disabled' ) {


		            echo '<div class="subscribe-wrapper"><div class="container"><div class="subscribe-block">';
		            echo vibratex_get_the_subscribe_block($page_id);
		            echo '</div></div></div>';
		        }
		        
		    }
	    }

	    return true;
	}

	/**
	 * Generates elementor view ready for display
	 */
	function vibratex_get_the_subscribe_block($subscribe_id) {

        if ( class_exists("\\Elementor\\Plugin") ) {

            $pluginElementor = \Elementor\Plugin::instance();
            return $pluginElementor->frontend->get_builder_content_for_display($subscribe_id);
        }	  		
	}	
}

/**
 * Displays Footer widgets block
 */
if ( !function_exists( 'vibratex_the_footer_elementor' ) ) {

	function vibratex_the_footer_block() {

		global $wp_query;

	    if ( function_exists( 'FW' ) ) {

	    	$copyright_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );

	    	if ( $copyright_layout == 'simple' OR $copyright_layout == 'copyright' OR $copyright_layout == 'copyright-transparent' ) {

	    		return false;
	    	}

	        if ( is_404() ) {

	        	return false;
	        }

	    	$layout = 'visible';

	        $layout_global = fw_get_db_settings_option( 'footer-section' );
        	$section_id = fw_get_db_settings_option( 'footer-section' );

	        if ( !empty($section_id) ) {

		        if ( !empty($layout_global) ) {

		        	$layout = 'visible';
		        }
		            else
		        if ( $layout_global == 'hidden' OR empty($layout_global) ) {

		        	$layout = 'disabled';
		        }

		        if ( $layout != 'disabled' ) {

		        	$layout_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );
			        if ( $layout_global == 'default' OR $layout_page == 'disabled' ) {

			        	$layout = $layout_page;
			        }

		        	if ( !empty( $section_id ) ) {

						if ( function_exists('pll_get_post') ) {

							$page_id = pll_get_post($section_id);
						}
							else
						if ( has_filter('wpml_object_id') ) {

							$page_id = apply_filters( 'wpml_object_id', $section_id, 'sections' );
						}
							else {

		        			$page_id = $section_id;
						}         		
		        	}
		        }


		        if ( !empty($page_id) AND !empty($layout) AND $layout != 'disabled' ) {

		            echo '<div class="footer-wrapper"><div class="lte-container"><div class="footer-block lte-footer-widget-area">';
		            echo vibratex_get_the_footer_block($page_id);
		            echo '</div></div></div>';
		        }
		        
		    }
	    }

	    return true;
	}
	/**
	 * Generates elementor view ready for display
	 */
	function vibratex_get_the_footer_block($section_id) {

        if ( class_exists("\\Elementor\\Plugin") ) {

        	$content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($section_id);
        	$content = apply_filters( 'lte_filter_section', $content, $section_id );
            return $content;
        }
	}		
}


/**
 * Prints Footer widgets block
 */
if ( !function_exists( 'vibratex_the_footer_widgets' ) ) {

	function vibratex_the_footer_widgets( $layout = null ) {

		global $wp_query;

		$footer_class = array();
		if ( function_exists( 'FW' ) ) {

	        $copyright_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );
	        if ( $copyright_layout == 'simple' OR $copyright_layout == 'copyright' OR $copyright_layout == 'copyright-transparent' ) {

	        	return false;
	        }

	        $footer_class[] = 'lte-fw';
		}

        if ( is_404() ) {

        	return false;
        }

	    $vibratex_footer_cols = vibratex_get_footer_cols_num();

	    $vibratex_footer_cols['num'] = apply_filters( 'vibratex_footer_cols_num', $vibratex_footer_cols['num'] );

	    $footer_class[] = 'lte-footer-cols-'.$vibratex_footer_cols['num'];

	    if ( $vibratex_footer_cols['num'] > 0 ): ?>
		<section id="lte-widgets-footer" class="<?php echo esc_attr(implode(' ', $footer_class)); ?>" >
			<div class="container">
				<div class="row row-center-x">
	                <?php
	                for ($x = 1; $x <= 4; $x++): ?>
	                    <?php if ( !isset($vibratex_footer_cols['hidden'][ $x ]) && is_active_sidebar( 'footer-' . $x ) ): ?>
						<div class="<?php echo esc_attr( $vibratex_footer_cols['classes'][$x] ).' '.esc_attr( $vibratex_footer_cols['hidden_mobile'][$x] ).' '.esc_attr( $vibratex_footer_cols['hidden_md'][$x] ); ?> clearfix">    
							<div class="lte-footer-widget-area">
								<?php
	                                dynamic_sidebar( 'footer-' . $x );
	                            ?>
							</div>
						</div>
						<?php endif; ?>
	                <?php
	                endfor; ?>
				</div>
			</div>
		</section>
	    <?php endif;
	}
}


/**
 * Display logo
 */
if ( !function_exists( 'vibratex_get_the_logo' ) ) {

	function vibratex_get_the_logo( $layout = null ) {

		$srcset = '';

		$html = '';
		$html .= '<a class="lte-logo" href="'. esc_url( home_url( '/' ) ) .'">';

		if ( function_exists( 'FW' ) ) {

			$current_scheme =  apply_filters ('vibratex_current_scheme', array());
			
			if ($current_scheme == 'default') {

				$current_scheme = 1;
			}

			$color_schemes = array();
			$color_schemes_ = fw_get_db_settings_option( 'items' );
			if ( !empty($color_schemes_) ) {

				foreach ($color_schemes_ as $v) {

					$color_schemes[$v['slug']] = $v;
				}			
			}

			if ( !empty($current_scheme) AND $current_scheme != 'default' ) {

				if (!empty( $color_schemes[$current_scheme]['logo'])) {

					if ( empty($layout) OR $layout == 'black' ) {

						$logo = $color_schemes[$current_scheme]['logo'];
						$logo_2x = $color_schemes[$current_scheme]['logo_2x'];
					}
						else
					if ( $layout == 'white' ) {

						$logo = $color_schemes[$current_scheme]['logo_white'];
						$logo_2x = $color_schemes[$current_scheme]['logo_white_2x'];
					}

				}
			}

			
			if ( empty($logo) ) {

				if ( empty($layout) OR $layout == 'black') {

					$logo = fw_get_db_settings_option( 'logo' );
					$logo_2x = fw_get_db_settings_option( 'logo_2x' );	
				}
					else
				if ( $layout == 'white' ) {

					$logo = fw_get_db_settings_option( 'logo_white' );	
					$logo_2x = fw_get_db_settings_option( 'logo_white_2x' );	
				}
			}



			if ( !empty($logo) ) {

				$logo = $logo['url'];
			}

			if ( !empty($logo_2x) ) {

				$logo_2x = $logo_2x['url'];
			}

			if ( !empty($logo) AND !empty($logo_2x) ) {

				$srcset = array();
				$srcset[] = $logo .' 1x';
				$srcset[] = $logo_2x .' 2x';

				$srcset = implode(',', $srcset);
			}

		}

		if ( empty( $logo ) ) {

			if ( !empty($layout) AND $layout == 'white' ) {

				$logo = get_template_directory_uri() . '/assets/images/logo-white.png';
			}
				else {

				$logo = get_template_directory_uri() . '/assets/images/logo.png';
			}
		}

		if ( !empty($srcset) ) {

			$html .= '<img src="'. esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '" srcset="'.esc_attr($srcset).'">';
		}
			else {

			$html .= '<img src="'. esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '">';
		}


		$html .= '</a>';

		if ( function_exists('FW') ) {

			$logo_hide = fw_get_db_settings_option( 'logo_hide' );
			if ( empty($logo_hide) ) {

				return $html;
			}
		}
			else {

			return $html;
		}
	}

	function vibratex_the_logo( $layout = null ) {

		echo vibratex_get_the_logo($layout);
	}
}

/**
 * Display H1 header
*/
if ( !function_exists( 'vibratex_the_h1' ) ) {

	function vibratex_the_h1() {

		$title = vibratex_get_the_h1();
		if ( !empty($title) ) echo '<div class="lte-header-h1-wrapper"><h1 class="header">' . wp_kses( $title, 'header' ) . '</h1></div>';
	}
}

/**
 * Prints page overlay, if enabled
 * also adds theme page loader code
 */
if ( !function_exists( 'vibratex_the_pageloader_overlay' ) ) {

	function vibratex_the_pageloader_overlay() {

		if ( function_exists( 'FW' ) && empty($_GET['action']) && empty($_GET['elementor-preview']) ) {

			$pace = fw_get_db_settings_option( 'page-loader' );

			if ( !empty($pace) AND ((!empty($pace['loader']) AND $pace['loader'] != 'disabled') OR 
			   ( !empty($pace) AND $pace['loader'] != 'disabled') ) ) {

				echo '<div id="lte-preloader"></div>';
			}
		}
	}

	add_action( 'wp_body_open', 'vibratex_the_pageloader_overlay' );
}

/**
 * Print copyrights in footer
 */
if ( !function_exists( 'vibratex_the_copyrights' ) ) {

	function vibratex_the_copyrights() {

		if ( function_exists( 'FW' ) ) {

			$vibratex_copyrights = fw_get_db_settings_option( 'copyrights' );

			if ( !empty($vibratex_copyrights) ) {

				echo do_shortcode(wp_kses_post( $vibratex_copyrights));
			}
				else {
				
				echo '<p>'. esc_html__( 'Just-themes &copy; All Rights Reserved - 2023', 'vibratex' ) .'</p>';
			}
		}
			else {

			echo '<p>'. esc_html__( 'Just-themes &copy; All Rights Reserved - 2023', 'vibratex' ) .'</p>';
		}
	}
	
}


/**
 * Footer copyright block
 */
if ( !function_exists( 'vibratex_the_copyrights_section' ) ) {

	function vibratex_the_copyrights_section() {

		global $wp_query;

		$default = 'default';
	    $copyright_layout = $default;
	    if ( function_exists( 'FW' ) ) {

	        $copyright_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );

	        $vibratex_logo = fw_get_db_settings_option( 'logo' );

	        if ( $copyright_layout == 'default' ) {
		    
		    	$copyright_layout = fw_get_db_settings_option( 'footer-layout-default' );
		    }
	    }

	    $copyright_layout = apply_filters ('vibratex_copyright_layout', $copyright_layout);

	    if ( is_null($copyright_layout) ) {

	    	$copyright_layout = $default;
	    }

	    if ( $copyright_layout != 'disabled'):

		?>
		<footer class="copyright-block <?php echo 'copyright-layout-'.esc_attr($copyright_layout); ?>">
			<div class="container">
	            <?php

					if ( !empty($copyright_layout) AND $copyright_layout == 'simple' ) {

						if ( !empty($vibratex_logo) ) {

							echo '<span class="logo-footer">'.wp_get_attachment_image( $vibratex_logo['attachment_id'], 'full' ).'</span>';
						}

						vibratex_the_social_footer();
					}

	                vibratex_the_copyrights();
	            ?>
			</div>
		</footer>
		<?php
		endif;
	}
}

/**
 * Displays go top icon
 */
if ( !function_exists( 'vibratex_the_go_top' ) ) {

	function vibratex_the_go_top() {

		if ( function_exists( 'FW' ) ) {

           	$class = array();
    		$go_top = fw_get_db_settings_option( 'go_top_visibility');
	        $go_top_pos = fw_get_db_settings_option( 'go_top_pos');
	        $go_top_img = fw_get_db_settings_option( 'go_top_img');
	        $go_top_icon = fw_get_db_settings_option( 'go_top_icon');
	        $go_top_text = fw_get_db_settings_option( 'go_top_text');
	        $go_top_rotate = fw_get_db_settings_option( 'go_top_rotate');

			if ( $go_top != 'hidden' ) {

				$class[] = $go_top_pos;

        		if ( $go_top == 'desktop' ) {

        			$class[] = 'hidden-xs hidden-ms';
        		}	
        			else
        		if ( $go_top == 'mobile' ) {

        			$class[] = 'visbile-xs visible-ms';
       			}

	            if ( !empty($go_top_img) ) {
	                
	                $class[] = 'lte-go-top-img';
	            }

	            if ( !empty($go_top_icon) ) {
	                
	                $class[] = 'lte-go-top-icon';
	            }

	            if ( !empty($go_top_rotate) ) {
	                
	                $class[] = 'lte-go-top-rotate';
	            }	            

            	echo '<a href="#" class="lte-go-top '.esc_attr(implode(' ', $class)).'">';

            		if ( !empty($go_top_img) ) {

                		echo wp_get_attachment_image( $go_top_img['attachment_id'], 'full' );
                	}

                	if ( !empty($go_top_icon) AND $go_top_icon['type'] == 'custom-upload' ) {

            			echo '<span class="go-top-icon-v2 go-top-icon-custom"><img src="'.esc_url($go_top_icon['url']).'"></span>';
            		}

                	if ( !empty($go_top_icon) AND $go_top_icon['type'] != 'none' ) {

            			echo '<span class="go-top-icon-v2 '.esc_attr($go_top_icon['icon-class']).'"></span>';
            		}

            		if ( !empty( $go_top_text ) ) {

                		echo '<span class="go-top-header">'.esc_html($go_top_text).'</span>';
                	}

            	echo '</a>';
			}
		}
	}

	add_action( 'wp_footer', 'vibratex_the_go_top' );
}

/**
 * Blog related posts
 */
if ( !function_exists( 'vibratex_related_posts' ) ) {

	function vibratex_related_posts($id) {

		if ( !function_exists('FW') ) {

			return false;
		}

		$tags = wp_get_post_tags($id);

		if ( !empty( $tags ) ) {

			$tags_in = array();
			foreach ( $tags as $t ) {

				$tags_in[] = $t->term_id;
			}

			$args = array(

				'tag__in' => $tags_in,
				'post__not_in' => array($id),
				'posts_per_page' => 3,
				'meta_query' => array(array('key' => '_thumbnail_id')),
				'ignore_sticky_posts' => 1
			);

			set_query_var( 'vibratex_layout', 'three-cols' );

			$my_query = new WP_Query($args);
			if ( $my_query->have_posts() ) {

				set_query_var( 'vibratex_featured_disabled', true );
				echo '<div class="lte-related blog blog-block layout-two-cols">';
				echo '<div class="lte-heading">';
					echo sprintf(
 					'<h2 class="lte-header">%1$s<span>%2$s</span></h2>',
 					esc_html__( 'Related ', 'vibratex' ),
 					esc_html__( 'posts', 'vibratex' )
 				);
				echo '</div>';

				echo '<div class="row">';

				$class = $class_add = '';	
				if ( $my_query->found_posts == 3 ) {

					$class = 'col-xl-4 col-lg-4 col-md-6';
				}
					else {

					$class = 'col-xl-4 col-lg-6 col-md-6';
				}

				set_query_var( 'lte_sc_excerpt_size', 14 );
				
				$x = 0;
				while ($my_query->have_posts()) {

					$x++;
					$my_query->the_post();

					$class_add = '';
					if ( $x == 3) {

						$class_add = ' visible-xl hidden-lg hidden-md';
					}

					echo '<div class="'.esc_attr($class.$class_add).'">';
						get_template_part( 'tmpl/post-formats/list' );				
					echo '</div>';
				}

				echo '</div>';

				echo '</div>';				
			}

			wp_reset_postdata();
			set_query_var( 'vibratex_featured_disabled', false );
			set_query_var( 'vibratex_layout', false );
		}
	}
}

/**
 * Blog post author info block
 */
if ( !function_exists( 'vibratex_author_bio' ) ) {

	function vibratex_author_bio( ) {
	 
		global $post;
	 
		$content = '';

		if ( is_single() && isset( $post->post_author ) ) {
	 
			$display_name = get_the_author_meta( 'display_name', $post->post_author );

	 		if ( empty( $display_name ) ) {

	 			$display_name = get_the_author_meta( 'nickname', $post->post_author );
	 		}
	 
			$user_description = get_the_author_meta( 'user_description', $post->post_author );

			// No author info, nothing no show
			if ( empty( $user_description ) ) {

				return false;
			}
	 
			$user_website = get_the_author_meta('url', $post->post_author);
	 
			$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

			$author_details = '';

			if ( ! empty( $user_description ) ) {

				$author_details .= '<p class="author-details">' . wp_kses( nl2br( $user_description ), 'header' ). '</p>';
			}
	  
			$author_details .= '<p class="author-links">';

				if ( ! empty( $user_website ) ) {
				 
					$author_details .= '<a href="' . esc_url( $user_website ) .'" class="btn btn-main color-hover-white btn-xs" target="_blank" rel="nofollow">'. esc_html__( 'Website', 'vibratex' ) . '</a>';
				}

				$author_details .= '<a href="'. esc_url( $user_posts ) .'" class="lte-btn btn-xs btn-main">'. esc_html__( 'All posts', 'vibratex' ) . '</a>';  
		 
			$author_details .= '</p>';

	 
			$content = '<section class="lte-author-bio">';
				$content .= '<div class="author-image">';
					$content .= get_avatar( get_the_author_meta('user_email'), 210 );
	  			 
				$content .= '</div>';
				$content .= '<div class="author-info">';
					if ( ! empty( $display_name ) ) {

						$content .= '<span><p class="author-name">'. esc_html__( 'Author', 'vibratex' ) . '</p><h5>'. $display_name . '</h5></span>';
					}				
					$content .= $author_details;
				$content .= '</div>';
			$content .= '</section>';
		}

		echo wp_kses( $content, 'bio' );
	}
}

/**
 * Displays post top info
 */

if ( !function_exists( 'vibratex_get_the_post_headline' ) ) {

	function vibratex_get_the_post_headline( $headline = 'inline' ) {

		echo '<div class="lte-post-headline">';

	    	echo '<ul class="lte-post-info">';

			    echo '<li class="lte-post-category">';			    
			    	vibratex_get_the_cats_archive();
			    echo '</li>';

			    echo '<li class="lte-post-date">';
					vibratex_the_blog_date();
				echo '</li>';
				
			echo '</ul>';

		echo '</div>';
	}

	function vibratex_get_the_post_headline_left() {

		echo '<div class="lte-post-headline">';

		echo '<div class="lte-user">'.get_avatar( get_the_author_meta('user_email'), 50 ).'<span class="info">'. esc_html__( 'by', 'vibratex' ) . ' ' .get_the_author_link().'</span></div>';		

			vibratex_get_the_cats_archive();
    
		echo '</div>';
	}	
}

/**
 * Displays blog date and additioanl information
 */

if ( !function_exists( 'vibratex_the_blog_date' ) ) {

	function vibratex_the_blog_date( $args = array() ) {

		echo '<a href="'.esc_url(get_the_permalink()).'" class="lte-date fa"><span class="dt">'.get_the_date().'</span></a>';
	}
}

if ( !function_exists( 'vibratex_the_blog_time' ) ) {

	function vibratex_the_blog_time( $args = array() ) {

		echo '<span class="lte-time fa">'.get_the_time().'</span>';
	}
}

if ( !function_exists( 'vibratex_the_blog_date_large' ) ) {

	function vibratex_the_blog_date_large( $args = array() ) {

		echo '<span class="lte-date-large"><span class="lte-date-day">'.get_the_date('d').'</span><span class="lte-date-my">'.get_the_date('M').'</span></span>';
	}
}



/**
 * Displays cats for posts archive
 */

if ( !function_exists( 'vibratex_get_the_cats_archive' ) ) {

	function vibratex_get_the_cats_archive() {

		if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && vibratex_categorized_blog() ) {

			$categories = get_the_category();
			
			echo '<span class="lte-cats">';
				if ( !empty($categories) )  {

					echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				}
			echo '</span>';
		}

	}
}

/**
 * Displays Blog post info icons block
 * 
 */
if ( !function_exists( 'vibratex_the_post_info' ) ) {

	function vibratex_the_post_info( $fullInfo = 'hidden' ) {

		$authorby = false;
		$wrapper = true;
		$showText = true;
		$fullInfo = false;

	    if ( $wrapper ) {

	    	echo '<ul class="lte-post-info">';
	    }

	    if ( !empty($authorby) ) {

			echo '<li class="lte-user"><span class="info">'. get_the_author_link() .'</span></li>';
		}

	    echo '<li class="lte-post-date">';

			vibratex_the_blog_date();

		echo '</li>';

	    echo '<li class="lte-post-time">';

			vibratex_the_blog_time();

		echo '</li>';

		

		if ( function_exists( 'pvc_post_views' ) && $fullInfo ) {

			$count = (int)(strip_tags( pvc_post_views(get_the_ID(), false) ));

			if ( !empty($showText) ) {

				echo '<li class="lte-icon-views">
					<span>' . esc_html( $count ) . ' ' . _n( 'View', 'Views', (int)($count), 'vibratex' ) .'</span>
				</li>';
			}
				else {

				echo '<li class="lte-icon-views">
					<span>' . esc_html( $count ) .'</span>
				</li>';
			}
		}
	    
	    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

	    	echo '<li class="lte-icon-comments">';

	    	if ( !empty($showText) ) {

		    	echo '<span>'.get_comments_number_text( 
		    		esc_html__('0 comments', 'vibratex'), esc_html__('1 comment', 'vibratex'), esc_html__('% comments', 'vibratex')
		    	).'</span>';
	    	}
	    		else {

	    		echo '<span>'.get_comments_number().'</span>';
    		}

	    	echo '</li>';
	    }

	    if ( $wrapper ) {

	    	echo '</ul>';
	    }

	}
}

/**
 * Displays Navigation bar icons
 * 
 */
if ( !function_exists( 'vibratex_get_the_navbar_icons' ) ) {

	function vibratex_get_the_navbar_icons( $layout = null, $mobile = false ) {

		global $user_ID;

		if ( !function_exists( 'FW' ) ) { return false; }

		$basket_icon = fw_get_db_settings_option( 'basket-icon' );
		$icons = fw_get_db_settings_option( 'navbar-icons' );
		$basket_only = false;

		if ( $mobile ) {

		}
			else
		if ( $layout == 'basket-only' AND $basket_icon == 'mobile' ) {

			$basket_only = true;
		}

		$icons_to_show = array();
		if ( is_array($layout) AND !empty($layout['icons']) ) {

			$icons_to_show = explode(',', $layout['icons']);
		}

		$items = '';
		if ( !empty($icons) ) {

			foreach ($icons as $item) {

				if ( !empty($icons_to_show) AND !in_array($item['type']['type_radio'], $icons_to_show) ) continue;

				if ( !empty( $basket_only ) AND $item['type']['type_radio'] != 'basket' ) continue;

				$li_class = '';
				if ( empty($mobile) AND empty( $basket_only ) ) {
				}

				$custom_icon = '';
				if ( $item['icon-type']['icon_radio'] == 'fa' AND !empty($item['icon-type']['fa']) ) {

					$custom_icon = $item['icon-type']['fa']['icon_v2']['icon-class'];
				}

				if ( $item['type']['type_radio'] == 'search') {

					if ( empty( $custom_icon ) ) { $custom_icon = 'fa fa-search'; }

					$header = '';
					if ( !empty($item['icon-header']) ) {

						if ( !empty($item['icon-header-text']) ) $header = $item['icon-header-text']; else $header = esc_html__( 'Search', 'vibratex' );
					}

					if ( !empty($mobile) ) {

						$id = ' id="lte-top-search-ico-mobile" ';
						$close = '';
					}	
						else {

						$id = ' id="lte-top-search-ico" ';
						$close = '<a href="#" class="lte-top-search-ico-close " aria-hidden="true">&times;</a>';
					}

					$items .= '
					<li class="lte-nav-search '.esc_attr($li_class).'">
						<div class="lte-top-search-wrapper" data-source="'.esc_attr($item['type']['search']['source']).'" data-base-href="'. esc_url( home_url( '/' ) ) .'">
							<a href="#" '.$id.' class="lte-top-search-ico '. esc_attr($custom_icon) .'" aria-hidden="true"></a>
							'.$close.'
							<input placeholder="'.esc_attr__( 'Search', 'vibratex' ).'" value="'. esc_attr( get_search_query() ) .'" type="text">
						</div>';
	
						if ( !empty($header) ) {

							$items .= '<span class="lte-header">'.esc_html( $header ).'</span>';
						}
					$items .= '</li>';
				}

				if ( $item['type']['type_radio'] == 'basket' AND vibratex_is_wc('wc_active')) {

					if ( empty( $custom_icon ) ) { $custom_icon = 'fas fa-shopping-bag'; }

					$header = '';
					if ( !empty($item['icon-header']) ) {

						if ( !empty($item['icon-header-text']) ) $header = $item['icon-header-text']; else $header = esc_html__( 'Cart', 'vibratex' );
					}

					$items .= '<li class="lte-nav-cart '.esc_attr($li_class).'">
							<div class="cart-navbar">
								<a href="'. wc_get_cart_url() .'" class="lte-cart lte-cart-type-'.esc_attr($item['type']['basket']['count']).'" title="'. esc_attr__( 'View your shopping cart', 'vibratex' ). '">';

									$items .= '<span class="lte-icon-cart '. esc_attr( $custom_icon ) .'"></span>';

									if ( !empty($header) ) {

										$items .= '<span class="lte-header">'.esc_html( $header ).'</span>';
									}

									if ( in_array($item['type']['basket']['count'], array('show', 'show-full')) AND function_exists('vibratex_get_mini_cart_count') ) {

										$items .= vibratex_get_mini_cart_count();
									}

								$items .= '</a>
							</div>
							';

							if ( function_exists('lte_get_the_minicart') AND !empty($item['type']['basket']['mini-cart']) ) {

								$items .= '<div class="lte-minicart">'.lte_get_the_minicart().'</div>';
							}

						$items .= '</li>';
				}

				if ( $item['type']['type_radio'] == 'profile' ) {

					if ( empty( $custom_icon ) ) { $custom_icon = 'fa fa-user-circle'; }

					$header = '';
					if ( !empty($item['icon-header']) ) {

						if ( !empty($item['icon-header-text']) ) $header = $item['icon-header-text']; else $header = esc_html__( 'Login', 'vibratex' );
					}
					$userInfo = get_userdata($user_ID);

					$items .= '<li class="lte-nav-profile menu-item-has-children '.esc_attr($li_class).'">
							<a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ) .'"><span class="fa '. esc_attr($custom_icon) .'"></span>';

								if ( !empty($header) ) {

									$items .= '<span class="lte-header">'.wp_kses_post( $header ).'</span>';
								}							

						$items .= '</a></li>';
				}

				if ( $item['type']['type_radio'] == 'social' AND ( !empty($custom_icon) OR $item['icon-type']['fa']['icon_v2']['type'] == 'custom-upload' ) )   {

					if ( !empty($item['type']['social']['text']) ) {

						$li_class .= ' has-header';
					}

					$items .= '<li class="lte-nav-social '.esc_attr($li_class).'">
							<a href="'. esc_url( $item['type']['social']['href'] ) .'" class="'. esc_attr($custom_icon) .'" target="_blank">';

						if ( $item['icon-type']['fa']['icon_v2']['type'] == 'custom-upload' AND !empty($item['icon-type']['fa']['icon_v2']['url']) ) {

							$items .= '<img src="'.esc_url($item['icon-type']['fa']['icon_v2']['url']).'">';
						}

						if ( !empty($item['type']['social']['text']) ) {

							$items .= '<span class="lte-header">'.wp_kses_post( lte_string_parse( $item['type']['social']['text'] ) ).'</span>';
						}

					$items .= '</a></li>';
				}

				if ( $item['type']['type_radio'] == 'button' AND !empty($item['type']['button']['text']) ) {

					$items .= '<li class="lte-nav-button '.esc_attr($li_class).'">
							<a href="'. esc_url( $item['type']['button']['href'] ) .'" class="lte-btn btn-xs">';

							$items .= '<span class="lte-btn-inner">';
								$items .= '<span class="lte-btn-before"></span>';
								$items .= esc_html($item['type']['button']['text']);
								$items .= '<span class="lte-btn-after"></span>';
							$items .= '</span>';

					$items .= '</a>
						</li>';
				}					
			}
		}


		if ( !empty($items) ) {

			if ( empty( $mobile ) ) {

				return '<div class="lte-navbar-icons"><ul>'.$items.'</ul></div>';
			}
				else {

				return '<div><ul>'.$items.'</ul></div>';
			}
		}
	}

	function vibratex_the_navbar_icons( $layout = null, $mobile = false ) {

		echo vibratex_get_the_navbar_icons( $layout, $mobile );
	}
}

if ( !function_exists( 'vibratex_get_the_navbar_icons_add' ) ) {

	function vibratex_the_navbar_search($layout) {

		$items = '';

		$items .= '
		<li class="lte-nav-search">
			<div class="lte-top-search-wrapper" data-source="woocommerce" data-base-href="'. esc_url( home_url( '/' ) ) .'">
				<a href="#" id="lte-top-search-ico-only" class="lte-top-search-ico-only" aria-hidden="true"></a>
				<input placeholder="'.esc_attr__( 'Search', 'vibratex' ).'" value="'. esc_attr( get_search_query() ) .'" type="text">
			</div>';
		$items .= '</li>';

		return '<div class="lte-navbar-icons lte-navbar-search-only"><ul>'.$items.'</ul></div>';					
	}
}

/**
 * Display Icon on the left of navbar
 */
if ( !function_exists( 'vibratex_get_the_navbar_icons_add' ) ) {
	
	function vibratex_get_the_navbar_icons_add() {

		if ( !function_exists( 'FW' ) ) { return false; }

		$icons = fw_get_db_settings_option( 'navbar-add-icons' );

		$items_escaped = '';
		if ( !empty($icons) ) {

			foreach ($icons as $item) {

				$li_class = array();
				if ( !empty($item['inner-only'] ) ) {

					$li_class[] = 'lte-inner-only';
				}

				if ( $item['type'] == 'social' AND !empty($item['icon'])) {

					$items_escaped .= '
						<li class="lte-nav-social '.implode(' ', $li_class).'"><a href="'. esc_url( $item['href'] ) .'" class="'. esc_attr($item['icon']['icon-class']) .'" target="_blank">';

						if ( !empty($item['text']) ) {

							$items_escaped .= '<span class="lte-header">'.esc_html($item['text']).'</span>';
						}

					$items_escaped .= '</a></li>';
				}

				if ( $item['type'] == 'button' AND !empty($item['text']) ) {

					$items_escaped .= '
						<li class="lte-nav-button '.implode(' ', $li_class).'"><a href="'. esc_url( $item['href'] ) .'" class="lte-btn btn-black ">';

							$items_escaped .= '<span class="lte-btn-inner">';
								$items_escaped .= '<span class="lte-btn-before"></span>';
								$items_escaped .= esc_html($item['text']);
								$items_escaped .= '<span class="lte-btn-after"></span>';
							$items_escaped .= '</span>';

					$items_escaped .= '</a></li>';
				}					
			}
		}

		if ( !empty($items_escaped) ) {

			return '<ul class="lte-navbar-icons-add">'.$items_escaped.'</ul>';
		}
	}

	function vibratex_the_navbar_icons_add() {

		echo vibratex_get_the_navbar_icons_add();
	}
}

/**
 * Get page breadcrumbs
 */
if ( !function_exists( 'vibratex_the_breadcrumbs' ) ) {

	function vibratex_the_breadcrumbs() {

		if ( function_exists( 'bcn_display' ) && !is_front_page() ) {

			echo '<ul class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">';
			bcn_display_list();
			echo '</ul>';
		}
	}
}



/**
 * Tagline in header
 */
if ( !function_exists( 'vibratex_the_tagline_header' ) ) {

	function vibratex_the_tagline_header() {

		if ( shortcode_exists('lte-header-tagline') ) {

			echo do_shortcode('[lte-header-tagline]');
		}
	}

	function vibratex_the_tagline_header_short() {

		if ( shortcode_exists('lte-header-tagline') ) {

			echo do_shortcode('[lte-header-tagline type="short"]');
		}
	}	
}

/**
 * Social icons in header
 */
if ( !function_exists( 'vibratex_the_social_header' ) ) {

	function vibratex_the_social_header() {

		if ( function_exists( 'FW' ) ) {
			
			$vibratex_social = fw_get_db_settings_option( 'header-social' );
			$vibratex_social_text = fw_get_db_settings_option( 'header-social-text' );

			if ( $vibratex_social == 'enabled' ) {

				echo do_shortcode('[lte-social]');
			}
		}
	}
}
	
/**
 * Social icons in footer
 */
if ( !function_exists( 'vibratex_the_social_footer' ) ) {

	function vibratex_the_social_footer() {

		// In this theme we are using same markup as a header
		vibratex_the_social_header();
	}
}		

/**
 * Social icons in navbar
 */
if ( !function_exists( 'vibratex_the_navbar_social' ) ) {

	function vibratex_the_navbar_social() {

		global $wp_query;

		if ( function_exists( 'FW' ) ) {

			$social_header = fw_get_db_settings_option( 'social-header' );

			echo '<div class="lte-navbar-social">';
			
				if ( !empty($social_header) ) {

					echo do_shortcode('[lte-social text-before="'.esc_attr($social_header).'"]');
				}
					else {

					echo do_shortcode('[lte-social]');
				}

			echo '</div>';
		}
	}
}


/**
 * Social icons in navbar
 */
if ( !function_exists( 'vibratex_the_dots_animation' ) ) {

	function vibratex_the_dots_animation() {

		echo '<span class="lte-wc-dots-wrapper"></span>';
	}
}

