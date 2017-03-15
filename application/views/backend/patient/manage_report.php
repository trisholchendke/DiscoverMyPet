<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">

        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <li class="active">
                <a href="#operation" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-home"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('operation');?></span>
                </a>
            </li>
            <li>
                <a href="#birth" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('birth');?></span>
                </a>
            </li>
            <li>
                <a href="#death" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('death');?></span>
                </a>
            </li>
            
        </ul>

        <div class="tab-content">
            
            <div class="tab-pane active" id="operation">
                    
                <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('pet_name'); ?></th>
                            <th><?php echo get_phrase('parent_name'); ?></th>
                             <th><?php echo get_phrase('download_report'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

$this->db->select('*');
    	$this->db->from('report');
    	$this->db->where('type','operation');
$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->order_by("report_id", "desc");
    	$query = $this->db->get();
    	$report_info  =  $query->result_array();
                       
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                  <td><?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->parent_name;
                                        echo $name;
                                    ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/patient/download_report/operation/<?php echo $row['report_id'] ;?>">
            	<button class="btn btn-xs common_btn"><i class="fa fa-download" aria-hidden="true"></i></button>
            </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
            <div class="tab-pane" id="birth">
            
                <table class="table table-bordered table-striped datatable" id="table-2">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('pet_name'); ?></th>
                             <td><?php echo get_phrase('parent_name') ?></td>
                            <th><?php echo get_phrase('download_report'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

	$this->db->from('report');
    	$this->db->where('type','birth');
$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->order_by("report_id", "desc");
    	$query = $this->db->get();
    	$report_info  =  $query->result_array();


                        
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                  <td><?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->parent_name;
                                        echo $name;
                                    ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/patient/download_report/birth/<?php echo $row['report_id'] ;?>">
            	<button class="btn btn-xs common_btn"><i class="fa fa-download" aria-hidden="true"></i></button>
            </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
            <div class="tab-pane" id="death">
                    
                <table class="table table-bordered table-striped datatable" id="table-3">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('pet_name'); ?></th>
                            <th><?php echo get_phrase('parent_name'); ?></th>
                            <th><?php echo get_phrase('death_location'); ?></th>
                            <th><?php echo get_phrase('death_reason'); ?></th>
                             <th><?php echo get_phrase('download_report'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

$this->db->from('report');
    	$this->db->where('type','death');
$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->order_by("report_id", "desc");
    	$query = $this->db->get();
    	$report_info  =  $query->result_array();

                       
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                <td><?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->parent_name;
                                        echo $name;
                                    ?></td>
                                <td><?php echo $row['death_location'] ?></td>
                                <td><?php echo $row['death_reason'] ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/patient/download_report/death/<?php echo $row['report_id'] ;?>">
            	<button class="btn btn-xs common_btn"><i class="fa fa-download" aria-hidden="true"></i></button>
            </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            
            
        </div>
        
    </div>
    
</div>

<?php for($count=1; $count<=3; $count++){ ?>
    <script type="text/javascript">
        jQuery(window).load(function ()
        {
            var $ = jQuery;

            $("#table-<?php echo $count ?>").dataTable({
                "sPaginationType": "bootstrap",
"iDisplayLength": 5,

"order": [],
 "aaSorting": [],
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });

            // Highlighted rows
            $("#table-<?php echo $count ?> tbody input[type=checkbox]").each(function (i, el)
            {
                var $this = $(el),
                        $p = $this.closest('tr');

                $(el).on('change', function ()
                {
                    var is_checked = $this.is(':checked');

                    $p[is_checked ? 'addClass' : 'removeClass']('highlight');
                });
            });

            // Replace Checboxes
            $(".pagination a").click(function (ev)
            {
                replaceCheckboxes();
            });
        });
    </script>
<?php } ?>