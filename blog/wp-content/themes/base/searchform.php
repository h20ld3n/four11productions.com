<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Base
 * @since Base 1.3
 */
?>
<?php 
if ( ! isset( $s ) ) { $s = ""; }
if (!is_search()) {
	// Default search text
	$search_text = __( 'Search', 'gpp_base_lang' );
} else { 
	$search_text = "$s"; 
}
?>
<div id="search">
	<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
		<div>
			<input type="text" name="s" id="s" value="<?php echo esc_html( $search_text, 1 ); ?>" onfocus="clearInput('s', '<?php echo esc_html( $search_text, 1 ); ?>')" onblur="clearInput('s', '<?php echo esc_html( $search_text, 1 ); ?>' )" class="png_bg" /> 
		</div>
	</form>
</div>
