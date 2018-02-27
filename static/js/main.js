/*! Dobby v1.0 */
;(function () {
	
	'use strict';

	var navbarConfig = function() {

		function menuConf(){
			$('.navbar-collapse').toggleClass('show');
			$('.nav-list').toggleClass('nav-close');
		};

		$('[data-toggle="menu"]').on('click', function (e) {
			// TODO: add .collapsing
			menuConf();
			$(document).one("click", function() {
				menuConf();
			});
			e.stopPropagation();
			return false;
		});
	};

	var wowConfig = function() {
		new WOW().init();
	};

	var stickConfig = function() {
		 $('#sticky').stick_in_parent({offset_top:56});
		 $('#stickyindex').stick_in_parent({offset_top:80});
		 $('#stickysingle').stick_in_parent({offset_top:70});
	};

	var sliderConfig = function() {
		
	  	$('#home-slider .flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

	  	});
	};

	var postlikeConfig = function() {
		$.fn.postLike = function() {
			if ($(this).hasClass('done')) {
				layer.msg(v3.repeat, function() {});
				return false;
			} else {
				$(this).addClass('done');
				layer.msg(v3.thanks);
				var id = $(this).data("id"),
					action = $(this).data('action');
				var ajax_data = {
					action: "love",
					um_id: id,
					um_action: action
				};
				$.post( v3.site+'/wp-admin/admin-ajax.php', ajax_data, function(data) {});
				return false;
			}
		};
		$(document).on("click", ".btn-thumbs", function() {
			$(this).postLike();
		});
	};

	var donateConfig = function(){
		$("#donate").on('click', function(){
			layer.open({
				type: 1,
				area: ['300px', '370px'],
				title:v3.donate,
				resize:false,
				scrollbar: false,
				content: '<div class="donate-box"><div class="meta-pay text-center my-2"><strong>'+v3.scan+'</strong></div><div class="qr-pay text-center"><img class="pay-img" id="alipay_qr" src="'+v3.alipay+'"><img class="pay-img d-none" id="wechat_qr" src="'+v3.wechat+'"></div><div class="choose-pay text-center mt-2"><input id="alipay" type="radio" name="pay-method" checked><label for="alipay" class="pay-button"><img src="'+v3.directory+'/static/images/payment/alipay.png"></label><input id="wechatpay" type="radio" name="pay-method"><label for="wechatpay" class="pay-button"><img src="'+v3.directory+'/static/images/payment/wechat.png"></label></div></div>'
			});
			$(".choose-pay input[type='radio']").click(function(){
				var id= $(this).attr("id");
				if (id=='alipay') { $(".qr-pay #alipay_qr").removeClass('d-none');$(".qr-pay #wechat_qr").addClass('d-none') };
				if (id=='wechatpay') { $(".qr-pay #alipay_qr").addClass('d-none');$(".qr-pay #wechat_qr").removeClass('d-none') };
			});
		});
	};

	var copyrightConfig = function(){
		$('#copyright').mouseenter(function(){
		  var copyright = this;
		  layer.tips( v3.copyright, copyright, { tips: 1, time: 0, isOutAnim: false });
		});
		$('#copyright').mouseleave(function(){
		  var index = layer.tips();
		  layer.close(index);
		});
	};

	var smiliesConfig = function() {
		$('#addsmile').on("click", function(e) {
			$('.smile').toggleClass('open');
			$(document).one("click", function() {
				$('.smile').toggleClass('open');
			});
			e.stopPropagation();
			return false;
		});
	};

	var packupConfig = function() {
		$('.gotop-btn').on('click', function(event){
			event.preventDefault();
			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			return false;
		});

		$(window).scroll(function(){
			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.gotop-box').addClass('active');
			} else {
				$('.gotop-box').removeClass('active');
			}
		});
	};

	var indexscrollConfig = function(){
		$("#articlepage").on('click','a', function(){     
		    $(this).addClass('loading').text('');
		    var href = $(this).attr("href");
		    if (href != undefined) {
		        $.ajax( {
		            url: href,
		            type: "get",
		        beforeSend:function(){
		           $(".loading").append('<div class="loading-box"><div></div><div></div><div></div></div>');
		        },
		        error: function(request) {},   
		        success: function(data) {
		            $("#articlepage a").removeClass('loading').text(v3.more); 
		            var $res = $(data).find(".gamma-item");
		            $('.gamma-list').append($res.fadeIn('slow'));
		            var newhref = $(data).find("#articlepage a").attr("href");
		            if( newhref != undefined ){   
		                $("#articlepage a").attr("href",newhref);   
		            }else{   
		                $("#articlepage").hide();
		            }   
		        }   
		        });   
		    }   
		    return false;   
		});
	};

	var categoryscrollConfig = function(){
		$("#categorypage").on('click','a', function(){     
		    $(this).addClass('loading').text('');
		    var href = $(this).attr("href");
		    if (href != undefined) {
		        $.ajax( {
		            url: href,
		            type: "get",
		        beforeSend:function(){
		           $(".loading").append('<div class="loading-box"><div></div><div></div><div></div></div>');
		        },
		        error: function(request) {},
		        success: function(data) {
		            $("#categorypage a").removeClass('loading').text(v3.more); 
		            var $res = $(data).find(".category-item");
		            $('.category-list').append($res.fadeIn('slow'));
		            var newhref = $(data).find("#categorypage a").attr("href");
		            if( newhref != undefined ){   
		                $("#categorypage a").attr("href",newhref);   
		            }else{   
		                $("#categorypage").hide();
		            }   
		        }   
		        });   
		    }   
		    return false;   
		});
	};

	var commentscrollConfig = function(){
		$("#commentpage").on('click','a', function(){     
		    $(this).addClass('loading').text('');
		    var href = $(this).attr("href");
		    if (href != undefined) {
		        $.ajax( {
		            url: href,
		            type: "get",
		        beforeSend:function(){
		           $(".loading").append('<div class="loading-box"><div></div><div></div><div></div></div>');
		        },
		        error: function(request) {},
		        success: function(data) {
		            $("#commentpage a").removeClass('loading').text(v3.more); 
		            var $res = $(data).find(".comment");
		            $('.list').append($res.fadeIn('slow'));
		            var newhref = $(data).find("#commentpage a").attr("href");
		            if( newhref != undefined ){   
		                $("#commentpage a").attr("href",newhref);   
		            }else{   
		                $("#commentpage").hide();
		            }   
		        }   
		        });   
		    }   
		    return false;   
		});
	};

	$(function(){
		navbarConfig();
		wowConfig();
		stickConfig();
		sliderConfig();
		postlikeConfig();
		donateConfig();
		copyrightConfig();
		smiliesConfig();
		packupConfig();
		indexscrollConfig();
		categoryscrollConfig();
		commentscrollConfig();
	});
	
}());

function grin(tag) {
    var myField;
    tag = ' ' + tag + ' ';
    if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
    } else {
        return false;
    }
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
    }
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = endPos;
        myField.value = myField.value.substring(0, startPos)
                      + tag
                      + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
    }
    else {
        myField.value += tag;
        myField.focus();
    }
};