<?php
require_once("../../config.php");
include("../../auth.php");
		if(isset($_POST['custom_barcode']))
		{
	 	 $categoty=$_POST['categoty'];	
		 $barcode_list=$_POST['barcode_list'];
		}
?>
<html>
<head>
<link rel="shortcut icon" href="../../assets/img/favicon.ico" />
<title>Barcode | Spsu Library</title>
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
	width: 25%;
	height: 10%;
	margin:0 auto;
	text-align:center;
 	line-height:60% !important;
	padding-top:3.7% !important;
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
</head>
<body>
<?php 
if($categoty=='Book')
{?>
			 <div class="page">
                                     <?php
					foreach($barcode_list as $value)								 
					{
								$result=mysql_query("SELECT `class_no`,`book_no` FROM book WHERE `accession_no`='".$value."'");
								$row=mysql_fetch_array($result);
								$num=mysql_num_rows($result);
								if($num>0)
								{
								$class_no=$row['class_no'];
								$book_no=$row['book_no'];
								}
								else
								{
								$class_no="N/A";
								$book_no="N/A";	
								}
					$finalRequest='';				
					$finalRequest.='?filetype=PNG&dpi=72&scale=0&rotation=0&font_family=Arial.ttf&font_size=12&text='.$value.'&thickness=30&checksum=&code=BCGcode39';
						?>
                            <div class="left" >
                          <span><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong>RMTTC LIBRARY<br /><?php echo $value; ?></strong></font><br /><img src="image.php<?php echo $finalRequest;?>"  alt="Barcode Image"/><br/><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong><?php echo $class_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $book_no; ?></strong></font></span>
                           		
                            </div>
                        <?php
					}
					?>
                    </div>
<?php
}
else
{
?>
							 <div class="page">
                                     <?php
					foreach($barcode_list as $value)								 
					{
								$result=mysql_query("SELECT `name` FROM member WHERE `member_id`='".$value."'");
								$row=mysql_fetch_array($result);
								$num=mysql_num_rows($result);
								if($num>0)
								{
								$name=$row['name'];
								}
								else
								{
								$name="N/A";
								}
					$finalRequest='';				
					$finalRequest.='?filetype=PNG&dpi=72&scale=0&rotation=0&font_family=Arial.ttf&font_size=12&text='.$value.'&thickness=30&checksum=&code=BCGcode39';
						?>
                            <div class="left" >
                          <span><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong>RMTTC LIBRARY<br /><?php echo $value; ?></strong></font><br /><img src="image.php<?php echo $finalRequest;?>"  alt="Barcode Image"/><br/><font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;"><strong><?php echo $name; ?></strong></font></span>
                           		
                            </div>
                        <?php
					}
					?>
                    </div>
<?php
}
?>
</body>
</html>
                        