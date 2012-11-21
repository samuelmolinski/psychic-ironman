
if(!window.log) {window.log = function() {log.history = log.history || [];log.history.push(arguments);if(this.console) {console.log(Array.prototype.slice.call(arguments));}};}

(function(window, $, undefined){
	$(document).ready(function(){
		//movie thumbnails
		$('.videoThumbnails li').click(function(){
			$('.videoThumbnails li.cur').removeClass('cur');
			$(this).addClass('cur');
			var link = 'http://www.youtube.com/embed/'+$(this).find('img').attr('rel');
			log(link);
			$('#currentVideo iframe').attr('src', link);
		})
	});
})(window, jQuery);