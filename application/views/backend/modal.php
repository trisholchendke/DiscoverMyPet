    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax" style="top:-25px;">
        <div class="modal-dialog" style="width: 70%">
            <div class="modal-content">

                <div class="modal-body" style="height:750px;overflow:auto;overflow-x:hidden;padding: 6px;-webkit-box-shadow: -1px 3px 21px -3px rgba(0,0,0,0.75);-moz-box-shadow: -1px 3px 21px -3px rgba(0,0,0,0.75);box-shadow: -1px 3px 21px -3px rgba(0,0,0,0.75);">
                
                    
                    
                </div>
               
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url , post_refresh_url)
	{
		$('#preloader-delete').html('');
		jQuery('#modal_delete').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute("onClick" , "delete_data('" + delete_url + "' , '" + post_refresh_url + "')" );
		document.getElementById('delete_link').focus();
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal_delete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                	<span id="preloader-delete"></span>
                    </br>
                	  <button type="button" class="btn btn-danger" id="delete_link" onClick=""><?php echo get_phrase('delete');?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="delete_cancel_link"><?php echo get_phrase('cancel');?></button>
                    
                </div>
            </div>
        </div>
    </div>