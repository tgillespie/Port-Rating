<?php
include_once('rating.php')
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Gallery</title>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link href="css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/star-rating.min.js" type="text/javascript"></script>
</head>

<body style="margin:20px;">
<h1 style="text-align:center;"><img src="img/gillphotos_logo_white_large.jpg" style="width:20%;"/></h1>
<div style="font-size:1.5em; text-align:center;">Please rank these images. There is no need to submit your ratings as they are saved automatically.
  <?php 
    // integer starts at 0 before counting
    $i = 0; 
    $dir = 'port/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                $i++;
        }
    }
    // prints out how many were in the directory
    echo "$i Photos to Rate";
?>
</div>
<div> </div>
<ul style="list-style:none;">
  <?php for ($x = 1; $x <= $i; $x++) { ?>
  <li style="float:left; display:block; width:auto; max-width:600px; margin:.5em; color:#ccc;">
    <h3><?php echo $x; ?></h3>
    <img src="port/<?php echo $x; ?>.JPG" style="width:100%;" />
    <input value="0" type="number" class="rating" min=0 max=5 step=1 data-size="lg" data-stars="5" productId=<?php echo $x; ?>>
  </li>
  <?php } ?>
</ul>
</div>
<script type="text/javascript">
        $(function(){
               $('.rating').on('rating.change', function(event, value, caption) {
                productId = $(this).attr('productId');
                $.ajax({
                  url: "rating.php",
                  dataType: "json",
                  data: {vote:value, productId:productId, type:'save'},
                  success: function( data ) {
                     
                  },
              error: function(e) {
                // Handle error here
                console.log(e);
              },
              timeout: 30000  
            });
              });

           


        });
		
    </script>
</body>
</html>
