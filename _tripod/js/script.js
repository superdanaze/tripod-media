window.isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function() {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
}

!function() {
	const html = document.documentElement;
	const body = document.body;
	const text_light	= "#9c9c8e";
	const text_dark		= "#121314";


	function noscroll(s) {
		if ( s ) {
			html.classList.add('noscroll');
			body.classList.add('noscroll');
		} else {
			html.classList.remove('noscroll');
			body.classList.remove('noscroll');
		}
	}


	//	element peeking v2.0
	let els = document.querySelectorAll('[data-fade]');

	const fade = new IntersectionObserver((entries) => {
		entries.forEach( entry => {

			if ( entry.isIntersecting ) {
				entry.target.classList.remove('start');
			} else {
				entry.target.classList.add('start');
			}
		});
	},{
		threshold : 0.25
	});

	els.forEach( el => {
		fade.observe(el);
	});



	
	let header = {
		trigger		: document.querySelector('.nav-trigger-wrap'),
		navwrap		: document.querySelector('.mobile-menu-master-wrap'),
		ul			: document.getElementById('ela-mobile-navigation'),
		_click		: true,

		animate_burger: function(dir) {
			let spans = this.trigger.querySelectorAll('span');

			if ( !this._click ) return;

			//	disable click
			this._click = false;

			//	get header color scheme
			let header_color = document.body.classList.contains('nav-light') ? text_light : text_dark;

			if ( dir ) {
				//	add classes
				document.body.classList.add('mobile-nav');
				this.trigger.classList.add('active');
				this.navwrap.classList.add('active');

				let open1 = anime.timeline({
					duration : 250,
					easing : "easeOutExpo"
				});

				//	fade in nav BG
				anime({
					targets : this.navwrap,
					opacity : [ 0, 1 ],
					duration : 1000,
					easing : "linear",
					begin : () => {
						noscroll(true);
					}
				});

				//	compress burger + spans color
				open1.add({
					targets : spans[0],
					translateY : [ 0, 8 ],
				}).add({
					targets : spans[2],
					translateY : [ 0, -8 ],
				}, 10).add({
					targets : spans,
					background : text_light,
					easing : "linear"
				}, 10);

				
				//	rotate to X
				anime({
					targets : this.trigger,
					rotate : "45deg",
					duration : 500,
					easing : "easeInOutExpo",
					delay : 450
				});
				anime({
					targets : spans[1],
					rotate : "90deg",
					duration : 500,
					easing : "easeInOutExpo",
					delay : 250,
					complete: () => {
						this._click = true;
						this.trigger.dataset.action = "nav-close";
					}
				});

				//	bring in navigation lis
				anime({
					targets : this.ul.children,
					opacity : [ 0, 1 ],
					translateY : [ -10, 0 ],
					duration : 750,
					easing : "easeOutExpo",
					delay : anime.stagger(100, { start : 600, from : 'center' })
				});


			} else {
				//	navigation lis out
				anime({
					targets : this.ul.children,
					opacity : [ 1, 0 ],
					translateY : [ 0, -10 ],
					duration : 250,
					easing : "easeInExpo",
					delay : anime.stagger(35, { from : 'last' })
				});

				//	fade nav BG out
				anime({
					targets : this.navwrap,
					opacity : [ 1, 0 ],
					duration : 1000,
					delay : 250,
					easing : "linear",
					complete : () => {
						noscroll();
					}
				});

				//	rotate to burger
				anime({
					targets : spans[1],
					rotate : [ "90deg", 0 ],
					duration : 250,
					easing : "easeOutExpo",
					complete : function() {
						//	remove classes
						document.body.classList.remove('mobile-nav');
					}
				});
				anime({
					targets : this.trigger,
					rotate : [ "45deg", 0 ],
					duration : 750,
					easing : "easeInOutExpo"
				});

				//	spans color
				anime({
					targets : spans,
					background : header_color,
					duration : 250,
					delay : 500,
					easing : "linear"
				});

				//	restore burger
				anime({
					targets : spans[0],
					translateY : [ "8px", 0 ],
					duration : 400,
					easing : "easeOutExpo",
					delay : 350
				});
				anime({
					targets : spans[2],
					translateY : [ "-8px", 0 ],
					duration : 400,
					easing : "easeOutExpo",
					delay : 350,
					complete: () => {
						this._click = true;
						this.trigger.dataset.action = "nav-open";

						//	remove classes
						setTimeout(() => { 
							this.trigger.classList.remove('active');
							this.navwrap.classList.remove('active');
						}, 500);
					}
				});
			}
		}
	};


	//	home page project items
	let home = {
		items		: document.querySelectorAll('.project-item-wrap'),

		load_items: function() {
			anime({
				targets : this.items,
				opacity : [ 0, 1 ],
				duration : 1000,
				easing : "linear",
				delay : anime.stagger(300)
			});
		}

	};

	//	load home project items
	if ( home.items.length ) {
		home.load_items();
	}


	//	single project gallery
	let spg = {
		container			: document.querySelector('.project-gallery-inner'),
		items				: document.querySelectorAll('.project-gallery-item'),
		gallery_modal		: document.querySelector('.project-gallery-modal'),
		gallery_items_wrap	: document.querySelector('.gallery-modal-items'),
		touchstartX			: 0,
		touchendX			: 0,
		_click				: true,

		hover_effect: function(e) {
			if ( e.type === "mouseenter" ) {
				this.container.classList.add('hover-effect');
				e.target.classList.add('hover');
			}

			if ( e.type === "mouseleave" ) {
				this.container.classList.remove('hover-effect');
				e.target.classList.remove('hover');
			}
		},

		activate_first_item: function(e) {
			this.current = parseInt(e.target.dataset.item);

			let children = this.gallery_items_wrap.children,
				item = children[this.current - 1];
			
			anime({
				targets : item,
				opacity : [ 0, 1 ],
				duration : 400,
				easing : "linear"
			});
		},

		deactivate_last_item: function() {
			let children = this.gallery_items_wrap.children,
				item = children[this.current - 1];

			item.style.opacity = 0;
		},

		handle_gallery_modal: function(e, state) {
			//	open
			if ( state && this._click ) {
				//	handle clicks
				this._click = false;

				anime({
					targets : this.gallery_modal,
					opacity : 1,
					duration : 400,
					easing : "linear",
					begin : () => {
						//	unhide
						this.gallery_modal.classList.remove('hide');

						//	disable scroll
						noscroll(true);
					},
					complete : () => {
						//	bring in selected item
						this.activate_first_item(e);

						//	enable clicks
						this._click = true;
					}
				});
			}

			//	close
			if ( !state && this._click ) {
				//	handle clicks
				this._click = false;

				anime({
					targets : this.gallery_modal,
					opacity : 0,
					duration : 400,
					easing : "linear",
					complete : () => {
						//	hide modal
						this.gallery_modal.classList.add('hide');

						//	deactivate active image
						this.deactivate_last_item();

						//	enable scroll
						noscroll(false);

						//	enable clicks
						this._click = true;
					}
				});
			}
		},

		handle_prev_item: function() {
			//	handle clicks
			if ( !this._click ) return;
			this._click = false;

			let len = this.gallery_items_wrap.children.length,
				current_item = this.gallery_items_wrap.children[this.current - 1],
				new_current = this.current - 1 === 0 ? len : this.current - 1,
				new_current_item = this.gallery_items_wrap.children[new_current - 1];

			let prev = anime.timeline({
				duration : 400,
				easing : "easeOutQuad"
			});

			//	fade out prev item, fade in new item
			prev.add({
				targets : current_item,
				opacity : 0,
				translateX : [ 0, 10 ]
			}).add({
				targets : new_current_item,
				opacity : 1,
				translateX : [ -10, 0 ],
				complete : () => {
					//	set new current
					this.current = new_current;

					//	enable clicks
					this._click = true;
				}
			});
		},

		handle_next_item: function() {
			//	handle clicks
			if ( !this._click ) return;
			this._click = false;

			let len = this.gallery_items_wrap.children.length,
				current_item = this.gallery_items_wrap.children[this.current - 1],
				new_current = this.current === len ? 1 : this.current + 1,
				new_current_item = this.gallery_items_wrap.children[new_current - 1];

			let next = anime.timeline({
				duration : 400,
				easing : "easeOutQuad"
			});

			//	fade out prev item, fade in new item
			next.add({
				targets : current_item,
				opacity : 0,
				translateX : [ 0, -10 ]
			}).add({
				targets : new_current_item,
				opacity : 1,
				translateX : [ 10, 0 ],
				complete : () => {
					//	set new current
					this.current = new_current;

					//	enable clicks
					this._click = true;
				}
			});
		}
	};

	//	create hover effect listener on gallery items
	if ( spg.items && !isMobile.any() ) {
		spg.items.forEach( item => {
			item.addEventListener('mouseenter', (e) => {
				spg.hover_effect(e);
			});
	
			item.addEventListener('mouseleave', (e) => {
				spg.hover_effect(e);
			});
		});
	}

	//	handle touch events for mobile
	if ( spg.gallery_items_wrap ) {
		spg.gallery_items_wrap.addEventListener('touchstart', (e) => {
			spg.touchstartX = e.changedTouches[0].screenX;
		}, false);
		spg.gallery_items_wrap.addEventListener('touchend', (e) => {
			spg.touchendX = e.changedTouches[0].screenX;
	
			//	swiped left (next item)
			if ( spg.touchendX < spg.touchstartX ) spg.handle_next_item();
			
			//	swipe right (prev item)
			if ( spg.touchendX > spg.touchstartX ) spg.handle_prev_item();
		}, false);
	}
	

	document.addEventListener('click', function(e) {
		//	mobile nav
		if ( e.target.dataset.action === "nav-open" ) {
			header.animate_burger(true);
		}
		if ( e.target.dataset.action === "nav-close" ) {
			header.animate_burger(false);
		}

		//	single project gallery modal
		if ( e.target.classList.contains('project-gallery-item') ) spg.handle_gallery_modal(e, true);
		if ( e.target.classList.contains('gallery-modal-close') ) spg.handle_gallery_modal(e, false);

		//	single project gallery modal navigation
		if ( e.target.classList.contains('gallery-modal-prev') ) spg.handle_prev_item();
		if ( e.target.classList.contains('gallery-modal-next') ) spg.handle_next_item();

	});

	

	window.addEventListener('resize', function(e) {

	});
	
}();