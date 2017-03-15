<!DOCTYPE html>
<html  ng-app="addStaff" ng-controller="add_staff" ng-cloak="">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>
<style>
.loading { border:1px solid #ddd; padding:20px; margin:40px 5px; width:80px;}
</style>
<script>
var app = angular.module("addStaff", []); 
app.controller("add_staff", function($scope) {
// 	$scope.$apply(function(){
			
// 	 $scope.loading = true;
// 		})
});	
app.directive('loading', function () {
    return {
      restrict: 'E',
      replace:true,
      template: '<div class="loading"><img src="http://www.nasa.gov/multimedia/videogallery/ajax-loader.gif" width="20" height="20" />LOADING...</div>',
      link: function (scope, element, attr) {
            scope.$watch('loading', function (val) {
                if (val)
                    $(element).show();
                else
                    $(element).hide();
            });
      }
    }
})
</script>

<div>
  <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_staff'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
             <form  id="form_valid" action="<?php echo base_url(); ?>index.php?restaurants/add_staff/create" method="post" enctype="multipart/form-data" name="add_staff"   role="form" enctype="multipart/form-data" novalidate>
									<input type="hidden" name="doctor_id" value="<?php echo $this->session->userdata('doctor_id'); ?>"> 
									<div class="row">
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.name.$invalid && !add_staff.name.$pristine }">
										<div class="form-group">
											<label class="control-label">Name</label>
											<input type="text" name="name" class="form-control" ng-model="staff.name" required>
											<p ng-show="add_staff.name.$invalid && !add_staff.name.$pristine"
												class="help-block">Staff Name is required
											</p>
										</div>
										</div>
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.email.$invalid && !add_staff.email.$pristine }">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input type="email" name="email" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" class="form-control" ng-model="staff.email" required>
											<p ng-show="add_staff.email.$invalid && !add_staff.email.$pristine"
												class="help-block">Staff Email is required
											</p>
											<p ng-show="add_staff.$error.email"
												class="help-block">Not valid email!
											</p>
										</div>
										</div>
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.role.$invalid && !add_staff.role.$pristine }">
											<div class="form-group">
											<label class="control-label">Role</label>
											<select ng-model="staff.staff_type" name="role" class="form-control" required>
													<option value="" disabled="" selected="">-- Select Option --</option>
													<option>Sub Doctor</option>
						                           	<option>Kennel</option>
						                           	<option>Groomer</option>
						                           	<option>Trainers</option>
						                           	<option>Breeder</option>
						                           	<option>Ambulance Service</option>
						                           	<option>Pet Relocation</option>
						                           	<option>Pet Bakery</option>
						                           	<option>Dog Walker</option>
						                           	<option>Obituary</option>
						                           	<option>Restaurants</option>
						                           	<option>Receptionist</option>
											</select>
											<p ng-show="add_staff.role.$invalid && !add_staff.role.$pristine"
												class="help-block">Staff Role is required
											</p>
										</div>
										</div>
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.password.$invalid && !add_staff.password.$pristine }">
										<div class="form-group">
											<label class="control-label">Password</label>
											<input type="text" name="password" class="form-control" ng-model="staff.password" required>
											<p ng-show="add_staff.password.$invalid && !add_staff.password.$pristine"
												class="help-block">Staff Password is required
											</p>
										</div>
										</div>
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.address.$invalid && !add_staff.address.$pristine }">
										<div class="form-group">
											<label class="control-label">Address</label>
											<textarea rows="" cols="" name="address" class="form-control" ng-model="staff.address" required></textarea>
											<p ng-show="add_staff.address.$invalid && !add_staff.address.$pristine"
												class="help-block">Staff Address is required
											</p>
										</div>
										</div>
										<div class="col-md-6 col-sm-6" ng-class="{ 'has-error' : add_staff.phone.$invalid && !add_staff.phone.$pristine }">
										<div class="form-group">
											<label class="control-label">Phone</label>
											<input rows="" cols="" name="phone" class="form-control" ng-model="staff.phone" ng-pattern="/^\+?\d{2}[- ]?\d{3}[- ]?\d{5}$/" required />
											<p ng-show="add_staff.phone.$invalid && !add_staff.phone.$pristine"
												class="help-block">Staff Phone is required
											</p>
										</div>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<div class="row">
										<div class="col-sm-3 col-md-3 pull-right">
											</div>
											<div class="col-sm-3 col-md-3 pull-right">
													<input  type="submit" class="btn btn-success"  ng-disabled="add_staff.$invalid"  name="register-submit" id="register-submit" tabindex="6" class="form-control btn btn-register" value="Submit">
											</div>
										</div>
									</div>
								</form>
<!-- 								<loading></loading> -->

            </div>

        </div>

    </div>
</div>
</div>


</body>
</html>

