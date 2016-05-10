<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$controller_name = $this->controller_name;
$add_record = $this->add_link;

?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title) ? $task_title : null ?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">
                <form class="form-horizontal" action="<?php echo base_url() . $controller_name . '/' . ''; ?>"
                      method="post" enctype="multipart/form-data">

                    <div class="form-group">

                        <label class="col-md-1  control-label"><?php echo $this->lang->line('SUPPLIER'); ?> </label>

                        <div class="col-md-3">
                            <select class="form-control input-medium" name="person_id" id="person_id" required
                                    readonly="">
                                <?php
                                $this->load->view('dropdown', array('drop_down_options' => $supplier_list, 'drop_down_selected' => $transactions_details['person_id']));
                                ?>
                            </select>
                        </div>


                        <label class="col-md-1  control-label"><?php echo $this->lang->line('DATE'); ?> :</label>

                        <div class="col-md-3">
                            <input type="text" name="purchase_date"
                                   value="<?php echo System_helper::display_date($transactions_details['purchase_date']); ?>"
                                   class="form-control datepicker">
                        </div>

                    </div>


                    <table class="table table-bordered product_list " data-item-id="0" data-payment-id="0" id="">
                        <tr>
                            <td width="40%">Item Name</td>
                            <td width="10%">Quantity</td>
                            <td>Unit Price</td>
                            <td>Discount Amount</td>
                            <td>Total</td>
                        </tr>
                        <?php foreach ($single_products as $product): ?>
                            <tr>
                                <td><?= $product['item_name'] ?></td>
                                <td><?= $product['quantity'] ?></td>
                                <td><?= $product['unit_price'] ?></td>
                                <td><?= $product['item_discount'] ?></td>
                                <td><?= ($product['quantity'] * $product['unit_price']) - $product['item_discount'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="" style="text-align: right"><b>TOTAL AMOUNT</b></td>
                            <td><b><?= $transactions_details['total_amount'] ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="" style="text-align: right"><b>DISCOUNT</b></td>
                            <td><b><?= $transactions_details['gross_discount'] ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="" style="text-align: right"><b>Net AMOUNT</b></td>
                            <td>
                                <b><?= $transactions_details['total_amount'] - $transactions_details['gross_discount'] ?></b>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="4" class="" style="text-align: right"><b>DUE AMOUNT</b></td>
                            <td><b><?= $transactions_details['due_amount'] ?></b></td>
                        </tr>


                    </table>

                    <div class="form-group">

                        <label
                            class="col-md-2 col-md-offset-1 control-label"><?php echo $this->lang->line('SUPPLIER'); ?> </label>

                        <div class="col-md-3">
                            <select class="form-control input-medium" name="person_id" id="person_id" required>
                                <?php
                                $this->load->view('dropdown', array('drop_down_options' => $supplier_list, 'drop_down_selected' => $transactions_details['']));
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><?php echo $this->lang->line('ADD_NEW') ?></button>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-md-2 col-md-offset-1 control-label"><?php echo $this->lang->line('TRANSPORT_COST'); ?> </label>

                        <div class="col-md-3">
                            <input type="text" value="" name="transport_cost" class="form-control cost transport_cost" id="">
                        </div>


                    </div>

                    <div class="form-group">

                        <label class="col-md-2 col-md-offset-1 control-label"><?php echo $this->lang->line('PAID_AMOUNT'); ?> </label>

                        <div class="col-md-3">
                            <input type="text" value="" name="paid_amount" class="form-control cost paid_amount" id="">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-md-2 col-md-offset-1 control-label"><?php echo $this->lang->line('DUE_AMOUNT'); ?> </label>

                        <div class="col-md-3">
                            <input type="text" value="" name="due_amount" class="form-control due_amount" id="" readonly>
                        </div>
                    </div>

                    <br/><br/>

                    <?php
                    echo My_menu_tree_helper::page_access_button_save();
                    ?>

                </form>

            </div>

            <!--This is for add new supplier form-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //calculate cost
        $(document).on('keyup','.cost',function(){
            var transport_cost= $('.transport_cost').val();
            var paid_amount=$('.paid_amount').val();
            var due_amount=0;
            var due_amount= transport_cost - paid_amount;
            $('.due_amount').val(due_amount);
        });
    });

</script>