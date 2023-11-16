<?php
/*
Plugin Name: Simple Image Gallery
Description: Easily create and display image galleries on your pages or posts.
Version: 1.0
Author: Abhishek Dongare
*/

function simple_image_gallery_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'ids' => '', // Comma-separated list of attachment IDs
    ), $atts, 'simple_image_gallery');

    // Convert IDs to array
    $attachment_ids = explode(',', $atts['ids']);

    // Output HTML
    $output = '<div class="simple-image-gallery">';
    foreach ($attachment_ids as $attachment_id) {
        $image_url = wp_get_attachment_image_url($attachment_id, 'full');
        $output .= '<a href="' . esc_url($image_url) . '" class="gallery-item" data-lightbox="gallery">';
        $output .= wp_get_attachment_image($attachment_id, 'thumbnail');
        $output .= '</a>';
    }
    $output .= '</div>';

    return $output;
}

function enqueue_gallery_scripts() {
    // Enqueue lightbox script and styles
    wp_enqueue_script('lightbox', 'https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js', array('jquery'), '2.11.3', true);
    wp_enqueue_style('lightbox', 'https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css', array(), '2.11.3');
}

add_action('wp_enqueue_scripts', 'enqueue_gallery_scripts');
add_shortcode('simple_image_gallery', 'simple_image_gallery_shortcode');
?>
