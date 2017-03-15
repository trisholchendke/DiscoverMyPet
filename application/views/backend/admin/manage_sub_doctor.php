<div style="clear:both;"></div>
<br>
<div class="tbl_pet"> 
<table class="table table-bordered table-striped datatable" id="table-2">
 <caption>Pet Details</caption>
    <thead>
   
        <tr>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('address');?></th>
            <th><?php echo get_phrase('phone');?></th>
            <th><?php echo get_phrase('birth_date');?></th>
            <th><?php echo get_phrase('blood_group');?></th>
              <th><?php echo get_phrase('id');?></th>
         
        </tr>
    </thead>

    <tbody>
        <?php foreach ($doctor_info as $row) { ?>   
            <tr>
                <td>
                    <img src="<?php echo $this->crud_model->get_image_url('doctor' , $row['doctor_id']);?>" 
                         class="img-circle" width="40px" height="40px">
                </td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                 <td><?php echo $row['birth_date']?></td>
                  <td><?php echo $row['blood_group']?></td>
                  <td><?php echo $row['doctor_id']?></td>
              
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>

<div class="tbl_pet1"> 
<table class="table table-bordered table-striped datatable" id="table-3">
    <thead>
    <caption>Staff Details</caption>
        <tr>
         
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('address');?></th>
            <th><?php echo get_phrase('phone');?></th>
            <th><?php echo get_phrase('role');?></th>
          
         
         
        </tr>
    </thead>

    <tbody>
        <?php foreach ($staff as $row) { ?>   
            <tr>
              
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                 <td><?php echo $row['role']?></td>
              
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>


<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
        	  "pagingType": "full_numbers",
        	  "pageLength": 5,
            "sPaginationType": "bootstrap",
"iDisplayLength": 5,

"order": [],
 "aaSorting": [],
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });
        $("#table-3").dataTable({
      	  "pagingType": "full_numbers",
      	  "pageLength": 5,
          "sPaginationType": "bootstrap",
          "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
      });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
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
