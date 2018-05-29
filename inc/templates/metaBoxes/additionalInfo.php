<div class="lh_movie_meta_box">
	<?php foreach ($boxes as $box_key => $box): ?>
		<div class="lh_root_meta_id">
			<div class="lh_meta_label">
				<label for="additional_info_<?php echo $box_key; ?>">
					<?php echo @$box['label'];?>
				</label>
			</div>
			<div class="lh_meta_field">
				<input type="text" name="_lh_movie_additional_info[<?php echo $box_key; ?>]" id="additional_info_<?php echo $box_key; ?>" class="regular-text" value="<?php echo @$info[ $box_key ]; ?>">
			</div>
		</div>
		<?php endforeach; ?>
</div>