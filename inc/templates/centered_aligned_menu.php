<div class="lh_movie_menu_group lh_movie_menu_<?php echo $display;?>">
	<?php foreach ( $items as $item ): ?>
		<?php setup_postdata( $item ); ?>
        <div class="movie-item movie_item_id_<?php echo $item->ID; ?>  <?php echo $modalClass; ?>"
             data-movie_menu_id="<?php echo $item->ID; ?>">
            <div class="movie-item-content">
                <h3 class="movie_item_title">
					<?php echo get_the_title( $item ); ?>
                </h3>
                <div class="movie_item_content">
	                <?php echo lhMovieMenuWordExcerpt($item, $excerptLength, 'center_aligned' ); ?>
                </div>
            </div>
        </div>
		<?php wp_reset_postdata(); ?>
	<?php endforeach; ?>
</div>