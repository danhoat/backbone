<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
			the_post();
			?>
			<h1> <?php the_title();?> </h1>
			<div class="content">
			<?php
			the_content();
			?>
			</div>

		</div><!-- #content -->
		<div class="sidebar">
			<p> </p>
			day la sidebar.
		</div>
		<input type="hidden" name="123" value = "123" />
	</div><!-- #primary -->
	<script type="application/json" id="publish_post">
		<?php echo json_encode($results); ?>
	</script
	</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>