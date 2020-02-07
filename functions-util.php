<?php
function roundNearestUpBy($number, $round_to_near = 1000) {
	return intval( ceil( $number / $round_to_near ) * $round_to_near );
}

function roundNearestDownBy($number, $round_to_near = 100) {
	return intval( floor( $number / $round_to_near ) * $round_to_near );
}

function tre_get_tax_query_greater_equal($num, $tax) {
	$tax_query = [];

	$terms = get_terms([
		'taxonomy' => $tax,
	]);

	$amps = [];
	foreach( $terms as $term ) {
		if( (int) $term->slug >= (int) $num ) {
			$amps[] = $term->term_id;
		}
	}

	return $amps;
}

function tre_get_tax_query($min, $max, $taxonomy) {
  $tax_query = [];

  $terms = get_terms([
    'taxonomy' => $taxonomy,
  ]);

  $amps = [];
  foreach( $terms as $term ) {
    if( (int) $term->slug <= (int) $max && (int) $term->slug >= (int) $min ) {
      $amps[] = $term->term_id;
    }
  }

  return $amps;
}

function tmwsf_pre($arr = []) {
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}
function tre_has_search_ui_shortcode() {
	global $post;
	global $shortcode_tags, $wp_filter;
	global $varObj;

	if( !is_admin() && $post && isset($post->post_content) && has_shortcode($post->post_content, 'tm_search_ui') ) {
		return true;
	}
	return false;
}
