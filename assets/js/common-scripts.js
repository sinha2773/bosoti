var empty_method = function(data){
	console.log(data);
}
var error_method = function(data){
	console.log(data);
}

var callHttp = function(action, params, success_method, data_type){
	var apiservice = base_url+action;
	var success_method = success_method === undefined ? empty_method : success_method;
	var data_type = data_type === undefined ? "json" : data_type;
	$.ajax({
        type: 'POST',
        async: true,
        dataType: data_type,
        url: apiservice,
        data: params,
        success: success_method,
        error: error_method
    });
};

var $ = jQuery;

var Script = function () {
//    tool tips
    $('.tooltips').tooltip();
//    popovers
    $('.popovers').popover();
}();

(function() {
		$('<i id="back-to-top"></i>').appendTo($('body'));
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		
		$('#back-to-top').click(function() {
			$('body,html').animate({scrollTop:0},600);
		});	
})();

//Registration form validation
function isValidateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function validateMobile(mobile) {
    var re = /^[0-9-+]+$/;
    return re.test(mobile);
}
