<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 15-Mar-16
 * Time: 2:46 PM
 */
if(!isset($data_head)) $data_head = array();
if(!isset($data_side_bar)) $data_side_bar = array();
if(!isset($data_page_content)) $data_page_content = array();
if(!isset($data_side_bar_quick)) $data_side_bar_quick = array();
if(!isset($data_foot)) $data_foot = array();

$this->load->view('admin/head', $data_head);
$this->load->view('admin/side_bar', $data_side_bar);
?>
<style>
    .star_required
    {
        font-weight: bold;
        color: red;
        font-size: 20px;
    }
    .jqx-window-modal
    {
        opacity: .4 !important;

    }
</style>
<script>
    $(document).ready(function()
    {
        var base_url="<?php echo base_url()?>";
        var select="<?php echo $this->lang->line('SELECT')?>";
    })

    $(function()
    {
        $( ".datepicker" ).datepicker();
    });

</script>

<?php
echo $contents;

$this->load->view('admin/side_bar_quick', $data_side_bar_quick);
$this->load->view('admin/foot', $data_foot);