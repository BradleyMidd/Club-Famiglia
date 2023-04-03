$(document).ready(function()
{
	//Verstop de elementen "nav" en "hr"
	$("nav").hide();
	$("hr").hide();
	
	//als er op de div geklikt wordt dan verschijnt de nav en hr
	$(".pos").click(function()
		{
			$(this).data('clicked', true);
			$("nav").toggle(500);
			$("hr").toggle(700);
		
		});
});

	