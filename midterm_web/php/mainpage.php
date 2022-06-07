<?php

  include_once("dbconnect.php");
  $sqlsubj = "SELECT * FROM tbl_subjects";
  $statmentsubj =$conn->prepare($sqlsubj) ;
  $statmentsubj->execute();
  $rows =   $statmentsubj ->fetchAll();


  $results_per_page = 10; 
if (isset($_GET['pageno'])) { 
 $pageno = (int)$_GET['pageno']; 
 $page_first_result = ($pageno - 1) * $results_per_page; 
} else { 
 $pageno = 1; 
 $page_first_result = 0; 
} 

$stmt = $conn->prepare($sqlsubj); 
$stmt->execute(); 
$number_of_result = $stmt->rowCount(); 
$number_of_page = ceil($number_of_result / $results_per_page); 

$sqlsubj = $sqlsubj . " LIMIT $page_first_result , $results_per_page"; 
$stmt = $conn->prepare($sqlsubj); 
$stmt->execute(); 

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
$rows = $stmt->fetchAll(); 

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>
<body>

<!-- Side Navigation -->
<div class="w3-sidebar w3-bar-block w3-blue-grey w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">My profile</a>
  <a href="#" class="w3-bar-item w3-button">courses</a>
  <a href="tutors.php" class="w3-bar-item w3-button">tutors</a>

  <a href="#" class="w3-bar-item w3-button">subscription</a>
  <a href="login.php" class="w3-bar-item w3-button">Logout</a>
</div>

<header class="w3-container w3-theme w3-padding" id="myHeader">
<button class="w3-button w3-light-blue w3-xxlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-center">
  <h4> SCHOOL OPPORTUNITIES</h4>
  <h4 class="w3-xxxlarge w3-animate-bottom">WELCOME TO MY TUTOR</h4>
  </div>
</header>

<div class="w3-center">
  <hr>
  <h2>Available Classes</h2>
  <hr>
</div>


<div class="w3-padding w3-margin w3-center">
<div class="w3-grid-template">

  
  <?php
  $i = 0;
  foreach ($rows as $subjects) {
    $i++;
    $subjid = $subjects['subject_id'];
    $subjname = $subjects['subject_name'];
    $subjdescription = $subjects['subject_description'];
    $subjprice = $subjects['subject_price']; 
    $tutorid = $subjects['tutor_id'];
    $subjsessions = $subjects['subject_sessions'];
    $subjrating = $subjects['subject_rating'];



    echo "<div class='w3-card-4 w3-round' style='margin:5px'>";
    echo "<a> <img class='w3-image' src=../assets/courses/$subjid.png" .
        " onerror=this.onerror=null;this.src='../image/image.png'"
        . " style='width:100%;height:250px'></a><hr>";
        echo "<div class='w3-container'><h5><b>$subjname</b></h5><b>Price: RM $subjprice </b><br><b>Rating: $subjrating</b>
        <br><br><button class='button button2' id='myBtn'>Read more</button><button class='button button2'>Join class</button>
        <div id='myModal' class='modal'>
  <div class='modal-content'>
    <span class='close'>&times;</span>
    <p>Name:$subjname <br> Description:$subjdescription <br> Price: RM$subjprice<br>  Secssition:$subjsessions<br> Rating:$subjrating</p>
  </div>

</div>

        </div>  
        </div>";
    
}

?>
</div>
<br>



<?php

 $num = 1; 
 if ($pageno == 1) { 
 $num = 1; 
 } else if ($pageno == 2) { 
 $num = ($num) + 10; 
 } else { 
 $num = $pageno * 10 - 9; 
 } 
 echo "<div class='w3-container w3-row w3-padding-32'>"; 
 echo "<center>"; 
 for ($page = 1; $page <= $number_of_page; $page++) { 
 echo '<a href = "mainpage.php?pageno=' . $page . '" style= 
 "text-decoration: none">&nbsp&nbsp' . $page . ' </a>'; 
 } 
 echo " ( " . $pageno . " )"; 
 echo "</center>"; 
 echo "</div>"; 
?>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>




<footer>
		<p>
        <p> copyright halHasmad©</p>
		</p>
	</footer>
  <script type="text/javascript" src="../js/js.js"></script>
</body>
</html>