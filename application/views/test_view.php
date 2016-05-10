<link rel="stylesheet" href="<?php echo base_url().'assets/css/jq/jqx.base.css' ?> ">
<script type="text/javascript" src="http://localhost/pos/assets/global/plugins/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxcore.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.edit.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.pager.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxbuttons.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxcheckbox.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxlistbox.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.filter.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.selection.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxdata.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxdatatable.js"></script>



<script type="text/javascript">
    $(document).ready(function ()
    {
//        turn_off_triggers();
        var url = "<?php echo base_url().'test_contr/ajax_resp';?>";

        // prepare the data
        var source =
        {
            dataType: "json",
            dataFields: [
                { name: 'id', type: 'int' },
                { name: 'module_name', type: 'string' },
                { name: 'component_name', type: 'string' },
            ],
            id: 'id',
            url: url
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#desk_dataTable").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                pageable: true,
                filterable: true,
                sortable: true,
                showfilterrow: true,
                columnsresize: true,
                pagesize:10,
                pagesizeoptions: ['10', '20', '30', '50','100','150'],
                selectionmode: 'checkbox',
                altrows: true,
                autoheight: true,
                columns: [
                    { text: 'MODULE_NAME', dataField: 'module_name',width:'191'},
                    { text: 'COMPONENT_NAME', dataField: 'component_name',width:'100'},
                ]
            });

    });
</script>

<div class="form-group">
    
    <div id="desk_dataTable">potato inside</div>
</div>

<pre>
    <?php var_dump($var_dump);?>
</pre>