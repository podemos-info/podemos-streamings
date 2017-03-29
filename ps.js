jQuery(document).ready(function() {
    jQuery(".ps-thumb-a").on("click",function() {
      var prv = jQuery(".container").find(".ps-selected");
      var cur = jQuery(this);
      var cur_title = cur.find("h6").html();
      var iframe_container = jQuery(".ps-directo-player");
      var iframe_new_src = "https://www.youtube.com/embed/" + cur.attr("data-id");
      var iframe_new_src_params = "?feature=oembed&autoplay=true";
      var player_title = jQuery(".ps-directo-player").find("#ps-player-title");
      if(player_title.html()!=cur_title){
	cur.parent().addClass('ps-selected')
	prv.removeClass('ps-selected');
	iframe_container.html( '<div class="embed-responsive embed-responsive-16by9"><iframe src='+iframe_new_src+iframe_new_src_params+' allowfullscreen="" frameborder="0"></iframe></div><p><h2 class="h6" id="ps-player-title">'+cur_title+'</h2></p>' );
	player_title.html( cur_title );
      }
    });
});
