<?php

function post_type_for_enquiryform_data() {
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Product Enquiry Submissions', 'Post Type General Name', 'dokan' ),
        'singular_name'       => _x( 'Product Enquiry Submission', 'Post Type Singular Name', 'dokan' ),
        'menu_name'           => __( 'Product Enquiry Submissions', 'dokan' ),
        'parent_item_colon'   => __( 'Parent Product Enquiry Submission', 'dokan' ),
        'all_items'           => __( 'All Product Enquiry Submission', 'dokan' ),
        'view_item'           => __( 'View Product Enquiry Submission', 'dokan' ),
        'add_new_item'        => __( 'Add New Product Enquiry Submission', 'dokan' ),
        'add_new'             => __( 'Add New', 'dokan' ),
        'edit_item'           => __( 'Edit Product Enquiry Submission', 'dokan' ),
        'update_item'         => __( 'Update Product Enquiry Submission', 'dokan' ),
        'search_items'        => __( 'Search Product Enquiry Submission', 'dokan' ),
        'not_found'           => __( 'Not Found', 'dokan' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'dokan' ),
    );
    // Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'product_enquiry_data', 'dokan' ),
        'description'         => __( 'Product Enquiry Submission news and reviews', 'dokan' ),
        'labels'              => $labels,  
        'supports'            => array( 'title' ),     
        'taxonomies'          => array( 'genres' ),     
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true, 
    );
    // Registering your Custom Post Type
    register_post_type( 'product_enquiry_data', $args );

    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'Enquiry-Form-Questions',
            'title' => 'Enquiry Form',
            'fields' => array (
                array (
                    'key' => 'author_name',
                    'label' => 'Name',
                    'name' => 'slide_one',
                    'type' => 'text',
                    'default_value' => '',
                ),
                array (
                    'key' => 'author_email',
                    'label' => 'Email',
                    'name' => 'slide_two',
                    'type' => 'text',
                    'default_value' => '',
                ),
                array (
                    'key' => 'author_phone',
                    'label' => 'Phone',
                    'name' => 'slide_three',
                    'type' => 'text',
                    'default_value' => '',
                ),
                array (
                    'key' => 'code_postal',
                    'label' => 'Postal Code',
                    'name' => 'slide_five',
                    'type' => 'text',
                    'default_value' => '',
                ),
                array (
                    'key' => 'author_pays',
                    'label' => 'Country',
                    'name' => 'slide_six',
                    'type' => 'text',
                    'default_value' => '',
                ),
                array (
                    'key' => 'quiz_slide_six_m',
                    'label' => 'Message',
                    'name' => 'slide_four',
                    'type' => 'textarea',
                    'default_value' => '',
                ),


            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product_enquiry_data',
                    ),
                ),
            ),
        ));

    endif;
  

}
add_action( 'init', 'post_type_for_enquiryform_data', 0 );


