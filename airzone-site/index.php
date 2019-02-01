<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/gif/png" href="imgs/top/logo_title.png">
    <title>Airzone: Real-time Air Monitoring</title>


    <!--Load the AJAX API--> <!-- For Graph 1--->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.load('visualization', '1', {'packages': ['corechart']});

        <?php
        include 'getData.php';

        // O3 ------------------------------
        $sql = "SELECT date, o3 FROM daily WHERE date >= '2018-12-01'";
        $cmp = 'o3';
        $title = 'Ozone Levels in Kelowna';
        $axis = 'Ozone Concentration (ppb)';
        $chart = 'chart_div1';
        echo make_chart($cmp, $sql, $title, $axis, $chart);

        // NO ------------------------------
        $sql = "SELECT date, no FROM daily WHERE date >= '2018-12-01'";
        $cmp = 'no';
        $title = 'Nitrogen Monoxide Levels in Kelowna';
        $axis = 'Nitrogen Monoxide Concentration (ppb)';
        $chart = 'chart_div2';
        echo make_chart($cmp, $sql, $title, $axis, $chart);

        // NO2 ------------------------------
        $sql = "SELECT date, no2 FROM daily WHERE date >= '2018-12-01'";
        $cmp = 'no2';
        $title = 'Nitrogen Dioxide Levels in Kelowna';
        $axis = 'Nitrogen Dioxide Concentration (ppb)';
        $chart = 'chart_div3';
        echo make_chart($cmp, $sql, $title, $axis, $chart);

        // NO2 ------------------------------
        $sql = "SELECT date, co FROM daily WHERE date >= '2018-12-01'";
        $cmp = 'co';
        $title = 'Carbon Monoxide Levels in Kelowna';
        $axis = 'Carbon Monoxide Concentration (ppb)';
        $chart = 'chart_div4';
        echo make_chart($cmp, $sql, $title, $axis, $chart);
        ?>
    </script>
</head>

<body>
<div class="container">
    <!--- navigation bar--->
    <div id="nav">
        <div id="container_width">
            <a href="./index2.html">Home</a>
            <a href="./about.html">About</a>
            <a href="#one">Monitor</a>
            <a href="#presentation_anchor">Presentation</a>
            <a href="https://www.instagram.com/anant.goyal05">Contact</a>
        </div>
    </div>

    <!--- header --->
    <div id="about">
        <br>
        <img src = "airzone_logo.png"
             alt = "The Airzone logo"
             style = "width:100px; height:100px;">
        <div class = "text2">
            <h2>AIRZONE: Real-Time Air Monitoring</h2><p></p>
            <h5>Montitoring Air Quality In Real Time.</5><br />
            <h5>At Your Fingertips.</h5>
        </div>
    </div>

    <!--- main stuff --->
    <!--- row one container that contains the headings for graphs 1 & 2 --->
    <section class = "container">
        <div class = "row">
            <div id="one" class="col-sm-6">
                <h2>Ozone (O<sub>3</sub>) Levels</h2>
                <h6>Real time data on ozone levels at the Okanagan College in Kelowna</h6>
            </div>

            <!--- heading 2 --->
            <div id="two" class="col-sm-6">
                <h2>Nitrogen Oxide (NO) Levels</h2>
                <h6>Real time data on the nitrogen oxide levels at the Okanagan College in Kelowna</h6>
            </div>
        </div>
    </section>

    <!--- Row 2 that contains graphs 1 & 2 --->
    <!--Div that will hold the pie chart 1-->
    <section class = "container">
        <div class = "row">
            <figure class = "col-sm-6">
                <!--o3_Chart-->
                <div id="chart_div1"></div>
            </figure>

            <!--Div that will hold the pie chart 2-->
            <figure class = "col-sm-6">
                <!--no_Chart-->
                <div id="chart_div2"></div>
            </figure>
        </div>
    </section>

    <!--- Row 3 that contains the headings for graph 3 & 4 --->
    <section class = "container">
        <div class = "row">
            <div id="three" class = "col-sm-6">
                <h2>Nitrogen Dioxide (NO<sub>2</sub>) Levels</h2>
                <h6>Real time data on the nitrogen dioxide levels at the Okanagan College in Kelowna</h6>
            </div>

            <!--- Heading 4 --->
            <div id="four" class = "col-sm-6">
                <h2>Carbon Monoxide (CO) Levels</h2>
                <h6>Real time data on the carbon monoxide levels at the Okanagan College in Kelowna</h6>
            </div>
        </div>
    </section>

    <!--- Row 4 that contains graphs 3 & 4 --->
    <!--Div that will hold the pie chart 3 --->
    <section class = "container">
        <div class = "row">
            <figure class = "col-sm-6">
                <!--no2_Chart-->
                <div id="chart_div3"></div>
            </figure>

            <!--Div that will hold the pie chart 4 --->
            <figure class = "col-sm-6">
                <!--co_Chart-->
                <div id="chart_div4"></div>
            </figure>
        </div>
    </section>

<section class = "container">
<div class = "row">
<figure class = "col-sm-6">
<form method="post" action="index.php">
Date: (Please enter date in format of YYYY:MM:DD)<br>
<input type="text" name="date">
<input type="submit" name="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$conn= mysqli_connect("mysql.gecko-tech.com", "nwhackers" , "hackathonIsUs","nw_airzone");
	
	if($conn) {
		echo "Data Retrieved<br>";
	}else {
		die("Connection failed".
		mysqli_connect_error());
	}
echo "<table border='0'><tr>";
echo "<td colspan=4>".$name=$_POST["date"]."</td></tr>";
//echo "<tr><td colspan=4>".$name."</td></tr>";
echo "<tr><td>O3</td><td>NO</td><td>NO2</td><td>CO</td></tr>";
$sql="SELECT * FROM daily WHERE date='".$name."'";
$results=mysqli_query($conn,$sql);
if (mysqli_num_rows($results)>0) {
	while($row=mysqli_fetch_array($results)) {
//		echo"<br>";
//		echo "O3, NO,NO2,CO <br>";
//		echo $row[1]." ".$row[2]." ".$row[3]." ".$row[4];
//		echo "<br>";
echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
	}
echo "</td></tr></table>";
}
mysqli_close($conn);
}
?>

</figure>
</div>
</section>

    <!--- contact --->
    <div id="contact">
        <div class="text"><p></p>
            <h2><a href = "https://www.instagram.com/anant.goyal05">Contact</a></h2>
            <p>Created by: Anant, Annie, Jason, Victor.</p>
            <a href= "https://www.facebook.com/nwHacks">nwHacks 2019</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>


</body>
</html>

<body>
<!--o3_Chart-->
<div id="chart_div1"></div>
<!--no_Chart-->
<div id="chart_div2"></div>
<!--no2_Chart-->
<div id="chart_div3"></div>
<!--co_Chart-->
<div id="chart_div4"></div>
</body>
</html>
