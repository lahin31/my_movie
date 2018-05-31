<input type="hidden" name="has_movie_meta_info" value="1"/>
<div class="lh_movie_meta_field">
	<div class="lh_movie_meta_label">
		<label for="director"><?php _e('Director', 'lh_movie');?>: </label>
	</div>
	<div class="lh_meta_field">
		<input type="text" name="_lh_movie_director" class="regular-text" id="_lh_movie_director" placeholder="Director" value="<?php echo @$_lh_movie_director;?>">
	</div>
</div>
<div class="lh_movie_meta_field">
	<div class="lh_movie_meta_label">
		<label for="writter"><?php _e('Writter', 'lh_movie');?>: </label>
	</div>
	<div class="lh_meta_field">
		<input type="text" name="_lh_movie_writter" class="regular-text" id="_lh_movie_writter" placeholder="Writter" value="<?php echo @$_lh_movie_writter;?>">
	</div>
</div>
<div class="lh_movie_meta_field">
	<div class="lh_movie_meta_label">
		<label for="_lh_movie_stars"><?php _e('Stars', 'lh_movie');?>: </label>
	</div>
	<div class="lh_meta_field">
		<select name="_lh_movie_stars" id="_lh_movie_stars" class="regular-text">
			<?php $ranges = range(0, 5);?>
			<?php foreach($ranges as $range): ?>
				<option <?php if($range == $_lh_movie_stars) { echo "selected"; }?> value="<?php echo $range;?>"><?php echo $range;?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="lh_movie_meta_field">
	<div class="lh_movie_meta_label">
		<label for="runtime"><?php _e('Runtime', 'lh_movie');?>: </label>
	</div>
	<div class="lh_meta_field">
		<input type="text" name="_lh_movie_runtime" class="regular-text" id="_lh_movie_runtime" placeholder="Runtime" value="<?php echo @$_lh_movie_runtime;?>">
	</div>
</div> 