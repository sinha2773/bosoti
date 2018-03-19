<form name="form" method="post" action="<?php echo base_url($admin_path);?>/common/save/<?php echo $action;?>">
    <div class="form-group">
        <label>Package Name</label>
        <input type="text" name="title" placeholder="Enter Package Name"  class="form-control" required>
        <input type="hidden" name="slug">
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label>Price</label>
            <input onkeyup="vatCalculate()" id="price" type="number" step="any" name="price" placeholder="Enter Package Price"  class="form-control" required>
        </div>
        <div class="col-sm-4">
            <label>Vat(%)</label>
            <input onkeyup="vatCalculate()" id="vat" type="number" name="vat" placeholder="Enter Package Vat (ex: 15)"  class="form-control" required>
        </div>
        <div class="col-sm-4">
            <label>Total</label>
            <input id="total" type="number" step="any" name="total" placeholder="Enter Price Total"  class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <input checked="true" type="radio" name="status" value="1"> Enable  
        <input type="radio" name="status" value="0">  Disable
    </div>
    <div class="form-group">
        <input type="text" name="order_id" placeholder="Enter order" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" style="width: 100% " value="Save">
    </div>
</form>

<script type="text/javascript">
    function vatCalculate(){
        var price = $('#price').val();
        var vat = $('#vat').val();
        var total = parseFloat(price) + parseFloat((price * vat)/100);
        if(total>0)
            $('#total').val(total);
        else
            $('#total').val('');
    }
</script>