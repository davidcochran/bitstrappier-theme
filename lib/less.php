<?php

/*
 * Innovating on Shoestrap's lib/less.php
 *
 */
function bitstrappier_phpless( $inputFile, $outputFile ) {

  if ( !class_exists( 'lessc' ) ) {
    require_once locate_template( '/lib/less_compiler/lessc.inc.php' );
  }
  $less = new lessc;

  // if ( get_option( 'bitstrappier_minimize_css' ) == 1 ) {
    $less->setFormatter( "compressed" );
  // }

  // create a new cache object, and compile
  $cache = $less -> cachedCompile( $inputFile );

  file_put_contents( $outputFile, $cache["compiled"] );

  // the next time we run, write only if it has updated
  $last_updated = $cache['updated'];
  $cache = $less -> cachedCompile( $cache );
  if ( $cache['updated'] > $last_updated ) {
    file_put_contents( $outputFile, $cache['compiled'] );
  }
}

/*
 * Runs the compiler function bitstrappier_phpless
 * for all files that need compiling
 */
function bitstrappier_phpless_compile() {

  $main_less         = locate_template( 'assets/less/main.less' );
  $main_css          = locate_template( 'assets/css/main.css' );

  // $responsive_less  = locate_template( 'assets/css/responsive.less' );
  // $responsive_css   = locate_template( 'assets/css/responsive.css' );

  // if ( get_option( 'bitstrappier_dev_mode' ) == 1 ) {
    bitstrappier_phpless( $main_less, $main_css );                 // compiling the default styles
    // bitstrappier_phpless( $responsive_less, $responsive_css );   // compiling responsive styles
  // }
}
add_action('wp', 'bitstrappier_phpless_compile');
