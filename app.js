$(function(){
	$("#siteName").fadeIn(3000);
	$("i").fadeToggle(3000);

	$( window ).on("load", function() {
  		$( "#grid" ).fadeIn(3000);
});
});

$(function(){
  $("#submitPost").on("submit",function(){
    textarea = $("textarea");

    if(textarea.val() == "" || textarea.val() == null)
    {
      alert("Digite o conteúdo do spotted");
      return(false);
    }

    return(true);
  });
});

$(document).ready(function() {
 if (location.pathname.substring().search("admin") >= 0) {
    var rows = ($(".adminCol").length)/3;
    if (rows < 2) {
      $("body").addClass("small");
      $(".adminPages").addClass("smallPages");
    } else if (rows < 3){
      $(".adminPages").addClass("mediumPages");
      $("body").addClass("medium");
    } else if (rows >= 3) {
      $(".adminPages").addClass("bigPages");
    }
 } else if (location.pathname.substring().search("sobre") >= 0 || location.pathname.substring().search("newspotted") >= 0) {
            $("body").addClass("small");
    };

});

// $(".adminCol").length;
