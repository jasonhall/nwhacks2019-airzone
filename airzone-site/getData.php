<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include 'connect.php';

function getJson($sql, $cmp)
{
    $conn = OpenCon();
    $result = $conn->query($sql);

    $rows = array();
    $table = array();
    $table['cols'] = array(
        array('label' => 'Date', 'type' => 'string'),
        array('label' => strtoupper($cmp), 'type' => 'number')
    );

    foreach ($result as $r) {
        $temp = array();
        $temp[] = array('v' => substr((string)$r['date'], 5, 5));
        $temp[] = array('v' => (int)$r[$cmp]);
        $rows[] = array('c' => $temp);
    }

    $table['rows'] = $rows;

//$jsonTable = json_encode($table);
    CloseCon($conn);

    return json_encode($table);
}

function make_chart($cmp, $sql, $title, $axis, $chart)
{
    $chart_func = "google.setOnLoadCallback(" . $cmp . "_Chart);";
    $chart_func .= "function " . $cmp . "_Chart() {";
//    $chart_func .= "let data = new google.visualization.DataTable(" . getJson($sql, $cmp) . ");";
if ($cmp == 'co') $trial = '{"cols":[{"label":"Date","type":"string"},{"label":"CO","type":"number"}],"rows":[{"c":[{"v":"01-01"},{"v":0.245}]},{"c":[{"v":"01-02"},{"v":0.235}]},{"c":[{"v":"01-03"},{"v":0.251}]},{"c":[{"v":"01-04"},{"v":0.294}]},{"c":[{"v":"01-05"},{"v":0.323}]},{"c":[{"v":"01-06"},{"v":0.405}]},{"c":[{"v":"01-07"},{"v":0.174}]},{"c":[{"v":"01-08"},{"v":0.237}]},{"c":[{"v":"01-09"},{"v":0.281}]},{"c":[{"v":"01-10"},{"v":0.295}]},{"c":[{"v":"01-11"},{"v":0.27}]},{"c":[{"v":"01-12"},{"v":0.24}]},{"c":[{"v":"01-13"},{"v":0.277}]},{"c":[{"v":"01-14"},{"v":0.331}]},{"c":[{"v":"01-15"},{"v":0.44}]},{"c":[{"v":"01-16"},{"v":0.364}]},{"c":[{"v":"01-17"},{"v":0.387}]},{"c":[{"v":"01-18"},{"v":0.447}]},{"c":[{"v":"01-19"},{"v":0.297}]},{"c":[{"v":"01-20"},{"v":0.233}]},{"c":[{"v":"01-21"},{"v":0.212}]},{"c":[{"v":"01-22"},{"v":0.221}]},{"c":[{"v":"01-23"},{"v":0.248}]},{"c":[{"v":"01-24"},{"v":0.365}]},{"c":[{"v":"01-25"},{"v":0.491}]},{"c":[{"v":"01-26"},{"v":0.382}]}]}';
else
$trial = getJson($sql, $cmp);
    $chart_func .= "let data = new google.visualization.DataTable(" . $trial . ");";
    $chart_func .= "let options = {";
    $chart_func .= "title: '" . $title . "',";
    $chart_func .= "hAxis: {title: 'Date (month-day)'},";
    $chart_func .= "vAxis: {title: '" . $axis . "'},";
    $chart_func .= "width: 550,";
    $chart_func .= "height: 400};";
    $chart_func .= "let chart = new google.visualization.LineChart(document.getElementById('" . $chart . "'));";
    $chart_func .= "chart.draw(data, options);}";
    return $chart_func;
}

