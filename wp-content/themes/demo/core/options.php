<?php
    if ( ! class_exists( 'Tich_Theme_Options' ) ) {

        /* class tich_Theme_Options sẽ chứa toàn bộ code tạo options trong theme từ Redux Framework */
	  	class Tich_Theme_Options {

		  	/* Tái tạo các biến có trong Redux Framework */
			public $args = array();
			public $sections = array();
			public $theme;
			public $ReduxFramework;

			/* Load Redux Framework */
			 public function __construct() {
			 
			     if ( ! class_exists( 'ReduxFramework' ) ) {
			         return;
			     }
			 
			     // This is needed. Bah WordPress bugs.  <img draggable="false" class="emoji" alt="😉" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			     if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
			         $this->initSettings();
			     } else {
			         add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			     }
			 
			 }

			 

			/**
		Thiết lập cho method setAgruments
		Method này sẽ chứa các thiết lập cơ bản cho trang Options Framework như tên menu chẳng hạn
		**/
		public function setArguments() {
		    $theme = wp_get_theme(); // Lưu các đối tượng trả về bởi hàm wp_get_theme() vào biến $theme để làm một số việc tùy thích.
		    $this->args = array(
	            // Các thiết lập cho trang Options
	            'opt_name'  => 'tp_options', // Tên biến trả dữ liệu của từng options, ví dụ: tp_options['field_1']
	            'display_name' => $theme->get( 'Name' ), // Thiết lập tên theme hiển thị trong Theme Options
	            'menu_type'          => 'menu',
		        'allow_sub_menu'     => true,
		        'menu_title'         => __( 'TP Theme Options', 'tich' ),
		        'page_title'         => __( 'TP Theme Options', 'tich' ),
		        'dev_mode' => false,
		        'customizer' => true,
		        'menu_icon' => '', // Đường dẫn icon của menu option
		        // Chức năng Hint tạo dấu chấm hỏi ở mỗi option để hướng dẫn người dùng */
		        'hints'              => array(
		            'icon'          => 'icon-question-sign',
		            'icon_position' => 'right',
		            'icon_color'    => 'lightgray',
		            'icon_size'     => 'normal',
		            'tip_style'     => array(
		                'color'   => 'light',
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
		        ), // end Hints
		        'google_api_key' => 'AIzaSyCkNipN0k2ulvnNz0u9y11YdoL9S-XNDtI',

		    );

		}

		/**
			Thiết lập các method muốn sử dụng
                Method nào được khai báo trong này thì cũng phải được sử dụng
            **/
			public function initSettings() {
			 
			    // Set the default arguments
			    $this->setArguments();
			 
			    // Set a few help tabs so you can see how it's done
			    $this->setHelpTabs();
			 
			    // Create the sections and fields
			    $this->setSections();
			 
			    if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
			        return ;
			    }
			 
			    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
			}

		/**
		Thiết lập khu vực Help để hướng dẫn người dùng
		**/
		public function setHelpTabs() {
		 
		    // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
		    $this->args['help_tabs'][] = array(
		        'id'      => 'redux-help-tab-1',
		        'title'   => __( 'Theme Information 1', 'tich' ),
		        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'tich' )
		    );
		 
		    $this->args['help_tabs'][] = array(
		        'id'      => 'redux-help-tab-2',
		        'title'   => __( 'Theme Information 2', 'tich' ),
		        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'tich' )
		    );
		 
		    // Set the help sidebar
		    $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'tich' );
		}


		/**
		Thiết lập từng phần trong khu vực Theme Options
		mỗi section được xem như là một phân vùng các tùy chọn
		Trong mỗi section có thể sẽ chứa nhiều field
		**/
		public function setSections() {
		 
		    // Home Section
		    $this->sections[] = array(
		        'title'  => __( 'Header', 'tich' ),
		        'desc'   => __( 'All of settings for header on this theme.', 'tich' ),
		        'icon'   => 'el-icon-home',
		        'fields' => array(
				    // Mỗi array là một field
				    array(
				        'id'       => 'logo-on',
				        'type'     => 'switch',
				        'title'    => __( 'Enable Image Logo', 'tich' ),
				        'compiler' => 'bool', // Trả về giá trị kiểu true/false (boolean)
				        'desc'     => __( 'Do you want to use image as a logo?', 'tich' ),
				        'on' => __( 'Enabled', 'tich' ),
				        'off' => __('Disabled')
				    ),
				 
				    array(
				        'id'       => 'logo-image',
				        'type'     => 'media',
				        'title'    => __( 'Logo Image', 'tich' ),
				        'desc'     => __( 'Image that you want to use as logo', 'tich' ),
				    ),
				)
		    ); // end section

		    // Typography Section
			$this->sections[] = array(
			    'title' => __( 'Typography', 'tich' ),
			    'desc' => __( 'All of settings for themes typography', 'tich' ),
			    'icon' => 'el-icon-font',
			    'fields' => array(
			    	// Main typography
				    array(
				        'id' => 'typo-main',
				        'type' => 'typography',
				        'title' => 'Main Typography',
				        'google'      => true,
				        'output' => array( '.entry-content' ),
				        'text-transform' => true,
				        'default' => array(
				            'font-size' => '14px',
				            'font-family' => 'Helvetica Neue, Arial, sans-serif',
				            'font-color' => '#333333',
				        ),
				    ),
				    // Main typography
				    array(
				        'id' => 'typo-title',
				        'type' => 'typography',
				        'title' => 'Title Typography',
				        'output' => array( '.entry-title' ),
				        'text-transform' => true,
				        'default' => array(
				            'font-size' => '20px',
				            'font-family' => 'Helvetica Neue, Arial, sans-serif',
				            'font-color' => '#333333',
				        ),
				    ),
			    )
			); // end section

			// Home Section
		    $this->sections[] = array(
		        'title'  => __( 'Footer', 'tich' ),
		        'desc'   => __( 'Settings for footer on this theme.', 'tich' ),
		        'icon'   => 'el-chevron-down',
		        'fields' => array(
				    // Mỗi array là một field
				    array(
				        'id'       => 'editor-text',
				        'type'     => 'editor',
				        'title'    => __( 'Description', 'tich' ),
				        'compiler' => 'bool', // Trả về giá trị kiểu true/false (boolean)
				        'desc'     => __( 'Text show in footer', 'tich' ),
				        'default' => 'Copyright',
				    ),
				 
				)
		    ); // end section

		     // Slider Section
		    $this->sections[] = array(
		        'title'  => __( 'Slider', 'tich' ),
		        'desc'   => __( 'All of settings for slider on this theme.', 'tich' ),
		        'icon'   => 'el-icon-home',
		        'fields'     => array(

		            array(
		                'id'            => 'opt-slider-label',
		                'type'          => 'slider',
		                'title'         => __( 'Slider Example 1', 'tich' ),
		                'subtitle'      => __( 'This slider displays the value as a label.', 'tich' ),
		                'desc'          => __( 'Slider description. Min: 1, max: 500, step: 1, default value: 250', 'tich' ),
		                'default'       => 250,
		                'min'           => 1,
		                'step'          => 1,
		                'max'           => 500,
		                'display_value' => 'label'
		            ),
		            array(
		                'id'            => 'opt-slider-text',
		                'type'          => 'slider',
		                'title'         => __( 'Slider Example 2 with Steps (5)', 'tich' ),
		                'subtitle'      => __( 'This example displays the value in a text box', 'tich' ),
		                'desc'          => __( 'Slider description. Min: 0, max: 300, step: 5, default value: 75', 'tich' ),
		                'default'       => 75,
		                'min'           => 0,
		                'step'          => 5,
		                'max'           => 300,
		                'display_value' => 'text'
		            ),
		            array(
		                'id'            => 'opt-slider-select',
		                'type'          => 'slider',
		                'title'         => __( 'Slider Example 3 with two sliders', 'tich' ),
		                'subtitle'      => __( 'This example displays the values in select boxes', 'tich' ),
		                'desc'          => __( 'Slider description. Min: 0, max: 500, step: 5, slider 1 default value: 100, slider 2 default value: 300', 'tich' ),
		                'default'       => array(
		                    1 => 100,
		                    2 => 300,
		                ),
		                'min'           => 0,
		                'step'          => 5,
		                'max'           => '500',
		                'display_value' => 'select',
		                'handles'       => 2,
		            ),
		            array(
		                'id'            => 'opt-slider-float',
		                'type'          => 'slider',
		                'title'         => __( 'Slider Example 4 with float values', 'tich' ),
		                'subtitle'      => __( 'This example displays float values', 'tich' ),
		                'desc'          => __( 'Slider description. Min: 0, max: 1, step: .1, default value: .5', 'tich' ),
		                'default'       => .5,
		                'min'           => 0,
		                'step'          => .1,
		                'max'           => 1,
		                'resolution'    => 0.1,
		                'display_value' => 'text'
		            ),

		        ),
				
		    ); // end section

		     // Slider Section
		    $this->sections[] = array(
		        'title'  => __( 'Upload Slider', 'tich' ),
		        'desc'   => __( 'All of settings for slider on this theme.', 'tich' ),
		        'icon'   => 'el-icon-home',
		        'fields' => array(
				    array(
				    	'title' => 'Home Slider',
				    	'id' => 'home-slider',
				    	'type' => 'slides',
				    ),
				),
				
		    ); // end section

			
		}

	}
              /* Kích hoạt class tich_Theme_Options vào Redux Framework */
    global $reduxConfig;
    $reduxConfig = new Tich_Theme_Options();
  }