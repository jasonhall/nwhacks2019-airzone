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
    CloseCon($conn);

    return json_encode($table);
}

function make_chart($cmp, $sql, $title, $axis, $chart)
{
    $chart_func = "google.setOnLoadCallback(" . $cmp . "_Chart);";
    $chart_func .= "function " . $cmp . "_Chart() {";
    $chart_func .= "let data = new google.visualization.DataTable(" . getJson($sql, $cmp) . ");";
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

