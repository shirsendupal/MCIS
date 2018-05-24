var AppCallSuffix = '/mcis';

$(document).ready(function($) {
	$("#ModelName").autocomplete({
		source: function (request, response) {
			 $.ajax({
				 url: AppCallSuffix+'/model/get_model_suggestion',
				 type: "GET",
				 dataType: "json",
				 data: { ModelName: $("#ModelName").val()},
				 success: function (data) {
					 response(data);
				 }
			 });
		},
		select: function (event, ui) {
			$('#ModelName').val(ui.item.value);
			$('#Manufacturer').val(ui.item.id);
			event.preventDefault();
		},
		minLength: 2
	});
		
	$("#ModelForm").on('submit',(function(e){
		e.preventDefault();		
		$('#AjaxLoaderImg').show();
		$.ajax({
			url: AppCallSuffix+'/model/add_model',
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				$('#AjaxLoaderImg').hide();
				var dataObj = jQuery.parseJSON(data);				
				if(dataObj.Status=='TRUE'){
					$('#ModelName').val('');
					$('#Manufacturer').val('');
					$('#ModelColor').val('');
					$('#ModelYear').val('');
					$('#ModelRegistrationNo').val('');
					$('#ModelNote').val('');
					$('#ModelUploadFile1').val('');
					$('#ModelUploadFile2').val('');
					$('#AlertErrorSection').html('');
					$('#AlertSuccessSection').html('<strong>Yeah!</strong> '+dataObj.Message);
					$('#AlertSuccessSection').show();
					$('#AlertErrorSection').hide();
				}

				else{
					$('#AlertSuccessSection').html('');
					$('#AlertErrorSection').html('<strong>Oops!</strong> '+dataObj.Message);
					$('#AlertSuccessSection').hide();
					$('#AlertErrorSection').show();
				}
			},
			error: function(){
				$('#AjaxLoaderImg').hide();
			} 	        
		});
	}));	
		
	setInterval(
			function(){ 
				var UpdatedAt = $.trim($('#ModelViewUpdatedAt').html());
				$.ajax({
					url: AppCallSuffix+'/model/check_model_updates',
					type: 'GET',
					data: { UpdatedAt: UpdatedAt },
					success: function(response, status, xhr) {
						response = $.trim(response);
						var dataObj = jQuery.parseJSON(response);
						var dataObjs = dataObj.Data;
						$('#ModelViewUpdatedAt').html(dataObj.UpdatedAt);						
						if(dataObjs.length>0){
							getUpdatedView();
							$.each(dataObjs, function(i, item){
								alert('Model "'+item.model_name+'" is sold');
								try{
									var modelCardObj = $("#ModelDetailSoldBtn_"+item.id);
									if(modelCardObj.length){
										modelCardObj.removeClass("btn-primary");
										modelCardObj.addClass("btn-secondary");
										modelCardObj.attr('onclick','').unbind('click');
									}								
								}
								catch(Ex){}
							});
						}
					}
				});
			}, 4000
		);

		
});

function getUpdatedView(){
	$.ajax({
		url: AppCallSuffix+'/model/get_latest_inventory_view',
		type: 'GET',
		success: function(data, status, xhr) {
			data = $.trim(data);
			if(data!=''){
				$('#InventoryViewSection').html(data);
			}
		}
	});
}

function addManufacturer(){
	$('#AlertSuccessSection').hide();
	$('#AlertErrorSection').hide();
	$('#AlertError2Section').hide();
	var ManufacturerName = $('#ManufacturerName').val();
	if(ManufacturerName!=''){
		$('#AjaxLoaderImg').show();
		$.ajax({
			url: AppCallSuffix+'/manufacturer/add',
			type: 'POST',
			data: { ManufacturerName: ManufacturerName },
			success: function(data, status, xhr) {
				$('#AjaxLoaderImg').hide();
				data = $.trim(data);
				if(data=='TRUE'){
					$('#AlertSuccessSection').show();
					$('#ManufacturerName').val('');				
				}
				else if(data=='EXIST'){
					$('#AlertError2Section').show();
				}
				else{
					$('#AlertErrorSection').show();					
				}
			},
			error: function(jqXhr, textStatus, errorMessage) {
				$('#AjaxLoaderImg').hide();
				$('#AlertErrorSection').show();
			}
		});		
	}
	else{
		alert('Manufacturer Name is manditory');
	}
}

function clearManufacturerForm(){
	$('#ManufacturerName').val('');
	$('#AlertSuccessSection').hide();
	$('#AlertErrorSection').hide();
	$('#AlertError2Section').hide();
}

function clearModelForm(){
	$('#ModelName').val('');
	$('#Manufacturer').val('');
	$('#ModelColor').val('');
	$('#ModelYear').val('');
	$('#ModelRegistrationNo').val('');
	$('#ModelNote').val('');
	$('#ModelUploadFile1').val('');
	$('#ModelUploadFile2').val('');
		
	$('#AlertSuccessSection').hide();
	$('#AlertErrorSection').hide();
}

function showModelDetails(modelName){
	$('#ModelDetailsSection').html('');
	$.ajax({
		url: AppCallSuffix+'/model/get_model_details',
		type: 'GET',
		data: { ModelName: modelName },
		success: function(data, status, xhr) {
			data = $.trim(data);
			$('#ModelDetailsSection').html(data);
			$('#ModelDetailsPopupSection').modal('show');

		},
		error: function(jqXhr, textStatus, errorMessage) {
			alert('Please try again');
		}
	});
}
		
function saleModel(modelId){	
	$.ajax({
		url: AppCallSuffix+'/model/sale_model',
		type: 'GET',
		data: { ModelId: modelId },
		success: function(data, status, xhr) {
			data = $.trim(data);
			if(data=='TRUE'){
				getUpdatedView();
				$('#ModelDetailSection_'+modelId).remove();
				if($('.card').length==0){
					$('#ModelDetailsPopupSection').modal('hide');
				}
			}
			else{
				alert('Please try again');
			}
		},
		error: function(jqXhr, textStatus, errorMessage) {
			alert('Please try again');
		}
	});
}


