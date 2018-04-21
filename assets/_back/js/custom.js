var empty_method = function(data){
	console.log(data);
}
var error_method = function(data){
	console.log(data);
}
var before_send_method = function(data){
	//nothing
}

var callHttp = function(action, params, success_method, data_type, before_send){
	var apiservice = base_url+'admin/'+action;
	var success_method = success_method === undefined ? empty_method : success_method;
	var before_send = before_send === undefined ? before_send_method : before_send;
	var data_type = data_type === undefined ? "json" : data_type;
	$.ajax({
        type: 'POST',
        async: true,
        dataType: data_type,
        url: apiservice,
        data: params,
        beforeSend: before_send,
        success: success_method,
        error: error_method
    });
};


var read_image = function(event, value, container) {
    var container = container==undefined ? 'reader_image' : container;
    var reader = new FileReader();
    reader.onload = function() {
        var displayContainer = document.getElementById(container);        
        displayContainer.src = reader.result;
    };

    if(container=='reader_image')
    document.getElementById('media_id').value = '';
    if(container=='reader_image2')
    document.getElementById('media_id2').value = '';

    reader.readAsDataURL(event.target.files[0]);
};

function addFileContainer(container){
    $('#'+container).append('<input class="form-control" type="file" name="files[]">');
}

jQuery(document).ready(function(){

    // media during update
    $('.old_media_close').click(function(){
        if( confirm("Are you sure to remove?") ){
            $(this).parent('.old_media_container').remove();
        }
    });

    
});