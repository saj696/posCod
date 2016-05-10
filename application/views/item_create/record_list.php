<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="page-content-wrapper">
    <div class="page-content">
        <?php
        echo My_menu_tree_helper::page_breadcrumb();
        echo My_menu_tree_helper::page_access_button_new($new_button_name);
        ?>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list"></i><?php echo isset($task_title) ? $task_title : null ?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="load_grid"></div>
                    </div>
                    <div style="margin-top: 30px;">
                        <div id="cellbegineditevent">
                        </div>
                        <div style="margin-top: 10px;" id="cellendeditevent">
                        </div>
                    </div>
                    <div id="popupWindow">
                        <div>
                            <?php echo $this->lang->line('DELETE'); ?>
                        </div>
                        <div style="overflow: hidden;">
                            <p><?php echo $this->lang->line('DELETE_CONFIRM'); ?></p>
                            <button id="del">Yes</button>
                            <button id="cancel">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $('#popupWindow').hide();
    $(document).ready(function () {


        var url = "<?php echo base_url() . $this->controller_name.'/'.$this->grid_link;?>";
        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
//                {name: 'id', type: 'int'},
                {name: 'category_name', type: 'string'},
                {name: 'item_name', type: 'string'},
              //  {name: 'employeeName', type: 'string'},
                {name: 'item_type_text', type: 'string'},
                {name: 'unit_type_text', type: 'string'},
                {name: 'unit_size_text', type: 'string'},
                {name: 'retail_price', type: 'string'},
                {name: 'status_text', type: 'string'}

            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#load_grid").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                pagesize: "<?php echo $this->config->item('page_size')?>",
                pagesizeoptions: <?php echo $this->config->item('page_size_option')?>,
                selectionmode: '',//'checkbox',
                altrows: true,
                autoheight: true,
                columns: [
//                    {text: 'ID', dataField: 'id'},
                    {text: ' Category', dataField: 'category_name', filtertype: ''},
                    {text: ' Item Name', dataField: 'item_name', filtertype: ''},
//                    {text: ' Supplier Name', dataField: 'employeeName', filtertype: ''},
                    {text: 'Retail_price', dataField: 'retail_price', filtertype: ''},
                    {text: ' Item Type', dataField: 'item_type_text', filtertype: 'checkedlist'},
                    {text: 'Unit Type', dataField: 'unit_type_text', filtertype: 'checkedlist'},
                    {text: 'Unit Size', dataField: 'unit_size_text', filtertype: 'checkedlist'},
                    {text: 'Status', dataField: 'status_text', filtertype: 'checkedlist'},


                    <?php if (User_helper::has_access(null, $this->controller_name, $this->delete_link)){?>
                    {
                        text: '<?php echo $this->lang->line('DELETE')?>',
                        datafield: 'Delete',
                        filtertype: 'none',
                        columntype: 'button',
                        cellsrenderer: function () {
                            return "<?php echo $this->lang->line('DELETE')?>";
                        },
                        buttonclick: function (row) {
                            // open the popup window when the user clicks a button.
                            id = $("#load_grid").jqxGrid('getrowid', row);
                            var offset = $("#load_grid").offset();
                            $("#popupWindow").jqxWindow({
                                position: {
                                    x: parseInt(offset.left) + 350,
                                    y: parseInt(offset.top) - 100
                                }
                            });
                            // show the popup window.
                            $("#popupWindow").jqxWindow('show');
                        }
                    },
                    <?php }?>
                    <?php if (User_helper::has_access(null, $this->controller_name, $this->edit_link)){?>
                    {
                        text: '<?php echo $this->lang->line('EDIT')?>',
                        datafield: 'Edit',
                        filtertype: 'none',
                        columntype: 'button',
                        cellsrenderer: function () {
                            return "<?php echo $this->lang->line('EDIT')?>";
                        },
                        buttonclick: function (row) {
                            // open the popup window when the user clicks a button.
                            id = $("#load_grid").jqxGrid('getrowid', row);
                            window.location = "<?php echo base_url().$this->controller_name.'/'.$this->edit_link; ?>/" + id;
                        }
                    },
                    <?php }?>

                ]
            });
        $('#load_grid').on('rowDoubleClick', function (event) {
            var view_link = $('#load_grid').jqxGrid('getrows')[event.args.rowindex].id;
            window.location = "<?php echo base_url().$this->controller_name.'/'.$this->view_link; ?>/" + view_link;
        });

        <?php if (User_helper::has_access(null, $this->controller_name, $this->delete_link)){?>
        // initialize the popup window and buttons.
        $("#popupWindow").jqxWindow({
            width: 250, resizable: false,
            //            theme: theme,
            isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });

        $("#del").click(function () {
            $.ajax()
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: '<?php echo base_url().$this->controller_name.'/'.$this->delete_link; ?>',
                data: {
                    record_id: id
                },
                success: function (data) {
                    alert("<?php echo $this->lang->line('MSG_DELETE_SUCCESS')?>")
                }
            });
            $('#load_grid').jqxGrid('deleterow', id);
            $("#popupWindow").jqxWindow('hide');
        });
        $("#cancel").click(function () {
            $("#popupWindow").jqxWindow('hide');
        });


        $(".jqx-window-modal").click(function () {
            $("#popupWindow").effect("bounce", "slow");
        });
        <?php   }?>

    });
</script>


