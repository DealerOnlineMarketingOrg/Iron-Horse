(function($) {
   $.fn.extend({
		IconNav: function(settings){

            //set some default settings for the navigation plugin
            var defaults = {
                defaultIcon:$('li.dashboard'),
                separater:'&bull;',
                dd_easing:'fast',
                parent_ul:$('.main_nav'),
                subnav_container:$('.subnav'),
                active_class_name:'active'
            };

			var params = $.extend(defaults,settings);

            //start and set defaults
            ActivateDefaultIcon();
            InitButtonActions();

            function AddFormating() {
                var subnav = params.parent_ul.find(params.subnav_container);
                //subnav.find('li').append(params.separater);
				$('<span>'+params.separater+'</span>').insertAfter(subnav.find('a'));
            }

            function ActivateDefaultIcon() {
                //activate default icon
                params.parent_ul.find(params.defaultIcon).addClass(params.active_class_name);
				
                AddFormating();
                ShowActiveSubnav();
            }

            function ShowActiveSubnav() {
				var subnav = params.parent_ul.find(params.defaultIcon).find(params.subnav_container);
                subnav.css({'display':'block'});
				subnav.find('span').last().css({'display':'none'});
            }

            function InitButtonActions() {
				params.parent_ul.find('li').hover(function() {
					$(this).find('span').last().hide();
					if($(this).find(params.subnav_container).length > 0) {
						params.parent_ul.find(params.subnav_container).hide();
						$(this).find(params.subnav_container).show();
					}else {
						params.parent_ul.find(params.subnav_container).hide();
						params.parent_ul.find('li.active').find(params.subnav_container).show();	
					}
				});
				
				params.parent_ul.mouseleave(function() {
					params.parent_ul.find(params.subnav_container).hide();
					params.parent_ul.find('li.active').find(params.subnav_container).show();
				});
            }

		}

	});

})(jQuery);