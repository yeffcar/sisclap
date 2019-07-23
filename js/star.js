var arrayMensajes = Array();
jQuery(document).ready(function($) {
	$('#next-step-btn').click(
	function (event) {
		$('.step1').hide('400');
		$('.step2').show('400');
	});
	$('#prev-step').click(
	function (event) {
		$('.step1').show('400');
		$('.step2').hide('400');
	});
	Materialize.updateTextFields();
	$('.button-collapse').sideNav();
	$('.modal-trigger').leanModal();
	$('.materialboxed').materialbox();
	$('.tooltipped').tooltip({delay: 50});
	$('select').material_select();
	$('.parallax').parallax();
	$('.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrain_width: false, // Does not change width of dropdown to that of the activator
			hover: false, // Activate on hover
			gutter: 0, // Spacing from edge
			belowOrigin: true, // Displays dropdown below the button
			alignment: 'right' // Displays dropdown with edge aligned to the left of button
	});
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15 // Creates a dropdown of 15 years to control year
	  });
	$('.scrollspy').scrollSpy();
	
   $('[data-select-img]').click(function(event) {
		var name = $(this).find('.img').attr('data-name');
		var target = $('#modal1').attr('data-field');
		$('#'+target).val(name);
		$('#modal1').closeModal();
	});

   if($('.tabs-wrapper').length){
		$('.tabs-wrapper').pushpin({ top: $('.tabs-wrapper').offset().top });
   }
	fn_navigate_files();
	fn_delete_data();
	fn_change_state();
	fn_checkvalue();
	fn_check_multiple_card();
});

var fn_navigate_files = function (argument) {
	if($('[data-navigatefiles="active"]').length){
		fngetDir($('.gallery').attr('data-active-dir'));
		$('[data-expected]').click(function(event) {
			$('[data-expected]').attr('data-expected', 'inactive');
			$(this).attr('data-expected', 'active');
		});
	}
}

function fngetDir(strdir) {
	$('.gallery').attr('data-active-dir',strdir);
	$.ajax({
	url: str_base_url+'admin/archivos/ajaxfnGetdir',
	type: 'POST',
	dataType: 'json',
	data: {'directorio': strdir},
	})
	.done(function(json) {
		var html = '<div class="col m3 s4 dir">'
				+'<div class="card"><div class="card-content">'
				+'UP</div>'
				+'<div class="card-action">'
				+'<span class="grey-text text-darken-4 dirname">'
				+json['_parentdir']+'</span></div>'
				+'</div></div>';
		for (var i = json.files.length - 1; i >= 0; i--) {
			var reg = /\.[0-9a-z]{1,5}$/i;
			if (!json.files[i].match(reg) && json.files[i]!='.' && json.files[i]!='..') {
				html += '<div class="col m3 s4 dir">'
					+'<div class="card"><div class="card-content">'
					+'<i class="material-icons">folder</i><br />'
					+'</div>'
					+'<div class="card-action">'
					+'<span class="grey-text text-darken-4 dirname">'
					+strdir+'/'+json.files[i]+'</span></div>'
					+'</div></div>';
			}else{
				if (json.files[i]!='.' && json.files[i]!='..') {
					var strFilename = json.files[i]
					if (strFilename.search('.jpg')>-1 || strFilename.search('.png')>-1 || strFilename.search('.gif')>-1) {
						html += '<div class="col m3 s4 getback"><div class="card"><div class="card-image">'+
						'<img class="activator" src="'+str_base_url+strdir+'/'+json.files[i]+'">'+
						'</div><div class="card-action strFilename" data-back-data="'+strdir.substring(2)+'/'+json.files[i]+'">'+json.files[i]+'</div></div></div>';
					}else{
						html += '<div class="col m3 s4 file">'
						+'<div class="card"><div class="card-content">'
						+'<i class="material-icons">description</i><br />'
						+'</div>'
						+'<div class="card-action">'
						+'<span class="grey-text text-darken-4 dirname">'
						+json.files[i]+'</span></div>'
						+'</div></div>';
					}
				}
			}
		}
		$('.gallery').html(html);
		$('.gallery .dir').click(function(event) {
			var strdirectorio = $(this).find('.dirname').html();
			fngetDir(strdirectorio);
		});
		fnSetBackFile();
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

var fnSetBackFile = function(){
	$('.getback').click(function(event) {
		var element = $(this);
		var strFilename = element.find('.strFilename').attr('data-back-data');
		$('[data-expected="active"]').val(strFilename);
		$('[data-expected]').attr('data-expected', 'inactive');
		$('#modal1').closeModal();
	});
}

var fn_delete_data = function () {
	//Set the target event
	$('[data-ajax-action]').click(function(event) {
		$('[data-ajax-action]').attr('data-ajax-action', 'inactive');
		$(this).attr('data-ajax-action', 'active');
	});
	//Set the acept event
	$('[data-action="acept"]').click(function(event) {
		if (!$('.multiple-active').length) {
			var elementref = $('[data-ajax-action=active]');
			var elementdata = $.parseJSON(elementref.attr('data-action-param'));
			if (elementref.attr('data-where-condition')) {
				elementdata['whereportion'] = $.parseJSON(elementref.attr('data-where-condition'));
			}
			$.ajax({
				url: str_base_url+elementref.attr('data-url'),
				type: 'POST',
				dataType: 'json',
				data: elementdata,
			})
			.done(function(json) {
				if (elementref.attr('data-url-redirect')) {
						window.location = str_base_url+elementref.attr('data-url-redirect');
				}else{
					if (json.result) {
						$(elementref.attr('data-target-selector')).remove();
					}
					Materialize.toast(json.message, 4000);
				}
			})
			.fail(function() {
				console.log("error");
			});
		}else{
			var elementref = $('[data-ajax-action=active]');
			var paramdata = $.parseJSON(elementref.attr('data-action-param'));
			var checkboxesElements = $('.card-chekbox-content input[type="checkbox"]:checked');
			paramdata['id'] = Array();
			checkboxesElements.each(function(index, el) {
				paramdata['id'][index] = $(el).val();
				if ($(el).attr('data-where-condition')) {
					paramdata['whereportion'][index] = $(el).attr('data-where-condition');
				}
			});
			$.ajax({
				url: str_base_url+elementref.attr('data-url'),
				type: 'POST',
				dataType: 'json',
				data: paramdata,
			})
			.done(function(json) {
				if (elementref.attr('data-url-redirect')) {
						window.location = str_base_url+elementref.attr('data-url-redirect');
				}else{
					if (json.result) {
						checkboxesElements.each(function(index, el) {
							var str_target_element = $(el).attr('data-target-element');
							$(str_target_element).hide('400', function() {
								$(str_target_element).remove();
							});
							
						});
						$('nav.main-nav').removeClass('multiple-active');
						$('.card-chekbox-content input[type="checkbox"]').removeAttr('checked');
						$('.card-chekbox-content').removeClass('active');
					}
					Materialize.toast(json.message, 4000);
				}
			})
			.fail(function() {
				console.log("error");
			});
		}
	});
}

var fn_change_state = function () {
	$('.change_state').change(function (event) {
		var elementref = $(this);
		var dta = $.parseJSON(elementref.attr('data-action-param'));
		dta['status'] = '0';
		if ($(this).is(':checked')) {
			dta['status'] = '1';
		};
		console.log(dta);
	$.ajax({
			url: str_base_url+elementref.attr('data-url'),
			type: 'POST',
			dataType: 'json',
			data: dta,
		})
		.done(function(json) {
			if (elementref.attr('data-url-redirect')) {
					window.location = str_base_url+elementref.attr('data-url-redirect');
			}else{
				Materialize.toast(json.message, 4000);
			}
		})
		.fail(function() {
			console.log("error");
		});
	});
}

var fn_checkvalue = function () {
	$('.fn_checkvalue').change(function(event) {
		var targetElement = $(this);
		var obj_data = $.parseJSON(targetElement.attr('data-action-param'));
		obj_data['value'] = $(targetElement).val();
		if ($(targetElement).attr('data-value')!= obj_data['value']) {
			var str_segment_url = $(targetElement).attr('data-segment-url');
			jQuery.ajax({
			  url: str_base_url+str_segment_url,
			  type: 'POST',
			  dataType: 'json',
			  data: obj_data,
			  success: function(data, textStatus, xhr) {
				 console.log(str_segment_url+': success');
				 if (data.result) {
				 	targetElement.addClass('invalid');
				 	$('#buttons').hide('400');
				 	
				 }else{
				 	targetElement.addClass('valid');
				 	$('#buttons').show('400');

				 	
				 }
			  },
			  error: function(xhr, textStatus, errorThrown) {
				 console.log(str_segment_url+': error');
			  }
			});
		};
	});
	$('.validate-form form').submit(function(event) {
		if($(this).find('.invalid').length){
			
			return false;
		}
	});
}

var  fn_check_multiple_card = function() {
	$('.done_all , .multiple-options').appendTo('.main-nav .nav-wrapper');
	$('.card-chekbox-content input[type="checkbox"]').change(function(event) {
		var parentElement = $(this).parent('.card-chekbox-content');
		if ($(this).is(':checked')) {
			parentElement.addClass('active');
			$('nav.main-nav').addClass('multiple-active');
		}else{
			parentElement.removeClass('active');
			if (!$('.card-chekbox-content input[type="checkbox"]:checked').length) {
				$('nav.main-nav').removeClass('multiple-active');
			}
		}
	});
	$('.done_all').click(function(event) {
		$('nav.main-nav').removeClass('multiple-active');
		$('.card-chekbox-content input[type="checkbox"]').removeAttr('checked');
		$('.card-chekbox-content').removeClass('active');
	});
}

