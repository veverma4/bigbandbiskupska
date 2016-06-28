$.nette.init();

if (!String.prototype.format) {
  String.prototype.format = function() {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function(match, number) { 
      return typeof args[number] != 'undefined'
        ? args[number]
        : match
      ;
    });
  };
}

$(function() {
	var userId = "bigbandbiskupska"
	var authKey = "Gv1sRgCPjusPOarbzhYw"
	var imageSize = 1080
	var thumbnailSize = 100

	var offset = 80;

	$("#mini-nav-menu ul li a[href^='#']").click(function(e) {
		if($(".navbar-toggle:visible").length)
			$("#mini-nav-menu").collapse("toggle");
	});

	$("#mini-nav-menu ul li a[href^='#'], map area").click(function(e) {
	   e.preventDefault()

	   var hash = this.hash

	   $('html, body').stop().animate({
	       scrollTop: $(this.hash).offset().top - offset
	     }, 1000, function(){
	       //window.location.hash = hash
	     })
	});


	/*
		$('#mini-nav-menu .navbar-nav li a, area').click(function(e) {
			if(!$(this).attr('href').startsWith('#')) return true;
		    e.preventDefault();
		    $($(this).attr('href'))[0].scrollIntoView();
		    scrollBy(0, -offset);
		});
	*/
	var timeout = null;

	$("#filter").keyup(function(){
		var $that = $(this);

		if(timeout) {
			clearTimeout(timeout);
			timeout = null;
		}

		timeout = setTimeout(function() {
			$("ul.song-list li.song-empty").remove()

			$("ul.song-list li").each(function(){
				var $el = $(this)
				var name = $el.find(".song-name").first().text().toLowerCase();
				var author = $el.find(".song-interpreter").first().text().toLowerCase();
				var val = $that.val().toLowerCase();
				$el.show();
				if(name.indexOf(val) < 0 &&
				   author.indexOf(val) < 0)
					$el.hide();
			});

			$("ul.song-list").each(function(){
				var length = $(this).find("li:visible").length
				if(length <= 0) {
					$("<li>").addClass("list-group-item")
						   .addClass("col-xs-12")
						   .addClass("song-empty")
						   .html("Bohužel tomuto vyhledávání nevyhovuje žádná položka.")
						   .appendTo($(this))
				}
				$(".song-count").text(length);
			});
		}, 300);
	});

	if($(".google-image").length) {
		var authKey = "Gv1sRgCKKIrt64gMaLzAE"
		var albums = {}

		$(".google-image").each(function(i) {
			var photoId = $(this).data('photoId') || null
			var albumId = $(this).data('albumId') || null
			
			if ( !photoId || !albumId ) return;

			albums [ albumId ] = {}
		});

		window['loadPhotos'] = function(result) {
			for ( var i = 0; i < result.feed.entry.length; i ++ ) {
			      var $e = result.feed.entry[i];
				  albums [ $e.gphoto$albumid.$t ] [ $e.gphoto$id.$t ] = $e;
			}
		};

		var fill = function(i) {
			var photoId = $(this).data('photoId') || null
			var albumId = $(this).data('albumId') || null
			var $that = $(this)

			if(!albumId || !photoId || !albums[albumId] || !albums[albumId][photoId] ) return;

			var $e = albums[albumId][photoId]
			var $thumbnail = $e.media$group.media$thumbnail[0]
			var $image = $e.media$group.media$content[0]
			var $img = $('<img>')
							.prop('src', $thumbnail.url)
							.prop('type', $image.type)
							.addClass('img img-rounded')
							.addClass('img-resp')
							.prop('alt', $e.media$group.media$title.$t)
			$('<a/>')
				.append($img)
				.prop('href', $image.url)
				.prop('title', $e.media$group.media$description.$t)
				.attr('data-gallery', '')
				.appendTo($that)
		};

		for(var key in albums)
		{
			$ .ajax({
				url: 'https://picasaweb.google.com/data/feed/api/user/' + userId + '/albumid/' + key + '?alt=json&authkey=' + authKey + '&imgmax=' + imageSize + 'u&thumbsize=720',
				timeout: 5000,
				jsonpCallback: 'loadPhotos',
				dataType: 'jsonp',
				cache: true,
			}).done(function(r) {
				$(".google-image").each(fill)
			}).fail(function(){
			});

		}

	}
})					
;