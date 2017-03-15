<hr />
<div class="mail-env">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        <?php include $message_inner_page_name . '.php'; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;">

        <!-- compose new email button -->
        <div class="mail-sidebar-row hidden-xs">
            <a href="<?php echo base_url(); ?>index.php?restaurants/staff_message/staff_message_new" class="btn btn-success btn-icon btn-block">
                <?php echo get_phrase('new_message'); ?>
                <i class="entypo-pencil"></i>
            </a>
        </div>


    </div>

</div>