<?php

# http://usweb035.bethel.jw.org/index.php?module=API&method=API.get&format=XML&idSite=1&period=day&date=2013-07-01&expanded=1&filter_limit=100&token_auth=374805691fffff75a8082cdf04a26f66

# Generate a bulk API URL for the current month

$strURL = "http://ussrv062.bethel.jw.org/index.php?module=API&method=API.getBulkRequest&format=xml&idSite=1";
$intURL = 0;

$month=$_REQUEST['m'];
$year=$_REQUEST['y'];
$printIt=$_REQUEST['p'];

$interval = new DateInterval("P1D");

# Must add 1D to endDate otherwise it won't be included in the datePeriod
$endDate = new DateTime(date("Y-m-d", strtotime("last day of $month $year")));
$endDate = $endDate->add($interval);

$datePeriod = new DatePeriod(new DateTime(date("Y-m-d", strtotime("first day of $month $year"))), $interval, $endDate);
foreach($datePeriod as $dt)
{
   $day=$dt->format("Y-m-d\n");
   $strURL .= "&urls[{$intURL}]=" . urlencode("method=API.get&period=day&date=$day&expanded=1&filter_limit=100");
   $intURL++;
}

$strURL .= "&token_auth=374805691fffff75a8082cdf04a26f66";

if(!isset($printIt))
{
   $results = file_get_contents($strURL);
   $results = html_entity_decode($results);
   $results = preg_replace("/<\?xml.*?\>/", "", $results);
   $results = preg_replace("/<\/?result>/", "", $results);
   header("Content-Type: text/xml; charset=utf-8");
   print "<result>$results</result>";
}
else
{
   print $strURL;
}
?>
