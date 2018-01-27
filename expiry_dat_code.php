<?php 
				$date=$data->date;
                $old_format=date('Y-m-d', strtotime($date));
                  $today=date('Y-m-d');
                $org_date=date('d-m-Y', strtotime($date));
                if($old_format<$today){
                    $date1 = date_create($old_format);
                    $date2 = date_create($today);
                    $dateDifference = date_diff($date1, $date2)->format('%d, %m');
                    $diff_date=explode(',', $dateDifference);
                    foreach($diff_date as $diff_dat){
                        $day=$diff_date[0];
                        $month=$diff_date[1];
                    }
                    $set[]=$day.' Days';
                    if($month!=0){
                        $set[]=$month.' Month';
                    }
                    $diff_show=implode(',', $set);
                    $data['difference']=$diff_show;
?>