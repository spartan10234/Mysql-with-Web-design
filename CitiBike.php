<!DOCTYPE html>
<html>
  <head>
    <title>CitiBike Project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
  </head>
  <style>
    body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
    text-align: center;
    }
    table, th, td, tr {
    border: 1px solid black;
    align-content: center;
        margin: 0 auto;
    }
    h1{
    text-align: center;
    text-decoration: underline;
    text-decoration-color: aqua;
    }
    p{        
    color: blue;
    max-width: 500px;
    text-align: center;
    margin: 0 auto;
    }
    .defaultTextBox {
    padding: 0;
    height: 30px;
    position: relative;
    left: 0;
    outline: none;
    border: 1px solid #cdcdcd;
    border-color: rgba(0,0,0,.15);
    background-color: white;
    font-size: 16px;
    }
    .advancedSearchTextbox {
    width: 526px;
    margin-right: -4px;
    }

    <!--table, th, td {
    border: 1px solid black;
    }-->
  </style>
  
  <body>
    <img src="https://bpca.ny.gov/wp-content/uploads/2016/08/tumblr_static_brs9croh9ag4wk40cc440oc0s.png" alt="Citibike NY" width="700" height="150">
    <!--h1> CitiBike</h1-->
    <p>Where do Citi Bikers ride? When do they ride? <br />How far do they go?
      Which stations are most popular? <br />What days of the week are most rides
      taken on? We've heard all of these questions and more from you,<br /> and
      we're happy to provide the data to help you discover the answers to
      these questions and more.</P>

    <form action = "CitiBike.php" method="POST" id = "transfer">
      <h2>Input MySql statements (Table Names: Time, Trip, Station):</h2>
      <input type="text" name="statement" style="width:80%" autofocus />
      <!--textarea rows="4" cols="50" autofocus=""></textarea-->
      <br>
      <input type="submit">
    </form>
    <p> Group 2: Trenton Rackerby, Eduardo Roman, Jonathan Gil. </p>
    <!--textarea name="comment" form="transfer" rows="4" cols="50" autofocus=""></textarea-->
    <br>

    <?php
      require_once('insert.php');
      $User_query = $_POST['statement'];

      $pieces = explode(" ", $User_query);

      if(strcasecmp($pieces[0],"drop")== 0)
      {
      $User_query = "";
      echo "'Drop' Statements not allowed!\n";
      }
      
      if(strcasecmp($pieces[0], "create") == 0 || strcasecmp($pieces[0],"update") == 0)
      {
      echo "Table Created/Updated: " . $pieces[2] . "\n";
      }

      if(strcasecmp($pieces[0], "insert") == 0)
      {
      echo "Row inserted\n";
      }
      if(strcasecmp($pieces[0], "delete") == 0)
      {
      echo "Row(s) deleted\n";
      }



      
      $result_set = mysqli_query($connection, $User_query)
      or die(mysqli_error($connection));
      
      if(!$result_set)
      {
      echo n12br("Statement not inserted or valid\r\n: ");
      }
      else
      {
      echo nl2br("Statement is valid\r\n");
      }
      ?>
    <br>
    <?php
      if($pieces[0] != "drop" ){
      ?>
    <table align = center>
      <?php
        $row = mysqli_fetch_assoc($result_set);
	$total_row = $row[0];
	$num_rows = mysqli_num_rows($result_set);
	echo "Total records: " .$num_rows;
	?>
      <tr>
        <?php
	  foreach($row as $key => $value){
        ?>
        <th>
	  <?php
	    echo $key;
	    } ?>
        </th>
      </tr>
      <?php mysqli_data_seek ($result, 0);
	    while($row = mysqli_fetch_assoc($result_set)){ ?>
      <tr>
	<?php
	  foreach($row as $value){ ?>
	<td align = center>
	  <?php echo $value; ?>
	</td>
	<?php } ?>
      </tr>
      <?php }; ?>
    </table>
    <?php
      }
      else
      {
      echo "Drop statement cannot be accepted";
      }
      mysqli_free_result($result_set);
      mysqli_close($connection);
      ?>
    <br>
    <br>
  </body>
</html>
