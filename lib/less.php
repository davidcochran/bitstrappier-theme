<?php

/*
 * See less php documentation
 * http://leafo.net/lessphp/docs/
 */
function bitstrappier_phpless( $inputFile, $outputFile ) {

  if ( !class_exists( 'lessc' ) ) {
    require_once locate_template( '/lib/less_compiler/lessc.inc.php' );
  }
  $less = new lessc;

  // For now lessphp runs all the time,
  // as long as its included in functions.php

  // We could set up conditions and options such as:
  // if ( get_option( 'bitstrappier_minimize_css' ) == 1 ) {
  // But we'll just leave it on and use comments to do things like:

  // Minimize CSS when LESS is compiled
    $less->setFormatter( "compressed" );

  // Preserve CSS Comments
    // $less->setPreserveComments(true); // uncomment this line to preserve comments

  // Unneeded unless we setup a condition above
  // }

// This creates a cache file to check all imported LESS files for updates
// See http://leafo.net/lessphp/docs/#compiling_automatically

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

// Right now everything is compiled to main.css.
// If need an additional stylesheet, uncomment and customize lines you see below.
  // $responsive_less  = locate_template( 'assets/css/responsive.less' );
  // $responsive_css   = locate_template( 'assets/css/responsive.css' );

  // if ( get_option( 'bitstrappier_dev_mode' ) == 1 ) {
    bitstrappier_phpless( $main_less, $main_css );                 // compiling the default styles
    // bitstrappier_phpless( $responsive_less, $responsive_css );   // compiling responsive styles
  // }
}
add_action('wp', 'bitstrappier_phpless_compile');
