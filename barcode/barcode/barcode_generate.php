<?php
require_once("../../database.php");

if(isset($_POST['submit']))
{
$acc_start=$_POST['start_range'];
$acc_end=$_POST['end_range'];
$item_id=$_POST['item_id'];
 
}
?>
<html>
<head>
<link rel="shortcut icon" href="../../assets/img/favicon.ico" />
<title>Barcode | ITEM Library</title>
<style>
    body {
        margin: 0;
        padding: 0;
    }
	
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
	
	.page{
	width:100%;
	height:100%;
	margin:0 auto;
	}
	
	.left {
	float: left;
	width: 20%;
	height: 7.2%;
	margin:0 auto;
	text-align:center;
 	line-height:60% !important;
	padding-top:5.6% !important;
	padding-bottom:4.8% !important;
	}
	
    @page {
        size: A4;
        margin: 0;
    }
	
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
        }
    }
</style>
<style media="print">
  .brk
  {
	  page-break-after:always;
  }
</style>
</head>
<body>
 
    			 <div class="page">
                                     <?php
					for($i=$acc_start;$i<=$acc_end;$i++)
					{$count++;
					
								$result=mysql_query("SELECT * FROM `master_items` WHERE `id`='$item_id'");
								$row=mysql_fetch_array($result);
								$num=mysql_num_rows($result);
								if($num>0)
								{
								$name=$row['item_name'];
								$item_code=$row['item_code'];
								}
								else
								{
								$name="N/A";
								}
					$finalRequest='';				
					$finalRequest.='?filetype=PNG&dpi=72&scale=0&rotation=0&font_family=Arial.ttf&font_size=12&text='.$item_code.'&thickness=30&checksum=&code=BCGcode39';
						?>
                            <div class="left" >
                          <span><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong> <br /><?php echo $i."[".$item_code."]"; ?></strong></font><br /><img src="image.php<?php echo $finalRequest;?>" width="100px"  alt="Barcode Image"/><br/><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong><?php echo $name; ?></strong></font></span>
                           		
                            </div>
                        <?php
					}
					?>
                    </div>
               
   
						
</body>
</html>
                        