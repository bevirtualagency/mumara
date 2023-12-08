
<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};

			var timeZoneString="{{auth()->user()->timezone ? auth()->user()->timezone:'UTC' }}";
		</script>

		<!--begin:: Global Mandatory Vendors -->
		<script src="/themes/default/js/jquery.js" type="text/javascript"></script>
		<script src="/themes/default/js/popper.js" type="text/javascript"></script>
		<script src="/themes/default/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/themes/default/js/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="/themes/default/js/sticky.min.js" type="text/javascript"></script>
		<script src="/themes/default/js/moment.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.38/moment-timezone-with-data-1970-2030.min.js" integrity="sha512-4py2mXqYpLzM2S82zTxjUViu0HvrQ9Vn1xvk6AoSzXPH6En2xGJ8qcEtFw2jE93O8lsDhf0o7Fan2eC5atQD8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="/themes/default/js/toastr.min.js" type="text/javascript"></script>
		<script src="/themes/default/js/jquery.blockUI.js" type="text/javascript"></script>
		<script src="/themes/default/js/clockdigital.js" type="text/javascript"></script>
		<script src="/themes/default/js/jquery-migrate-1.4.1.min.js" type="text/javascript"></script>
		<script src="/themes/default/js/modernizr.js" type="text/javascript"></script>
		<script src="/themes/default/js/scripts.bundle.js" type="text/javascript"></script>
		<script src="/themes/default/js/app.bundle.min.js" type="text/javascript"></script>
		<script> 

		$(function() { 
			var mainmenu = JSON.parse(localStorage.getItem("mainmenu"));
			if(mainmenu == null) mainmenu = [];
			mainmenu.forEach(function(item) {
				$("." + item).removeClass("new-menu");
				
				$("." + item).text("");
			});

			$('.new-menu').each(function() {
				var parent_id = $(this).attr("data-parent");
				 $("#newClass" + parent_id).addClass("top-menu");
			});

		});
		$("body").on("click" , ".clickOnClass" , function() { 
			var id = $(this).attr("data-id");
			var mainmenu = JSON.parse(localStorage.getItem("mainmenu"));
    		if(mainmenu == null) mainmenu = [];
			
			if(!mainmenu.includes("newClass" + id)) { 
				mainmenu.push("newClass" + id);
				localStorage.setItem("mainmenu" ,  JSON.stringify(mainmenu));
			}
		});

		
		</script>