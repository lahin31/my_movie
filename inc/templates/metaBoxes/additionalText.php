<div class="lh_movie_meta_field">
	<div class="lh_meta_label">
		<label for="_lh_movie_additional_text">
			<?php _e( 'Additional Text', 'lh_movie');?>
		</label>
	</div>
	<div class="lh_meta_field">
		<?php wp_editor($additionalText, '_lh_movie_additional_text', $settings = array( 'textarea_name' => '_lh_movie_additional_text'));?>
	</div>
</div>