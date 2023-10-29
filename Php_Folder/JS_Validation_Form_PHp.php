
<!-- This is just a side php made I made to pick up from the Java Script Validation for the sake of being user-freiendly
 However, this is not the actual php page -->
 <?php 

/* This is the Decoy PHP page (NOT THE REAL ONE) (sources and acknowledgment found in the main HTML page) */

$first_name = test_input($_POST['first_name']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /* This is the redirection page in html which follows the same style of my previous page */ 
echo '
<html>
    <body>
    <link rel="styleSheet" href="../CSS_Folder/JFT_Contact_Form_CSS.css"> <!--- Provides a link to the Style Sheet ---> 
    <div class = "box">     
    <h1 text-align="center"> Thank You! </h1> <br> 
    <div class="jftcontact">
             <br><p>
               Thank you for taking your time to fill out the form '.$first_name.'. 
               I will be back to you in atleast 3 business days. Have a wondferful time. <br> MR J.
             </p><br> 
             <p class = "back_link" >Back to the <a href="../index.php">Form</a>.</p>
    </div>
    </div>
    </body>
</html>  ';      

?>