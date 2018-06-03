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
		jQuery('.movie_item_modal').on('click', (e) => {
			e.preventDefault();
			jQuery('html, body').addClass('lh_has_modal')
			let movieId = jQuery(this).attr('data-movie_menu_id');
			if(movieId) {
				this.fetchMovie(movieId);
				jQuery(document).on('keyup.lh_esc_key', (e) => {
					if(e.keyCode == 27) { // escape key maps to keycode 27
						this.removeModal();
					}
				})
			}
			this.addLoader();
		});
		jQuery(document).on('click', '.lr_close', () => {
			this.removeModal();
		});
	},
	documentReady() {
		jQuery(document).ready(() => {
			this.initModalClick();
		})
	}
};

lhMovieApp.documentReady();