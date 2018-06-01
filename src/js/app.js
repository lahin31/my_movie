const lhMovieApp = {

	addLoader() {
		let mov = {
			loader: jQuery('<div />', {
				class: 'lh_loader'
			})
		};
		jQuery('body').append(mov.loader);
	},

	removeLoader() {
		jQuery('body').find(".lh_loader").remove();
	},

	fetchMovie(movieId) {
		this.addLoader();
		jQuery.get(lh_menu_vars.get_movie_url, {
			movie_id: movieId
		})
		.then(
			response => {
				let movieModalHolder = jQuery('<div />', {
					class: 'movie-modal-holder',
					html: response
				});

				jQuery('body')
					.hide()
					.append(movieModalHolder)
					.fadeIn(100)
			}
		)
		.fail(
			error => {
				alert("Something is wrong when loading the content please try again!");
			}
		)
		.always(
			() => {
				this.removeLoader();
			}
		);
	},
	removeModal() {
		jQuery('.movie-modal-holder')
			.fadeOut('200', () => {
				jQuery(this).remove();
				jQuery('html, body').removeClass('lh_has_modal');
				jQuery(document).off('keyup.lh_esc_key');
			});
	},
	initModalClick() {
		jQuery('.lh_movie_modal').on('click', (e) => {
			e.preventDefault();
			jQuery('html, body').addClass('lh_has_modal')
		})
	}
}