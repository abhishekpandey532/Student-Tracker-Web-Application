<?php
//include('example.php');
session_start();
include('config.php');

$month;
echo $code=$_SESSION["code"];

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$months=$_POST["start"];
$monthe=$_POST["end"];
}

$q1="SELECT `date`,`name`,`in_time`,`out_time` FROM `gb_attendance_june` WHERE  `code` = $code";
$q2="SELECT `date`,`remark`,`added_by` FROM `leave`";
$q3="SELECT date_start,date_end,time from halfday";
$q4="SELECT count(*) as number FROM `leave`";
$q5="SELECT count(*) as number FROM `gb_attendance_june` WHERE date LIKE '%-$months-%' AND `code` = $code ";

$data4=mysql_query($q4) or die(mysql_error());
$row4=mysql_fetch_array($data4);
$leaves = $row4['number'];

$data4=mysql_query($q5) or die(mysql_error());
$row4=mysql_fetch_array($data4);
$daysworked = $row4['number'];




$data=mysql_query($q1) or die(mysql_error());

$data2=mysql_query($q2) or die(mysql_error());
//$row2=mysql_fetch_array($data2);

$data3=mysql_query($q3) or die(mysql_error());
$row3=mysql_fetch_array($data3);


//Full Day or Half Day

echo "<br/>";
echo $time=$row3['time'];
echo "<br/>";
$check = strtotime("9:30:00");
//  echo "<br/>";
 $ro=strtotime($row["in_time"]); 

  if($ro<$check)
      echo "Full Day";
    else
      echo "Half Day";

while($row2=mysql_fetch_array($data2)){

$leave=date('Y-m-d',strtotime($row2['date']));
$resultA[$leave]=$weekend."CLOSED"."<br/>Reason:".$row2['remark']."<br/>Added By".$row2['added_by'];
}

while($row=mysql_fetch_array($data)) {
   
//echo $weekend= isWeekend(date('Y-m-d',strtotime($row['date'])));

$curr=date('Y-m-d',strtotime($row['date']));
$check = strtotime("9:30:00");
$ro=strtotime($row["in_time"]); 
  if($ro<$check)
      $resultA[$curr]=$weekend."FULL DAY"."<br/>In Time:".$row['in_time']."<br/>Out Time:".$row['out_time'];
    else
     $resultA[$curr]="HALF DAY"."<br/>In Time:".$row['in_time']."<br/>Out Time:".$row['out_time'];

//$resultA[$curr]=17;
//$resultA['2015-06-12']=5;
//echo "<br/>".$resultA[$curr];
}

echo $resultA[$curr];


function draw_calendar($month,$year,$resultA)
{

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

  /* days and weeks vars now ... */
 $running_day = date('w',mktime(0,0,0,$month,1,$year));
// $weekend= isWeekend(date('Y-m-d',strtotime($running_day)));
//Check for weekend or not. 
if(date('w', strtotime($running_day)) == 6 || date('w', strtotime($running_day)) == 0) {
    echo 'Event on a weekend';
} else {
    echo 'Event is on a weekday'; 
}
 $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;



  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    $calendar.= '<td class="calendar-day">';
      /* add in the day number */
      $calendar.= '<div class="day-number">'.$list_day.'</div>';

        $date=date('Y-m-d',mktime(0,0,0,$month,$list_day,$year));
        //echo "<br/>".$weekend= isWeekend($date);
        $tdHTML='';        
        if(isset($resultA[$date])) 
          {
            $tdHTML=$resultA[$date];
            //$in=
          }
         // else
           // $tdHTML="ABSENT";
            
      //  if($tdHTML == "CLOSED") 
      //$calendar.='<td bgcolor="#00FF00>'.$tdHTML;      
      //else
        $calendar.=$tdHTML;      
      
    $calendar.= '</td>';

    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';

  /* all done, return result */
  return $calendar;
}

function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}

function countDays($year, $month, $ignore) {
    $count = 0;
    $counter = mktime(0, 0, 0, $month, 1, $year);
    while (date("n", $counter) == $month) {
        if (in_array(date("w", $counter), $ignore) == false) {
            $count++;
        }
        $counter = strtotime("+1 day", $counter);
    }
    return $count;
}
?>

<style>
table.calendar    { border-left:1px solid #6897c3; }
td{vertical-align: top;}
tr.calendar-row  {  }
td.calendar-day  { height:80px; min-width: 180px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
td.calendar-day:hover  { background:#eceff5; }
td.calendar-day-np  { background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#6897c3; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:5px solid #6897c3; border-top:1px solid #6897c3; border-right:1px solid #6897c3; color: #fff; }
div.day-number    { background:#6897c3; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #6897c3; border-right:1px solid #6897c3; }

</style>

<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
</head>
<body>
  <h2 align="center">Enter the Month You want to be displayed</h2>
<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Start Month:<input type="text" name="start" value="">
End Month:<input type="text" name="end" value="">

<br/>
<br/>
<input type="submit" value="submit">


</form>





<a href="logout.php">Log Out</a>
<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$months=$_POST["start"];
$monthe=$_POST["end"];
}

//$month=$_POST["start"];
       

echo $month;
while($months<= $monthe) {
//echo $row_counter;
//echo $daysworked;
$workingdays=countDays(2015, $months, array(0, 5)); // 23
//for people working alternate saturdays. Include this in db.
$workingdays=$workingdays+2;
//No. of days Office was open.
$absent=$workingdays-$leaves-$daysworked;
//$absent=$leaves-$absent;

echo "<b><br/><br/>No. of Working Days excluding leaves:  ".($workingdays-$leaves);


echo "<b><br/><br/>No. of days WORKED:  ".$daysworked;

echo "<b><br/><br/>No. of days ABSENT:  ".$absent;

echo "<br/><br/>";

echo draw_calendar($months,2015,$resultA);
  //echo isWeekend($row['date']);

$months=$months+1;
}
 ?>
<a href="leave.php?month=<?php echo $month; ?>">LEAVE DAY</a>
<a href="changecard.php?month=<?php echo $month; ?>">CHANGE CARD</a>

<?php
/*
Add Logic to print he number of days absent and number of
days present.
In absent days do consider the days office was closed 
and do not count those days as absent days.
*/


?>









</body>
</html>