</div>
							<footer class="clearfix text-center">
								&copy; 2016 - Your Company Name Here<br />
								Designed by <a href="#">Batavianet</a> | All Rights Reserved.
							</footer>
						<div>
					</div>
				</div>
			</div>
		</content>
	</body>
</html>

<script>
	$(document).ready(function(){

		var ntf_panel_width = $('.notification-panel').parent().parent().width();
		$('.notification-panel').css('width',ntf_panel_width);
		$('.notification-content').last().css('border-bottom','none');
		$('.notification-content').last().css('margin-bottom','10px');

		$('.sidebar-dropdown').click(function(a){
			$('.sub-menu-sidebar').slideUp(500);
			if($(this).siblings().hasClass('undropped')){
				$(this).siblings().slideDown();
				$(this).children().last().removeClass('fa-chevron-down');
				$(this).children().last().addClass('fa-chevron-right');
				$('.sidebar-dropdown>i:last-child').removeClass('fa-chevron-right');
				$('.sidebar-dropdown>i:last-child').addClass('fa-chevron-down');
				$('.sub-menu-sidebar').addClass('undropped');
				$(this).siblings().removeClass('undropped');
			}
			else{
				$('.sub-menu-sidebar').addClass('undropped');
				$(this).siblings().slideUp();
				$(this).children().last().removeClass('fa-chevron-right');
				$(this).children().last().addClass('fa-chevron-down');
				$(this).siblings().addClass('undropped');
			}
			a.preventDefault();
		});

		$('.si-asset').click(function(a){
			$('.ism-asset').slideToggle();
			a.preventDefault();
		});

		$('.si-maintenance').click(function(a){
			$('.ism-maintenance').slideToggle();
			a.preventDefault();
		});

		$('.notification-trigger').click(function(a){
			$(this).siblings().last().slideToggle(500);
			a.preventDefault();
		});

		$('.profile-trigger').click(function(a){
			$('.panel-profile').toggleClass('panel-profile-opened');
			a.preventDefault();
		});
	});
</script>
