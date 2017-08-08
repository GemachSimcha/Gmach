<?php
include('header.php');
?>
</section>
</div>
</div>

<div class="container">
  <br />
  <h2 align="center">Ajax</h2>
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">Search</span>
      <input type="text" name="search_text" id="search_text" placeholder="search names" class="form-control">
    </div>
  </div>
  <br />
  <div id="result"></div>
</div>
      
<?php
include('footer.php');
 ?>

<script type="text/javascript">
  $( function() {
    $('#search_text').keyup(function() {
      var txt = $(this).val();
      if(txt != '') { 
        $.ajax({
          url:"/ajax_fetch.php",
          method:"post",
          data:{search:txt},
          dataType:"text",
          success:function(data)
          {
            $('#result').html(data);
          }
        });
      }       
      else {
        $('#result').html('');
          $.ajax({
            url:"/ajax_fetch.php",
            method:"post",
            data:{search:txt},
            dataType:"text",
            success:function(data)
            {
              $('#result').html(data);
            }
          });
      }
    });
  });
</script>

