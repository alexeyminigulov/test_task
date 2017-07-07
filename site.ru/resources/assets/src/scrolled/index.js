module.exports = function () {

    window.addEventListener('scroll', scrolled);


    function scrolled() {
		var scrolled = window.pageYOffset || document.documentElement.scrollTop;
		var windowWidth = window.innerWidth;

		scrollHeaderDesktop();


		function scrollHeaderDesktop() {
			if( document.querySelector('.top-header').clientHeight < scrolled ) {
				document.querySelector('.top-panel').classList.add("fixed-header");
				
				$('body').css('marginTop', 134 + 'px');
			}
			else {
				document.querySelector('.top-panel').classList.remove("fixed-header");

				$('body').css('marginTop', '');

			}
		}
	}

};