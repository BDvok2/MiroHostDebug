(function ($) {
	"use strict";

	qodefCore.shortcodes.techlink_core_portfolio_parallax = {};

	$(window).on('load', function () {
		qodefPortfolioParallax.init();
	});

	var qodefPortfolioParallax = {
		init: function () {
			this.holder = $('.qodef-portfolio-parallax'),
			this.articles = this.holder.find('.qodef-m-parallax-main article');
			this.textItems = this.holder.find('.qodef-m-parallax-texts .qodef-e-item');

			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);

					$thisHolder.addClass('init');
					qodefPortfolioParallax.setPositions();
					requestAnimationFrame(qodefPortfolioParallax.render);
				});
			}
		},
		crop: function ($item, i) {
			var rItem = $item[0].getBoundingClientRect(),
				rText = qodefPortfolioParallax.textItems.eq(i)[0].getBoundingClientRect();

			var c = 1 - (rItem.top + rItem.height - rText.top)/(rText.height);

			c= Math.min(Math.max(c,0),1);

			qodefPortfolioParallax.textItems.eq(i).find('.qodef-e-helper-1').css({
				'transform': 'translate3d(0,-'+c*100+'%,0)'
			});
			qodefPortfolioParallax.textItems.eq(i).find('.qodef-e-helper-2').css({
				'transform': 'translate3d(0,'+c*100+'%,0)'
			});
			qodefPortfolioParallax.textItems.eq(i + 1).find('.qodef-e-helper-1').css({
				'transform': 'translate3d(0,'+(1-c)*100+'%,0)'
			});
			qodefPortfolioParallax.textItems.eq(i + 1).find('.qodef-e-helper-2').css({
				'transform': 'translate3d(0,-'+(1-c)*100+'%,0)'
			});
		},
		render: function () {
			qodefPortfolioParallax.articles.each(function(i) {
				var $article = $(this),
					rect = $article[0].getBoundingClientRect();

				rect.top < 0 &&  rect.top + rect.height > 0 && qodefPortfolioParallax.crop($article, i);
			});

			requestAnimationFrame(qodefPortfolioParallax.render);
		},
		setPositions: function () {
			qodefPortfolioParallax.textItems.find('.qodef-e-helper-1').css({
				'transform': 'translate3d(0,100%,0)'
			})
			qodefPortfolioParallax.textItems.find('.qodef-e-helper-2').css({
				'transform': 'translate3d(0,-100%,0)'
			});
			qodef.scroll == 0 && qodefPortfolioParallax.textItems.first().find('div[class*="helper"]').css({
				'transform': 'translate3d(0,0,0)'
			});
		}
	};

	qodefCore.shortcodes.techlink_core_portfolio_parallax.qodefPortfolioParallax = qodefPortfolioParallax;

})(jQuery);
