<html ng-app="invoice" ng-controller="add_invoice">
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script>
		var app = angular.module("invoice", []); 
		app.controller("add_invoice", function($scope) {
			jQuery("#submit").prop("disabled", true);
			jQuery("#due_timestamp").hide();
			validate = function (){
				if($('input[name=title').val() != "" ){
						jQuery("#submit").prop("disabled", false);
					}else{
							jQuery("#submit").prop("disabled", true);
						}
			}
			$('input[name=title').keyup(function () {
				validate();
			});
			$('input[name=invoice_number').keyup(function () {
				alert('invoice_number');
				validate();
			});

			$('#medicine_id').change(function(){
			     
				 validate();
			});
			
			$('#price').keyup(function(){
			     
				 validate();
			});
			
			$('#quantity').keyup(function(){
				 validate();
			});
			
			$('#payment_status').change(function(){
				if($('#payment_status').val() == "unpaid"){
					jQuery("#due_timestamp").show();
				}else{
					jQuery("#due_timestamp").hide();
					}
				 validate();
			});
			
			$('input[name=patient_id').keyup(function () {
				validate();
			});
			
			$('input[name=creation_timestamp').keyup(function () {
				validate();
			});
			
			$('input[name=due_timestamp').keyup(function () {
				validate();
			});
			
			var refresh = function(){
				$.ajax({
	 				url:"<?php echo base_url();?>/index.php?pet_relocation/invoice_manage/get_all_medicine",
	 				dataType:"json",
	 				type:"post",
	 				success:function(data){
					$scope.$apply(function(){
						$scope.medicine1 = data.data;

					})
	 				}
	 			});
			}
			refresh();

			
			$scope.add_medicine1 = [{
				name1:'quantity',
				name2:'price',
				name3:'medicine',
		    }];
			 $scope.add_medicine = function()
			    {
			        var new_item = 
				        {
							name1:'quantity',
							name2:'price',
							name3:'medicine',
					    };
			        	$scope.add_medicine1.push(new_item);
			    }
		});
	</script>
	
	<script>
    var blank_invoice_entry = '';
    $(document).ready(function () {
        blank_invoice_entry = $('#invoice_entry').html();
    });

    function add_entry()
    {
        $("#invoice_entry").append(blank_invoice_entry);
    }
   

    // REMOVING INVOICE ENTRY
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

</script>
	</head>
	<body>
		<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_invoice'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open('breeder/invoice_add/create', array('class' => 'form-horizontal form-groups validate invoice-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('invoice_title'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('invoice_number'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="invoice_number"  value="<?php echo rand(10000, 100000); ?>"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fees'); ?></label>

                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="fees">
                    </div>
                </div>
                 <hr>

                <!-- FORM ENTRY STARTS HERE-->
                <div  ng-repeat="medicine in add_medicine1" >
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('add_product'); ?></label>
                        <div class="col-sm-2">
                        <select id="medicine_id" name="medicine_id[]" class="form-control" ng-options="item.medicine_id as item.name for item in medicine1 track by item.medicine_id" ng-model="selected">
                        	<option value="" selected="" disabled="">Select Product<option>
                        </select>
                        </div>

                        <div class="col-sm-3">
                            <input id="quantity" type="text" class="form-control" name="quantity[]"  value="" 
                                   placeholder="<?php echo get_phrase('quantity'); ?>" >
                        </div>
                        <div class="col-sm-2">
                            <input id="price" type="text" class="form-control" name="price[]"  value="" 
                                   placeholder="<?php echo get_phrase('price (Unit)'); ?>" >
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
                                <i class="entypo-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <!-- FORM ENTRY ENDS HERE-->


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="button" class="btn btn-default btn-sm btn-icon icon-left"
                                ng-click="add_medicine()">
                                    <?php echo get_phrase('add_more_product'); ?>
                            <i class="entypo-plus"></i>
                        </button>
                    </div>
                </div>

                <hr>
                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_pet'); ?></label>

                    <div class="col-sm-5">
                        <select name="patient_id" class="select2">
                            <option><?php echo get_phrase('select_pet_name'); ?></option>
                            <?php
                            $patients = $this->db->get_where('patient',array('user_id' =>$this->session->userdata('login_user_id') ))->result_array();
                            foreach ($patients as $row2):
                                ?>
                                <option value="<?php echo $row2['patient_id']; ?>">
                                    <?php echo $row2['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('creation_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="creation_timestamp"  
                                   value="<?php echo date("m/d/Y"); ?>" >
                        </div>
                    </div>
                </div>

               


                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('payment_status'); ?></label>

                    <div class="col-sm-5">
                        <select name="status" class="selectboxit" id="payment_status">
                            <option><?php echo get_phrase('select_a_status'); ?></option>
                            <option value="paid"><?php echo get_phrase('paid'); ?></option>
                            <option value="unpaid"><?php echo get_phrase('unpaid'); ?></option>
                        </select>
                    </div>
                </div>
                 <div class="form-group" id="due_timestamp">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('due_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="due_timestamp"  
                                   value="" >
                        </div>
                    </div>
                </div>


                <hr>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button id="submit" type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('create_new_invoice'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
		
	</body>
</html>

