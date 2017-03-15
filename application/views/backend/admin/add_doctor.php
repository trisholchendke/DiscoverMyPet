<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	
	validate = function (){
		
	}
	$('input[name=name]').keyup(function () {
		validate();
	});
	$('input[name=email]').keyup(function () {
		validate();
	});
	$('input[name=password]').keyup(function () {
		validate();
	});
	$('input[name=address]').keyup(function () {
		validate();
	});
	$('input[name=phone]').keyup(function () {
		validate();
	});
	$('#department').change(function () {
		validate();
	});
})
</script>
<?php $department_info = $this->db->get('department')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_doctor'); ?></h3>
                     <p> * Fields are Mandatory</p>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" id="add_doctor" action="<?php echo base_url(); ?>index.php?admin/doctor/create" method="post" enctype="multipart/form-data">
					
					<!--First row-->
					<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('name *'); ?></label>                        
                            <input type="text" name="name" class="form-control" id="field-1" required>  
                       
                    </div>
					</div>
<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('Order Id'); ?></label>                        
                           
<input type="text" name="order_id" class="form-control" id="field-1"  value="<?php echo rand(10000, 100000);  ?>" readonly>                        
                    </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('email *'); ?></label>                        
                            <input type="email" name="email" class="form-control" id="field-1" required>                       
                    </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('password *'); ?></label>                        
                            <input type="password" name="password" class="form-control" id="field-1" required>                        
                    </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                        <label for="field-ta" class="control-label"><?php echo get_phrase('address'); ?></label>                        
                            <textarea name="address" class="form-control" id="field-ta"></textarea>                        
                    </div>
					</div>
					
					</div>
					<!--first row ends-->

					
					
					<!--Second row-->
					<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('phone * '); ?></label>                        
                            <input   name="phone" class="form-control" id="field-1" pattern="\d{10}" title="Please enter exactly 10 digits" required>                        
                    </div>
					</div>
<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('alternate_contact_no '); ?></label>                        
                            <input  min="0" name="alternate_contact_no1" pattern="\d{8,11}" title="pleaze enter min 8 digits & max 11 digits number" class="form-control" id="field-1">                        
                    </div>
					</div>
<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('alternate_contact_no'); ?></label>                        
                            <input  name="alternate_contact_no2" pattern="\d{8,11}" title="pleaze enter min 8 digits & max 11 digits number" class="form-control" id="field-1">                        
                    </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('vci_registration_no'); ?></label>                            
                                <input type="text" name="registration_no" class="form-control" id="field-1">                            
                        </div>
					</div>
<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('state_council_registration_no'); ?></label>                            
                                <input type="text" name="state_council_registration_no" class="form-control" id="field-1">                            
                        </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('clinic_name *'); ?></label>
                                <input type="text" name="clinic_name" class="form-control" id="field-1" required>                            
                        </div>
					</div>
<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('website_name'); ?></label>
                                <input type="text" name="website_name" class="form-control" id="field-1">                            
                        </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('vat_percentage (%)'); ?></label>                            
                                <input type="number" name="vat_percentage" class="form-control" id="field-1">                            
                        </div>
					</div>
					
					</div>
					<!--second row ends-->
					
					
					
					
					<!--third row-->
					<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('service_tax (%)'); ?></label>                            
                                <input type="number" name="service_tax" class="form-control" id="field-1">                            
                        </div>
					</div>
<div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('payment_amount *'); ?></label>                            
                                <input type="number" name="payment_amount" class="form-control" id="field-1" required>                            
                        </div>
					</div>


<div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('payment_by *'); ?></label>                            
                                <input type="text" name="payment_by" class="form-control" id="field-1" required>                            
                        </div>
					</div>


					
					<div class="col-md-3 col-sm-3 col-xs-12">
					                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('clinic_image'); ?></label>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="http://placehold.it/200x150" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="clinic_image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>                     
                        </div>
					</div>
					
					<div class="col-md-3 col-sm-3 col-xs-12">
					
                    
                    <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('profile_image'); ?></label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x150" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="image" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                    </div>
					</div>
					
					
					
					</div>
					<!--third row ends-->
                    
					<div class="row text-center">
                    
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
                    
					</div>
                </form>

            </div>

        </div>

    </div>
</div>
