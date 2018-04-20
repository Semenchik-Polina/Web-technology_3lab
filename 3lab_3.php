<html>
    
<head>
<title>Calendar</title>
</head>
    
<body>
    <link href="3lab_3css.css" rel="stylesheet">
    
<?php
    
    function draw_calendar($month, $year)
    {   
            //dates of holidays
    $holiday_array = array(
        '1' => array(1,7), 
         array(23),
         array(8, 15),
         array(),
         array(1, 9),
         array(),
         array(3),
         array(),
         array(),
         array(),
         array(7),
         array(25)
    );
        
        $week_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_this_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        
        //drawing
        $calendar='<table cellpadding="2" cellspacing="2">';
    
        //days of week
        $days_of_week = array ('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
        $calendar .= '<tr>';
        for($i=0; $i<=6; $i++){
            $calendar.='<th>'.$days_of_week[$i].'</th>';}
        $calendar .= '</tr>';
          
        //first row
        $calendar.='<tr>';
        
        //adding empty cells before numbers
        for ($i=0; $i<$week_day; $i++)
        {
            $calendar.= '<td> </td>';
//            $days_in_this_week++;
        }
            
        //filling the caledar with numbers
        for($list_of_days=1; $list_of_days<=$days_in_this_month; $list_of_days++)
        {
            $calendar.='<td'; 
            foreach($holiday_array[$month] as  $holiday){
                if ($list_of_days == $holiday){
                    $calendar.=' class= "holiday_td" data-title="holiday"';
                }
            } 
            $calendar.='>'.$list_of_days.'</td>';
            
            if ($week_day == 6)
            {
                $calendar.='</tr>';
                if (($list_of_days+1) != $days_in_this_month){
                    $calendar.='<tr>';
                }
                
                $week_day = -1;
            }
            $week_day++;
        }
        
        //adding empty cells after numbers
        for ($i=$week_day+1; $i<7; $i++)
        {
            $calendar.= '<td></td>';
//            $days_in_this_week++;
        }
        
        $calendar.='</tr>';    
        $calendar .= '</table>';    
        return $calendar;
    }
        
    $year = $_GET['year'];
    if(!preg_match("/\d+/",$year))
    {
        echo 'The format of year provided is incorrect.';
    }
    else
    {
        echo "<h1>Calendar ".$year."</h1>";
        echo '<section class="flex-box">';
        for ($month=1; $month<=12; $month++){
            echo '<div class="month_name">'.date('F',mktime(0,0,0,$month)).'</div>';
            echo '<div>'.draw_calendar($month,$year).'</div>';   
        }
    }
    ?>
</body>
</html>