
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
		});
		/*$('.connectFacebook').click(function(){
			
			var oauth_url = 'https://www.facebook.com/dialog/oauth/';
			oauth_url += '?client_id=402784116453669';
			oauth_url += '&redirect_uri=' + encodeURIComponent('https://www.facebook.com/MedicosSemFronteiras/app_402784116453669');
			oauth_url += '&scope=email,user_about_me,publish_stream,read_stream';
			//window.top.location = oauth_url;
		});*/



	});
})(window, jQuery);