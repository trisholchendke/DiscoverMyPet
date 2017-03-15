<style>
.checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    

/*     .checkbox input[type="checkbox"]:focus + label::before { */
/*       outline: thin dotted; */
/*       outline: 5px auto -webkit-focus-ring-color; */
/*       outline-offset: -2px; } */
  
  
      

  .mail-env .mail-body .mail-compose .form-group label {
       position: relative !important;
    left: -4px !important;
    top: 0px !important;
    z-index: 10 !important;
}
</style>


<style type="text/css">
/* Absolute Center Spinner */
.loading {
 position: fixed;
 z-index: 999;
 height: 2em;
 width: 2em;
 overflow: show;
 margin: auto;
 top: 0;
 left: 0;
 bottom: 0;
 right: 0;
}

/* Transparent Overlay */
.loading:before {
 content: '';
 display: block;
 position: fixed;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
 /* hide "loading..." text */
 font: 0/0 a;
 color: transparent;
 text-shadow: none;
 background-color: transparent;
 border: 0;
}

.loading:not(:required):after {
 content: '';
 display: block;
 font-size: 10px;
 width: 1em;
 height: 1em;
 margin-top: -0.5em;
 -webkit-animation: spinner 1500ms infinite linear;
 -moz-animation: spinner 1500ms infinite linear;
 -ms-animation: spinner 1500ms infinite linear;
 -o-animation: spinner 1500ms infinite linear;
 animation: spinner 1500ms infinite linear;
 border-radius: 0.5em;
 -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
 box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
 0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
 }
 100% {
   -webkit-transform: rotate(360deg);
   -moz-transform: rotate(360deg);
   -ms-transform: rotate(360deg);
   -o-transform: rotate(360deg);
   transform: rotate(360deg);
 }
}
@-moz-keyframes spinner {
 0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
</style>
  <div class="loading"></div>
<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('staff_message'); ?>
        <p> * Fields are Mandatory</p>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open('admin/staff_message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
						<div class = "row">
						<div class="col-sm-6">
                       <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('subject *'); ?></label>

                            
                                <input type="text" name="subject" class="form-control" id="field-1" required>
                           
                      </div>
					   </div>
					  
                      </div>
					  <div class="row">
					   <div class="col-md-6">
					   <div class="compose-message-editor">

        <textarea  row="5" class="form-control 
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
            id="message" required></textarea>
    </div>

					   </div>
					  </div>
					   <div class="row text-center">
					   <div class="col-md-6">
					   <button id="send" type="submit" class="btn btn-success btn-icon pull-right" style="margin-top: 20px;">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
	</div>
					   </div>
                     


    
    
    

</form>


</div>


<script>
$(document).ready(function() {
	
	  $(".loading").hide();
	
});
</script>