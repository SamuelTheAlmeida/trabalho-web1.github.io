$(function(){
	$("#siteName").fadeIn(3000);
	$("i").fadeToggle(3000);

	$( window ).scroll(function() {
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

