
		var scrollDuration = 300;
		// paddles
		var leftPaddle = document.getElementsByClassName('left-paddle');
		var rightPaddle = document.getElementsByClassName('right-paddle');
		// get items dimensions
		var itemsLength = $('.item').length;
		var itemSize = $('.item').outerWidth(true);
		// get some relevant size for the paddle triggering point
		var paddleMargin = 20;

		// get wrapper width
		var getMenuWrapperSize = function() {
			return $('.menu-wrapper').outerWidth();
		}
		var menuWrapperSize = getMenuWrapperSize();
		// the wrapper is responsive
		$(window).on('resize', function() {
			menuWrapperSize = getMenuWrapperSize();
		});
		// size of the visible part of the menu is equal as the wrapper size 
		var menuVisibleSize = menuWrapperSize;

		// get total width of all menu items
		var getMenuSize = function() {
			return itemsLength * itemSize;
		};
		var menuSize = getMenuSize();
		// get how much of menu is invisible
		var menuInvisibleSize = menuSize - menuWrapperSize;

		// get how much have we scrolled to the left
		var getMenuPosition = function() {
			return $('.menu').scrollLeft();
		};

		// finally, what happens when we are actually scrolling the menu
		$('.menu').on('scroll', function() {

			// get how much of menu is invisible
			menuInvisibleSize = menuSize - menuWrapperSize;
			// get how much have we scrolled so far
			var menuPosition = getMenuPosition();

			var menuEndOffset = menuInvisibleSize - paddleMargin;

			// show & hide the paddles 
			// depending on scroll position
			if (menuPosition <= paddleMargin) {
				$(leftPaddle).addClass('hidden');
				$(rightPaddle).removeClass('hidden');
			} else if (menuPosition < menuEndOffset) {
				// show both paddles in the middle
				$(leftPaddle).removeClass('hidden');
				$(rightPaddle).removeClass('hidden');
			} else if (menuPosition >= menuEndOffset) {
				$(leftPaddle).removeClass('hidden');
				$(rightPaddle).addClass('hidden');
			}


		});

		// scroll to left
		$(rightPaddle).on('click', function() {
			$('.menu').animate( { scrollLeft: menuInvisibleSize}, scrollDuration);
		});

		// scroll to right
		$(leftPaddle).on('click', function() {
			$('.menu').animate( { scrollLeft: '0' }, scrollDuration);
		});
		
		//artikel bagian------------------------------------------------------------------
		
		// paddles
		var leftPaddle2 = document.getElementsByClassName('left-paddle2');
		var rightPaddle2 = document.getElementsByClassName('right-paddle2');
		
		var itemsLength = $('.item2').length;
		var itemSize = $('.item2').outerWidth(true);
		// get some relevant size for the paddle triggering point
		var paddleMargin2 = 20;
		
		// get wrapper width
		var getMenuWrapperSize2 = function() {
			return $('.menu-wrapper2').outerWidth();
		}
		var menuWrapperSize2 = getMenuWrapperSize2();
		// the wrapper is responsive
		$(window).on('resize', function() {
			menuWrapperSize2 = getMenuWrapperSize2();
		});
		// size of the visible part of the menu is equal as the wrapper size 
		var menuVisibleSize = menuWrapperSize2;

		// get total width of all menu items
		var getMenuSize2 = function() {
			return itemsLength * itemSize;
		};
		var menuSize2 = getMenuSize2();
		// get how much of menu is invisible
		var menuInvisibleSize2 = menuSize2 - menuWrapperSize2;

		// get how much have we scrolled to the left
		var getMenuPosition2 = function() {
			return $('.menu2').scrollLeft();
		};

		// finally, what happens when we are actually scrolling the menu
		$('.menu2').on('scroll', function() {

			// get how much of menu is invisible
			menuInvisibleSize2 = menuSize2 - menuWrapperSize2;
			// get how much have we scrolled so far
			var menuPosition2 = getMenuPosition2();

			var menuEndOffset2 = menuInvisibleSize2 - paddleMargin2;

			// show & hide the paddles 
			// depending on scroll position
			if (menuPosition2 <= paddleMargin2) {
				$(leftPaddle2).addClass('hidden');
				$(rightPaddle2).removeClass('hidden');
			} else if (menuPosition2 < menuEndOffset2) {
				// show both paddles in the middle
				$(leftPaddle2).removeClass('hidden');
				$(rightPaddle2).removeClass('hidden');
			} else if (menuPosition2 >= menuEndOffset2) {
				$(leftPaddle2).removeClass('hidden');
				$(rightPaddle2).addClass('hidden');
			}


		});

		// scroll to left
		$(rightPaddle2).on('click', function() {
			$('.menu2').animate( { scrollLeft: menuInvisibleSize2}, scrollDuration);
		});

		// scroll to right
		$(leftPaddle2).on('click', function() {
			$('.menu2').animate( { scrollLeft: '0' }, scrollDuration);
		});