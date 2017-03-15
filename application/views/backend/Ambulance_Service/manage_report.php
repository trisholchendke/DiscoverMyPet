<?php $user_id    = $this->session->userdata('login_user_id'); ?>
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_report/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_report'); ?>
</button>
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
            <li>
                <a href="#sale" data-toggle="tab">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('sale');?></span>
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
                        $report_info    = $this->db->get_where('report', array('type' => 'operation', 'user_id' => $user_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                  <td><?php echo $row['parent_name'] ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/ambulance_service/download_report/operation/<?php echo $row['report_id'] ;?>">
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
                             <td><?php echo $row['parent_name'] ?></td>
                            <th><?php echo get_phrase('download_report'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $report_info    = $this->db->get_where('report', array('type' => 'birth', 'user_id' => $user_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                  <td><?php echo $row['parent_name'] ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/ambulance_service/download_report/birth/<?php echo $row['report_id'] ;?>">
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
                        $report_info    = $this->db->get_where('report', array('type' => 'death', 'user_id' => $user_id))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo date("m/d/Y", $row['timestamp']) ?></td>
                                <td>
                                    <?php $name = $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name;
                                        echo $name;
                                    ?>
                                </td>
                                <td><?php echo $row['parent_name'] ?></td>
                                <td><?php echo $row['death_location'] ?></td>
                                <td><?php echo $row['death_reason'] ?></td>
                                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/ambulance_service/download_report/death/<?php echo $row['report_id'] ;?>">
            	<button class="btn btn-xs common_btn"><i class="fa fa-download" aria-hidden="true"></i></button>
            </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane" id="sale">
            <table class="table table-bordered table-striped datatable" id="table-4">
                    <thead>
                         <tr>
            <th><?php echo get_phrase('invoice_number'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('pet_name'); ?></th>
            <th><?php echo get_phrase('creation_date'); ?></th>
            <th><?php echo get_phrase('due_date'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
             <th><?php echo get_phrase('download_report'); ?></th>
        </tr>
                    </thead>

                    <tbody>
                       <?php $medicine_category_info = $this->db->get_where('invoice' , array('user_id' => $this->session->userdata('login_user_id')))->result_array();
        $array = json_decode(json_encode($medicine_category_info), True);
        foreach ($array as $row) { ?>      
            <tr>
                <td><?php echo $row['invoice_number'] ?></td>
                <td><?php echo $row['title'] ?></td>
                
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php echo $row['creation_timestamp'] ?></td>
                <td><?php echo $row['due_timestamp'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td>
                                               <a href="<?php echo base_url(); ?>index.php?/ambulance_service/download_report/sale/<?php echo $row['invoice_id'] ;?>">
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