	<div  id="slider-range"></div>
             <input id="min-price" name="min-price" type="hidden">
             <input id="max-price" name="max-price" type="hidden">
                      
              <input type="text" id="amount" readonly style="border:0; color:grey;margin: 5px auto; font-weight:bold;">

<!-- for the range slier -->
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

              <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 5000,
      values: [ 400, 900 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs" + ui.values[ 0 ] + " - Rs" + ui.values[ 1 ] );
        $("#min-price").val(ui.values[ 0 ]);
        $("#max-price").val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).val( "Rs" + $( "#slider-range" ).slider( "values", 0 ) +
      " - Rs" + $( "#slider-range" ).slider( "values", 1 ) );

        $("#min-price").val(ui.values[ 0 ]);
        $("#max-price").val(ui.values[ 1 ]);
  } );
  </script>