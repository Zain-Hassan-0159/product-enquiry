<?php

/**
 * Seven Custom Elementor Widgets
 *
 * @package           Product Enquiry
 * @author            Zain Hassan
 *
 */
   


/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class custom_enquiry_widget extends \Elementor\Widget_Base {



	/**
	 * Get widget name.
	 *
	 * Retrieve company widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Product Enquiry';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve company widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product Enquiry', 'dokan' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve company widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-wordpress';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the company of categories the company widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'favorites' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the company of keywords the company widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'product', 'enquiry', 'product enquiry' ];
	}

	/**
	 * Register company widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Prduct Enquiry Widget', 'dokan' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'heading_text',
			[
				'label' => esc_html__( 'Heading Text', 'dokan' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Product Enquiry', 'dokan' ),
				'placeholder' => esc_html__( 'Type your text here', 'dokan' ),
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Heading Color', 'dokan' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} h3' => 'color: {{#000}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} h3',
			]
		);

        $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'dokan' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'dokan' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'dokan' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'dokan' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Button Background Color', 'dokan' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FF0909',
				'selectors' => [
					'{{WRAPPER}} .dokan-btn-theme' => 'background-color: {{#FF0909}}; border-color: {{#FF0909}};',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'dokan' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Submit Enquiry', 'dokan' ),
				'placeholder' => esc_html__( 'Type your text here', 'dokan' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'dokan' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Submit Enquiry', 'dokan' ),
				'placeholder' => esc_html__( 'Type your text here', 'dokan' ),
			]
		);

		$this->add_control(
			'phone_text',
			[
				'label' => esc_html__( 'Phone Field Name', 'dokan' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact No...', 'dokan' ),
				'placeholder' => esc_html__( 'Type your text here', 'dokan' ),
			]
		);

		$this->add_control(
			'message_text',
			[
				'label' => esc_html__( 'Enquiry Field Name', 'dokan' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'block' => true,
				'default' => esc_html__( 'Details about your enquiry...', 'dokan' ),
				'placeholder' => esc_html__( 'Type your text here', 'dokan' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render company widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		// echo "<pre>";
		// print_r($settings['company_profile_image']);
        global $post;
        $guest_enquiry = dokan_get_option( 'enable_guest_user_enquiry', 'dokan_selling', 'on' );
        ?>

        <div class="row" style="margin: 0;">
            <div class="col-md-10">
                <form id="dokan-product-enquiry" method="post" class="form" role="form" style="text-align: <?php echo esc_attr( $settings['text_align'] ); ?>;">
                    <h3 style="margin-bottom: 25px;"><?php echo $settings['heading_text']; ?></h3>
                    <?php if ( ! is_user_logged_in() ) { ?>
                        <div class="row" style="margin: 0; width: unset;">
                            <?php if ( $guest_enquiry == 'off' ) : ?>
                                <div class="col-xs-12 col-md-12 form-group">
                                    <?php esc_html_e( 'Please Login to make enquiry about this product', 'dokan' ); ?>
                                </div>
                                <div class="col-xs-12 col-md-12 form-group">
                                    <a class="btn btn-success btn-green btn-flat btn-lg " href="<?php echo add_query_arg( array( 'redirect_to' => get_permalink( $post->ID ) ), wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Login', 'dokan' ); ?></a>
                                </div>
                            <?php else : ?>
                                <div class="col-xs-12 col-md-12 form-group" style="padding:0; margin-bottom: 10px;">
                                    <input class="form-control" id="name" name="author" placeholder="<?php esc_html_e( 'Your Name', 'dokan' ); ?>" type="text" required/>
                                </div>

                                <div class="col-xs-12 col-md-12 form-group" style="padding:0; margin-bottom: 10px;">
                                    <input class="form-control" id="email" name="email" placeholder="you@example.com" type="email" required />
                                </div>

                                <input type="url" name="url" value="" style="display:none">
                            <?php endif ?>
                        </div>
                    <?php } ?>
                    <?php if ( $guest_enquiry == 'on' || is_user_logged_in() ) : ?>
                        <div class="form-group" style="margin-bottom: 10px;">
							<input placeholder="<?php esc_html_e( $settings['phone_text'], 'dokan' ); ?>"  class="form-control" type="tel" id="phone" name="phone" pattern="{+}{1}[0-9]{11,14}" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
							<input placeholder="Code Postal"  class="form-control" type="text" id="code_postal" name="code_postal" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
							<input placeholder="Pays"  class="form-control" type="text" id="author_pays" name="author_pays" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="dokan-enq-message" name="enq_message" placeholder="<?php esc_html_e( $settings['message_text'], 'dokan' ); ?>" rows="5" required></textarea>
                        </div>

                        <?php do_action( 'dokan_product_enquiry_after_form' ); ?>

                        <?php wp_nonce_field( 'dokan_product_enquiry', 'dokan_product_enquiry_nonce' ); ?>
                        <input type="hidden" name="dokan_product_enquiry_recaptcha_token" class="dokan_recaptcha_token">
                        <input type="hidden" name="enquiry_id" value="<?php echo esc_attr( $post->ID ); ?>">
                        <input type="hidden" name="seller_id" value="<?php echo esc_attr( $post->post_author ); ?>">
                        <input type="hidden" name="action" value="dokan_product_enquiry">

                        <input class="dokan-btn dokan-btn-theme" type="submit" value="<?php esc_html_e( $settings['button_text'], 'dokan' ); ?>">
                    <?php endif ?>
                </form>
            </div>
        </div>
        <?php
		
	}

}