<?php
require_once("../../config.php");
include("../../auth.php");
if(isset($_POST['special_series']))
{
$acc_start=$_POST['acc_from'];
$acc_end=$_POST['acc_to'];
$categoty=$_POST['categoty'];
}
?>
<html>
<head>
<link rel="shortcut icon" href="../../assets/img/favicon.ico" />
<title>Barcode | RMTTC Library</title>
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
	height: 8.333%;
	margin:0 auto;
	text-align:center;
 	padding-top:20px;
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
					for($i=$acc_start;$i<=$acc_end;$i++)
					{$count++;
								$result=mysql_query("SELECT `class_no`,`book_no` FROM book WHERE `accession_no`='".$i."'");
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
					$finalRequest.='?filetype=PNG&dpi=72&scale=0&rotation=0&font_family=Arial.ttf&font_size=12&text='.$i.'&thickness=30&checksum=&code=BCGcode39';
						?>
                          <div class="left" >
                          <span><font style="font-family:Verdana, Geneva, sans-serif; font-size:8px;"><strong>RMTTC LIBRARY<br /><?php echo $i; ?></strong></font><br /><img src="image.php<?php echo $finalRequest;?>" height="25px"  alt="Barcode Image"/><br/><font style="font-family:Verdana, Geneva, sans-serif; font-size:8px;"><strong><?php echo $class_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $book_no; ?></strong></font></span>
                           		
                            </div>
                        <?php
						if($count%2==0)
						{
							?>
                            <div class="left" >&nbsp;</div>
	                        <div class="left" >&nbsp;</div>
                            <?php
						}
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
					for($i=$acc_start;$i<=$acc_end;$i++)
					{$count++;
					
								$result=mysql_query("SELECT `name` FROM member WHERE `member_id`='".$i."'");
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
					$finalRequest.='?filetype=PNG&dpi=72&scale=0&rotation=0&font_family=Arial.ttf&font_size=12&text='.$i.'&thickness=30&checksum=&code=BCGcode39';
						?>
                            <div class="left" >
                          <span><font style="font-family:Verdana, Geneva, sans-serif; font-size:8px;"><strong>SPSU CENTRAL LIBRARY<br /><?php echo $i; ?></strong></font><br /><img src="image.php<?php echo $finalRequest;?>"  height="25px"   alt="Barcode Image"/><br/><font style="font-family:Verdana, Geneva, sans-serif; font-size:8px;"><strong><?php echo $name; ?></strong></font></span>
                           		
                            </div>
                        <?php
						if($count%2==0)
						{
							?>
                            <div class="left" >&nbsp;</div>
	                        <div class="left" >&nbsp;</div>
                            <?php
						}
					}
					?>
                    </div>
    <?php
}
?>
						
</body>
</html>
                        