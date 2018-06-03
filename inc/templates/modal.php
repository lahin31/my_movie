<div id="movie_modal_<?php echo $postID;?>" class="lh_modal_dialog">
	<div class="modal_item">
		<a class="lh_close">x</a>
		<?php $featuredImage = get_the_post_thumbnail_url($post, 'large');?>
		<?php do_action('lh_menu_before_modal_header', $post);?>
		<?php if($featuredImage):?>
			<div style="background-image: url('<?php echo $featuredImage;?>')" class="lh_header_holder">
				<div class="lh_header_section">
					<h3><?php echo $post->post_title;?></h3>
					<?php do_action('lh_menu_after_modal_header', $post); ?>
				</div>
			</div>
		<?php endif;?>
		<div class="lh_modal_content">
			<?php do_action('lh_menu_at_modal_content_start', $post);?>
			<?php if(!$featuredImage): ?>
				<h2 class="lh_inner_title">
					<?php echo $post->post_title;?>
				</h2>
			<?php endif;?>
			<?php
	        $categories = wp_get_post_terms( $post->ID, \MyMovie\Classes\PostTypeClass::$movieCategory );
	        if ( count( $categories ) ):
		        echo '<div class="lh_tax_items">';
		        foreach ( $categories as $category ):
			        echo '<span>' . $category->name . '</span>';
		        endforeach;
		        echo "</div>";
	        endif;
	        ?>
		</div>
	</div>
</div>