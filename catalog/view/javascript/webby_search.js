/* WEBBY ISEARCH SCRIPT */
// Autocomplete */
(function($) {
    $.fn.webby_autocomplete = function(option) {
        return this.each(function() {
            this.timer = null;
            this.items = new Array();

            $.extend(this, option);

            $(this).attr('autocomplete', 'off');

            // Focus
            $(this).on('focus', function() {
                this.request();
            });

            // Blur
            $(this).on('blur', function() {
                setTimeout(function(object) {
                    object.hide();
                }, 200, this);
            });

            // Keydown
            $(this).on('keydown', function(event) {
                switch (event.keyCode) {
                    case 38: // Up Arrow
                        if ($(this).siblings('ul.dropdown-menu').find('li.selected').length) {
                            if ($(this).siblings('ul.dropdown-menu').find('li.selected').prev('li').length)
                                $(this).siblings('ul.dropdown-menu').find('li.selected').removeClass('selected').prev('li').addClass('selected');
                        } else {
                            $(this).siblings('ul.dropdown-menu').find('li:first').removeClass('selected').addClass('selected');
                        }
                        break;
                    case 40: // Down Arrow
                        if ($(this).siblings('ul.dropdown-menu').find('li.selected').length) {
                            if ($(this).siblings('ul.dropdown-menu').find('li.selected').next('li').length)
                                $(this).siblings('ul.dropdown-menu').find('li.selected').removeClass('selected').next('li').addClass('selected');
                        } else {
                            $(this).siblings('ul.dropdown-menu').find('li:first').removeClass('selected').addClass('selected');
                        }
                        break;
                    case 27: // escape
                        this.hide();
                        break;
                    case 13: // escape
                        $(this).siblings('ul.dropdown-menu').find('li.selected a').trigger('click');
                        this.hide();
                        break;
                    default:
                        this.request();
                        break;
                }

                if (event.keyCode == 13)
                    return false;
            });

            // Click
            /*
            this.click = function(event) {
                event.preventDefault();

                value = $(event.target).parent().attr('data-value');

                if (value && this.items[value]) {
                    this.select(this.items[value]);
                }
            }
            */

            // Show
            this.show = function() {
                var pos = $(this).position();

                $(this).siblings('ul.dropdown-menu').css({
                    top: pos.top + $(this).outerHeight(),
                    left: pos.left
                });

                $(this).siblings('ul.dropdown-menu').show();
            }

            // Hide
            this.hide = function() {
                $(this).siblings('ul.dropdown-menu').hide();
            }

            // Request
            this.request = function() {
                clearTimeout(this.timer);

                this.timer = setTimeout(function(object) {
                    object.source($(object).val(), $.proxy(object.response, object));
                }, 200, this);
            }

            // Response
            this.response = function(json, txt_json) {
                html = '';

                if (json.length) {
                    for (i = 0; i < json.length; i++) {
                        this.items[json[i]['name']] = json[i];
                    }

                    for (i = 0; i < json.length; i++) {
                        var price_html = '';
                        if (json[i]['price']) {
                            price_html +='<p class="price">';
                            if (!json[i]['special']) {
                                price_html += json[i]['price'];
                            } else {
                                price_html += '<span class="price-new">'+json[i]['special']+'</span> <span class="price-old">'+json[i]['price']+'</span>';
                            }
                           
                            if (json[i]['tax']) {
                                price_html += '<span class="price-tax">'+txt_json['text_tax']+' '+json[i]['tax']+'</span>';
                           }
                           price_html +='</p>';
                        }

                       html += '<li data-value="' + json[i]['name'] + '"><a class="product" href="'+json[i]['href']+'"><img src="' + json[i]['thumb'] + '" alt="image" />&nbsp;&nbsp;<span class="product-name">' + json[i]['name'] +'</span>'+ price_html+'</a></li>';
                   
                    } 

                    html += '<li data-value=""><a id="view_all_result" href="#" onclick="Wsearch(); return false;">' + txt_json['view_all_result'] + '</a></li>';
                }

                if (html) {
                    this.show();
                } else {
                    this.hide();
                }

                $(this).siblings('ul.dropdown-menu').html(html);
            }

            $(this).after('<ul class="dropdown-menu"></ul>');
            $(this).siblings('ul.dropdown-menu').delegate('a.product', 'click', $.proxy(this.click, this));

        });
    }
})(window.jQuery);

function Wsearch(){
    $('#search input[name=\'search\']').parent().find('button').trigger('click');
}

$(function(){
	$('input[name=\'search\']').webby_autocomplete({
	    source: function(request, response) {
	        $.ajax({
	            url: 'index.php?route=module/webby_search&token=<?php echo $token; ?>&search=' + encodeURIComponent(request),
	            dataType: 'json',
	            success: function(json) {
	                response($.map(json['products'], function(item) {
	                    return {
	                        product_id: item['product_id'],
	                        thumb: item['thumb'],
	                        name: item['name'],
	                        description: item['description'],
	                        price: item['price'],
	                        special: item['special'],
	                        tax: item['tax'],
                            text_tax: item['text_tax'],
	                        minimum: item['minimum'],
	                        rating: item['rating'],
	                        href: item['href']
	                    }
	                }), json['text']);
	            }
	        });
	    },
	    select: function(item) {
	    	if(typeof(item['href'])!='undefined'){
	            window.location = item['href'];
	            return false;	    		
	    	}


	        $('#search input[name=\'search\']').unbind('keydown').val(item['name']);
			$('header input[name=\'search\']').parent().find('button').trigger('click');
	    }
	});
});
/* WEBBY ISEARCH SCRIPT */