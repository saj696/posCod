<div class="page-content-wrapper">
    <div class="page-content">
        <?php
        echo  My_menu_tree_helper::page_breadcrumb();
        echo  My_menu_tree_helper::page_access_button_new($new_button_name);
        ?>
        <div class="portlet box green">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-12">
                        <div id="load_grid">
                        </div>
                        <div style="margin-top: 30px;">
                            <div id="cellbegineditevent">
                            </div>
                            <div style="margin-top: 10px;" id="cellendeditevent">
                            </div>
                        </div>
                        <div id="popupWindow">
                            <div>
                                Delete row</div>
                            <div style="overflow: hidden;">
                                <p>
                                    Are you sure you would like to delete the selected row?</p>
                                <button id="del">
                                    Yes</button>
                                <button id="cancel">
                                    No</button>
                            </div>
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
                {name: 'name_en', type: 'string'},
                {name: 'gender', type: 'string'},
                {name: 'status', type: 'string'},
                {name: 'type_id', type: 'string'},
                {name: 'mobile', type: 'string'},
                {name: 'payscale_id', type: 'string'},
                {name: 'member_id', type: 'string'},
                {name: 'balance', type: 'string'},
                {name: 'due', type: 'string'},
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
            pagesize: 10,
            pagesizeoptions: ['10', '20', '30', '50', '100', '150'],
//            selectionmode: 'checkbox',
            altrows: true,
            autoheight: true,
            columns: [
                {text: 'Name En', dataField: 'name_en',filtertype: 'none'},
                {text: 'Gender', dataField: 'gender',filtertype: 'checkedlist'},
                {text: 'Status', dataField: 'status',filtertype: 'checkedlist'},
                {text: 'Type', dataField: 'employee_type',filtertype: 'checkedlist'},
                {text: 'Mobile', dataField: 'mobile',filtertype: 'none'},
                {text: 'Payscale', dataField: 'payscale_id',filtertype: 'none'},
                {text: 'Member', dataField: 'member_id',filtertype: 'none'},
                {text: 'Balance', dataField: 'balance',filtertype: 'none'},
                {text: 'Due', dataField: 'due',filtertype: 'none'},
                {text: '<?php echo $this->lang->line('DELETE')?>', datafield: 'Delete',filtertype: 'none', columntype: 'button', cellsrenderer: function (){
                        return "<?php echo $this->lang->line('DELETE')?>";
                    },
                    buttonclick: function (row)
                    {
                        // open the popup window when the user clicks a button.
                        id = $("#load_grid").jqxGrid('getrowid', row);
                        var offset = $("#load_grid").offset();
                        $("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 350, y: parseInt(offset.top) - 100} });
                        // show the popup window.
                        $("#popupWindow").jqxWindow('show');
                    }
                },
                {text: '<?php echo $this->lang->line('EDIT')?>', datafield: 'Edit',filtertype: 'none', columntype: 'button', cellsrenderer: function (){
                        return "<?php echo $this->lang->line('EDIT')?>";
                    },
                    buttonclick: function (row)
                    {
                        // open the popup window when the user clicks a button.
                        id = $("#load_grid").jqxGrid('getrowid', row);
                        window.location = "<?php echo base_url().$this->controller_name.'/'.$this->edit_link; ?>/"+id;
                    }
                },
            ]
        });
        $('#load_grid').on('rowDoubleClick', function (event)
        {
            var view_link=$('#load_grid').jqxGrid('getrows')[event.args.rowindex].id;
            window.location = "<?php echo base_url().$this->controller_name.'/'.$this->view_link; ?>/"+view_link;
        });
        // initialize the popup window and buttons.
        $("#popupWindow").jqxWindow({ width: 250, resizable: false,
//            theme: theme,
            isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01 });
//        $("#del").jqxButton({ theme: theme });
//        $("#cancel").jqxButton({ theme: theme });
        $("#del").click(function () {
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: '<?php echo base_url().$this->controller_name.'/'.$this->delete_link; ?>',
                data: {
                    record_id: id
                },
                success: function(data) {
                    if(data['status']=='success'){
                        $('#load_grid').jqxGrid('deleterow', id);
                        alert(data['message']);
                    }
                    else
                    {
                        alert(data['message']);
                    }
                }
            });
//            $('#load_grid').jqxGrid('deleterow', id);
            $("#popupWindow").jqxWindow('hide');
        });
        $("#cancel").click(function () {
            $("#popupWindow").jqxWindow('hide');
        });
        $(".jqx-window-modal").click(function ()
        {
            $("#popupWindow").effect( "bounce", "slow" );
        });
    });
</script>