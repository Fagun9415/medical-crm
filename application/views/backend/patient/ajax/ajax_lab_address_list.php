<div class="col-12 row">
<?php foreach ($labs as $key => $value) { ?>
    <div class="col-md-3 col-sm-6">
        <div class="card" style="border-color: black;">
            <div class="card-body" role="button">
                <input type="radio" name="labId" value="<?php echo $value->id; ?>" id="labId<?php echo $key; ?>" required>
                <h5 class="card-title"><?php echo ucwords($value->name); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo sprintf('%0.2f',$value->distance) ; ?> km far away</h6>
                <p class="card-text"><?php echo "(".$value->lab_phone_code_1.") ".$value->lab_phone_no_1; ?> <br><?php echo $value->address; ?></p>
            </div>
        </div>
    </div>

<?php } ?>    
</div>
<!-- <script>

$('input[type=radio][name=addrs_id]').on('click', function() 
{ 
    var adds = $(this).data('postcode');

    var subprice = $('#total_price_id').val();

    $.ajax({
      url:"<?php echo base_url('Cart/fetch_delivery_charges') ?>",
      method:"POST",
      data:{postal_code:adds},
      success:function(data)
          { 

            var res = JSON.parse(data);
            var d = res.delivery_charges;
            
            if (d==null) 
            { 
                $('#d_charge').hide();
                $('#deltotal_charge').text(subprice);
            }
                else
            {
                var totalprices = parseFloat(subprice) + parseFloat(d) ;

                $('#d_charge').show();
                $('#del_charge').text(d);
                $('#deltotal_charge').text(totalprices);
            }
            
          }
    });
});
</script>  -->