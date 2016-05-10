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
                <form class="form-horizontal" action="<?php echo base_url() . $controller_name . '/' . $add_record; ?>"
                      method="post" enctype="multipart/form-data">

                    <div class="form-group">

                        <label class="col-md-1  control-label"><?php echo $this->lang->line('SUPPLIER'); ?> </label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="person_id" id="person_id" required>
                                <?php
                                $this->load->view('dropdown', array('drop_down_options' => $supplier_list, 'drop_down_selected' => $record_info['person_id']));
                                ?>
                            </select>
                        </div>

                        <label class="col-md-2  control-label"><?php echo $this->lang->line('DUE_AMOUNT'); ?> :</label>
                        <div class="col-md-2">
                            <input type="text" name="" value="" class="form-control available_balance" readonly>
                        </div>

                        <label class="col-md-1  control-label"><?php echo $this->lang->line('DATE'); ?> :</label>
                        <div class="col-md-3">
                            <input type="text" name="purchase_date" value="<?php echo $record_info['date'];?>" class="form-control datepicker">
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="text" name="item_name" id="item_name" class=" form-control" placeholder="Search By Product Name">
                        </div>
                    </div>


                    <table class="table table-bordered product_list display_none" data-item-id="0" data-payment-id="0" id="" >
                        <tr>
                            <td>Item Name</td>
                            <td>Quantity</td>
                            <td>Unit Price</td>
                            <td>Discount %</td>
                            <td>Discount Amount</td>
                            <td>Total</td>
                            <td>Action</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="" style="text-align: right"><b>TOTAL AMOUNT</b></td>
                            <td><input type="text" value="" name="total_amount" class="form-control total_amount" id="" readonly></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="" style="text-align: right"><b>DISCOUNT</b></td>
                            <td><input type="text" value="" name="gross_discount" class="form-control discount" id=""></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="" style="text-align: right"><b>Net AMOUNT</b></td>
                            <td><input type="text" value="" name="net_amount" class="form-control net_amount" id="" readonly></td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr class="payment_method">
                            <td colspan="3" class="" style="text-align: right"><b>PAYMENT METHOD</b></td>
                            <td>
                                <select class="form-control payment_method_option" name='payment_methods[0][payment_method]' >
                                    <option value="<?php echo $this->config->item('PAYMENT_METHOD_CASH');?>" <?php if($record_info['payment_method']==$this->config->item('PAYMENT_METHOD_CASH')){echo "selected='selected'";}?>><?php echo $this->lang->line('CASH');?></option>
                                    <option value="<?php echo $this->config->item('PAYMENT_METHOD_PERSONAL_ACCOUNT');?>" <?php if($record_info['payment_method']==$this->config->item('PAYMENT_METHOD_PERSONAL_ACCOUNT')){echo "selected='selected'";}?>><?php echo $this->lang->line('PERSONAL_ACCOUNT');?></option>
                                </select>
                            </td>
                            <td  class="" style="text-align: right"><b>AMOUNT</b></td>
                            <td><input type="text" value="" name='payment_methods[0][paid_amount]' class="form-control payment_method_amount" id=""></td>
                            <td><span class='btn btn-success add_payment_method'>+</span></td>
                        </tr>

                        <tr>
                            <td colspan="5" class="" style="text-align: right"><b>DUE AMOUNT</b></td>
                            <td><input type="text" value="" name="due_amount" class="form-control due_amount" id="" readonly></td>
                            <td>&nbsp;</td>
                        </tr>


                    </table>

                    <?php
                    echo My_menu_tree_helper::page_access_button_save();
                    ?>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        $("#item_name").autocomplete({
            source: "<?php echo  base_url() . $this->controller_name.'/'.'get_product_name/'; ?>",
            minLength: 2,
            focus: function( event, ui ) {
                event.preventDefault();
                $('#item_name').val(ui.item.label);
            },
            select: function (event, ui) {

               $('#item_name').val(ui.item.label);

                //alert(discount_type);
//                $('#item_id').val(ui.item.value);
//                return false
                $(".table").removeClass('display_none');
                var index = $('.product_list').data('item-id');
                var html = "<tr class=' single_product'>" +


                                "<td>"+
                                        "<input type='text' class='form-control' value='" + ui.item.label + "' disabled>" +
                                        "<input class='product_id' type='hidden' value='" + ui.item.value + "' name='product[" + index + "][item_id]'> " +
                                "</td>"+

                                "<td>" +
                                    "<input required type='number' min='1' id='' class='form-control calculate quantity' name='product[" + index + "][quantity]' placeholder=' Quantity'> " +
                                "</td>"+

                                "<td>"+
                                    "<input required type='text' min='1' id=''  class='form-control calculate unit_price' name='product[" + index + "][unit_price]' placeholder=' Unit Price'> " +
                                "</td>"+

                                "<td>"+
                                "<input  type='number' min='1' id=''  class='form-control calculate item_discount_percent'  name='product[" + index + "][item_discount_percent]' placeholder=' EX: 5%'> " +
                                "</td>"+

                                "<td>"+
                                    "<input  type='number' min='1' id=''  class='form-control calculate item_discount'  name='product[" + index + "][item_discount]' placeholder=' Discount'> " +
                                "</td>"+

                                "<td>"+
                                    "<input  type='text' id=''  class='form-control row_total' name='product[" + index + "][total]' placeholder='Total' readonly> " +
                                "</td>"+

                                "<td>"+
                                            "<span class='btn btn-danger remove_product'>X</span>" +
                                "</td>"+
                            "</tr>";


                var status = true;
                $.each($('.product_list').find('.product_id'), function (index, element) {
                    if (parseInt(element.value) == ui.item.value) {
                        status = false;
                        alert('This product already assigned.')
                        return false;
                    }
                });
                if (status) {
                    $('.product_list').data('item-id',index+1)
                    $('.product_list tr:first').after(html);
                }
                $(this).val('')
                return false
            }
            ,
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }

        });

        // for remove a single item from table
        $(document).on('click', '.remove_product', function () {

            var rows= $('tr.single_product').length;
            if(rows==1){
                $(".table").addClass('display_none');
            }
            var obj = $(this);
            obj.closest('.single_product').remove();

            total_amount();
            net_amount();


        });

        // will calculate percentage for single row
        $(document).on('keyup','.item_discount_percent',function(){
            var quantity = $(this).closest('.single_product').find('.quantity').val();
            var price = $(this).closest('.single_product').find('.unit_price').val();
            var discount = $(this).closest('.single_product').find('.item_discount').val();
            var discount_percent=$(this).val();

            if(discount_percent>0){
                $('.item_discount').attr('disabled','disabled');
                total= ((quantity *price)*discount_percent)/100;
                $(this).closest('.single_product').find(".item_discount").val(total);
            }else {
                $('.item_discount').removeAttr('disabled')
             $('.item_discount').val('')
            }

            if (discount_percent > 100){
                alert("No numbers above 100");
                $(this).val('100');
            }
        });

        // will calculate sum of a single row
        $(document).on("keyup",'.calculate', function () {
            rowTotal(this);
            total_amount();
            net_amount();
            dueAmount();
        });


//Calculate net amount when any key_up in discount input
        $(document).on("keyup",'.discount', function () {
            net_amount();
            dueAmount();
        });

//For add new payment option
     $(document).on("click",'.add_payment_method',function(){
         var rows= $('tr.payment_method').length;
        if (rows>=2){
            alert('No option');
            return false;
        }

         var index = parseInt($('.product_list').data('payment-id'));
         $(".payment_method:first").clone().insertAfter(".payment_method:first");
         $(".payment_method:last") .find('.payment_method_option').attr('name','payment_methods[' + (index+1) + '][payment_method]');
         $(".payment_method:last") .find('.payment_method_amount').attr('name','payment_methods[' + (index+1) + '][paid_amount]');
         $(".payment_method:last").find('td:last').append( "<span class='btn btn-danger remove_payment_method'>X</span> ");
         $(".payment_method:last").find('td:last').find('.add_payment_method').remove()
         $('.payment_method:last').find('.payment_method_amount:last').val('');
     });


 // Remove payment option
        $(document).on("click",'.remove_payment_method',function(){
            $(".payment_method:last").remove()
            dueAmount();
        });
//validate personal account amount
        $(document).on('keyup','.payment_method_amount',function(){
            var personal_account='<?= $this->config->item('PAYMENT_METHOD_PERSONAL_ACCOUNT')?>';

           var obj= $(this);
            var payment_type= obj.closest('.payment_method').find('.payment_method_option').val();
            var available_balance=parseFloat($('.available_balance').val() )|| -1;
            var amount = parseFloat( $(this).val());

            if(payment_type== personal_account){

                if(available_balance== -1 ){
                    alert('Please select supplier');
                    obj.val('0');
                    return false;
                }

               if(amount > available_balance){
                   alert('balance overload');
                   obj.val('0');
               }
            }
        });

// calculate DUE AMOUNT
        $(document).on("keyup",'.payment_method_amount',function(){
            dueAmount();
        });



        function rowTotal(ele) {
            var total= 0;
            var quantity = $(ele).closest('.single_product').find('.quantity').val();
            var price = $(ele).closest('.single_product').find('.unit_price').val();
            var discount = $(ele).closest('.single_product').find('.item_discount').val();
//            if (discount>0){
//              $('.item_discount_percent').attr('disabled','disabled')
//            }else {
//                $('.item_discount_percent').removeAttr('disabled')
//            }
            total= (quantity *price)-discount;
            $(ele).closest('.single_product').find(".row_total").val(total);
        }


        function total_amount(){
            var sum = 0;
            $('tr').find('.row_total').each(function () {
                var amount = $(this).val();
                if (!isNaN(amount) && amount.length !== 0) {
                    sum += parseFloat(amount);
                }
            });

            $('.total_amount').val(sum);
        }

        function net_amount(){
            var discount_amount=$('.discount').val();
            var  total_amount=$('.total_amount').val()
            var net_amount= total_amount-discount_amount;
            $(".net_amount").val(net_amount);

        }

        function dueAmount(){
            var dueAmount=0;
            this.sum=0;
            var net_amount = $('.net_amount').val();

            $('.table').find('.payment_method_amount').each(function () {
                var payAmount= $(this).val();
//                console.log(payAmount)
                if (!isNaN(payAmount) && payAmount.length !== 0) {
                    self.sum += parseFloat(payAmount);
                }
            });
            dueAmount= net_amount-this.sum;
            //console.log(dueAmount)
            $('.due_amount').val(dueAmount);
        }



        $(document).on('change','#person_id',function(){
          var person_id= $(this).val();
            $.ajax({
                url: '<?php echo  base_url() . $this->controller_name.'/'.'get_personal_balance/'; ?>',
                data: {person_id: person_id},
                type: 'POST',
                success: function(data){
                    $('.available_balance').val(data);
//                  console.log(data);
                }
            });
        });
    });

</script>