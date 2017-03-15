<html ng-app="invoice" ng-controller="add_invoice" ng-cloak>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script>
		var app = angular.module("invoice", []); 
		app.controller("add_invoice", function($scope) {
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
//initializing datepicker
$('.datepicker').datepicker({format:'yyyy-mm-dd', startDate: today });

			$scope.calculate_price = function(quantity,index){
				$scope.medicine[index]['quantity'] = quantity;
				$scope.medicine[index]['price'] = $scope.medicine[index]['quantity'] * $scope.actual_price;
				
				 $('input[name=total_amount').val($scope.total()) ;
				 $('input[name=vat_percentage').val(Math.round(($scope.total() * $('#vat_percentage').val()) / 100)) ;
				 $('input[name=final_amount').val($scope.final_amount()) ;
			}
			
			$scope.get_product_data = function(selectedItem,index){
				validate();
				
				$.ajax({
	 				url:"<?php echo base_url();?>/index.php?doctor/get_medicine_data",
	 				dataType:"json",
	 				type:"post",
	 				data:{"medicine_id":selectedItem},
	 				success:function(data){
						$scope.$apply(function(){
							$scope.actual_price = data[0].price;
							$scope.medicine[index]['price'] = $scope.medicine[index]['quantity'] * data[0].price;
							  $('input[name=total_amount').val($scope.total()) ;
							  $('input[name=vat_percentage').val(Math.round(($scope.total() * $('#vat_percentage').val()) / 100)) ;
$('input[name=final_amount').val($scope.final_amount()) ;
							})
	 				}
	 			});
			}
			$scope.calculate_service_tax = function(value){
			   
			    $('#service_tax1').val(Math.round((value * $('#service_tax').val()) / 100));
			    $('input[name=final_amount').val($scope.final_amount()) ;
			}
			$scope.deleteParentElement = function(index){
				$scope.medicine.splice(index, 1);  
		     }
			 $scope.service_tax =  $('#service_tax').val();
			 $scope.vat_percentage =  $('#vat_percentage').val();
			 
			$scope.total = function(){
				var total = 0;
				angular.forEach($scope.medicine, function(value, key) {
					total += Number(value.price);
				});
				return total;
			}
			$scope.final_amount = function(){
				var total = 0;
					total += Number($scope.total());
					total += Number($('input[name=vat_percentage').val());
					total += Number( $('input[name=service_tax').val());
					total += Number( $('input[name=fees').val());
				return total;
			}
			
			
			jQuery("#due_timestamp").hide();
			validate = function (){
				
			}
			$('input[name=title').keyup(function () {
				
				validate();
			});
			
			$('input[name=fees').keyup(function () {
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
			
			$('input[name=creation_timestamp').change(function () {
				validate();
			});
			
			$('input[name=due_timestamp').keyup(function () {
				validate();
			});
			
			var refresh = function(){
				$.ajax({
	 				url:"<?php echo base_url();?>/index.php?doctor/invoice_manage/get_all_medicine",
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

			
			$scope.medicine = [{
				 quantity : 1,
				
		    }];
			 $scope.add_medicine = function()
			    {
			        var new_item = 
				        {
					         quantity : 1,
                                                 required: "true",
					};
			        $scope.medicine.push(new_item);
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
    function deleteParentElement(n,id) {
        $("#total_amount").val($("#total_amount").val() - $("#price_" + id).val());
        $("#final_amount").val($("#final_amount").val() - $("#price_" + id).val());
        $('input[name=vat_percentage').val(Math.round($('input[name=vat_percentage').val() - ( ($("#price_" + id).val() * $('#vat_percentage').val()) /100)));
        $("#final_amount").val(Math.round($("#final_amount").val() - ( ($("#price_" + id).val() * $('#vat_percentage').val()) /100)));
        
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
 <p> * Fields are Mandatory</p>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open('doctor/invoice_add/create', array('class' => 'form-horizontal form-groups validate invoice-add', 'enctype' => 'multipart/form-data')); ?>
                
                <input type="hidden" id="service_tax" value=" <?php $service_tax = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax;
                                        echo $service_tax;
                                    ?>">
                <input type="hidden" id="vat_percentage" value=" <?php $vat_percentage = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage;
                                        echo $vat_percentage;
                                    ?>">
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('invoice_title'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title"  autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('invoice_number'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="invoice_number"  value="<?php echo rand(10000, 100000); ?>"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fees *'); ?></label>

                    <div class="col-sm-5">
                        <input type="number" ng-model="fees" ng-keyup="calculate_service_tax(fees)" class="form-control" name="fees" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Service Tax ({{service_tax}} %)</label>

                    <div class="col-sm-5">
                        <input type="text" id="service_tax1" class="form-control" name="service_tax" readonly>
                    </div>
                </div>
                 <hr>

                <!-- FORM ENTRY STARTS HERE-->
                <div  ng-repeat="medicine in medicine" >
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('add_product *'); ?></label>
                        <div class="col-sm-2">
                        <select ng-change="get_product_data(medicine.medicine_id,$index)"  ng-model="medicine.medicine_id" id="medicine_id" name="medicine_id[]" class="form-control" ng-options="item.medicine_id as item.name for item in medicine1 track by item.medicine_id" ng-model="selected" ng-required="true">
                        	<option value="" selected="" disabled="">Select Product<option>
                        </select>
                        </div>

                        <div class="col-sm-3">
                            <input ng-change="calculate_price(medicine.quantity,$index)" ng-model="medicine.quantity" id="quantity" type="text" class="form-control" name="quantity[]"  value="" 
                                   placeholder="<?php echo get_phrase('quantity'); ?>" ng-required="true">
                        </div>
                        <div class="col-sm-2">
                            <input ng-model="medicine.price" id="price_{{$index}}" type="text" class="form-control" name="price[]"  value="" 
                                   placeholder="<?php echo get_phrase('price (Unit)'); ?>" readonly>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="{{$index}}" class="btn btn-default" ng-click="deleteParentElement($index)" onclick="deleteParentElement(this,this.id)">
                                <i class="entypo-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
              


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="button" class="btn btn-default btn-sm btn-icon icon-left"
                                ng-click="add_medicine()">
                                    <?php echo get_phrase('add_more_product'); ?>
                            <i class="entypo-plus"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_amount'); ?></label>

                    <div class="col-sm-5">
                            <input type="number" name="total_amount"  id="total_amount" class="form-control" readonly>
                           
                    </div>
                </div>
                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Vat Percentage ({{vat_percentage}} %)</label>

                    <div class="col-sm-5">
                            <input type="number" name="vat_percentage"  id="vat_percentage" class="form-control" readonly>
                           
                    </div>
                </div>

                <hr>
                 
                
                
                
                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Final Amount</label>

                    <div class="col-sm-5">
                            <input type="number" name="final_amount"  id="final_amount" class="form-control" readonly>
                           
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_pet *'); ?></label>

                    <div class="col-sm-5">
                        <select id="selected_pet" name="patient_id" class="form-control" required>
                            <option value="" selected><?php echo get_phrase('select_pet_-Parent_name'); ?></option>
                            <?php
                            $patients = $this->db->get_where('patient',array('doctor_id' =>$this->session->userdata('login_user_id') ))->result_array();
                            foreach ($patients as $row2):
                                ?>
                                <option value="<?php echo $row2['patient_id']; ?>">
                                    <?php echo $row2['name']; ?>-<?php echo $row2['parent_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

              <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('payment_status *'); ?></label>

                    <div class="col-sm-5">
                        <select name="status" class="form-control" id="payment_status" required>
                             <option value="" selected><?php echo get_phrase('select_a_status'); ?></option>
                            <option value="paid"><?php echo get_phrase('paid'); ?></option>
                            <option value="unpaid"><?php echo get_phrase('unpaid'); ?></option>
                        </select>
                    </div>
                </div>
                
                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('creation_date *'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="creation_timestamp"  
                                   value="<?php echo date("m/d/Y"); ?>" required>
                        </div>
                    </div>
                </div>

               


                
                 <div class="form-group" id="due_timestamp">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('due_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="due_timestamp"  
                                   value="" required>
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

