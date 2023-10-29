<?php 

/* This is the PHP page (sources and acknowledgment found in the main HTML page) */

// This section extratcs the variable values from the index php file 
session_start();
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$phone_number = $_SESSION['phone_number'];
$its_the_email = $_SESSION['its_the_email'];
$options = $_SESSION['options'];
$contact_subject = $_SESSION['contact_subject'];
$other_subjects = $_SESSION['other_subjects'];
$the_body = $_SESSION['the_body'];
    
$servername = "localhost";
$username = "jale74167804_jtesgera";
$password = "@1b2c3d$";
$dbname = "jale74167804_CLIENTS";



 $userCookie = "userCookie"; // Name

 $cookieArray = array("firstName" => $first_name,   
                      "lastName" => $last_name,   
                      "phoneNumber" => $phone_number,
                      "email" => $its_the_email );   // Value
                       
  $expireTime = time() + 3600 * 24; // Sets the expire time to 1 day 
 
  setcookie($userCookie, json_encode($cookieArray), $expireTime,"/");      // Setting the cookie.
 
  $jsonDecoded = json_decode($_COOKIE[$userCookie], true);

 /* Throwing a try catch statement incase it fails */
                    try { 
                      

                    /* This is the if statement that checks whether we have a the cookies in the array setup or not */
                    /* If we have a cookie set up it will redirect us to a new thank you page  and if we don't it will refresh the page.*/
                         if ( isset($_COOKIE[$userCookie])) {
                             
                             
                             
                            
                            
    
/* This is the recepient, mail header, subject, and message of the mail */
$to = "jaletaft24@gmail.com";
$subject = "Subject: ".$contact_subject;
$message = "Full Name: ".$first_name." ".$last_name."\r\nPhone number: ".$phone_number."\r\nEmail Address: ".$its_the_email."\r\nPreferd method of Contact: ".$options."\r\n"."\r\nMessage: ".$the_body;

mail($to,$subject,$message) or die("EL FORM NO BUENO SENIOR");      


 /* I am calling the database */ 
 
               $conn = mysqli_connect('localhost','jale74167804_jtesgera','@1b2c3d$','jale74167804_CLIENTS');
               $sql = mysqli_query($conn, "SELECT * FROM Client_Info ORDER BY id DESC LIMIT 1");
               $print_data = mysqli_fetch_row($sql);

               $last_id  = $print_data[0];
               $last_fname  = $print_data[1];
               $last_lname  = $print_data[2];
               $last_phone  = $print_data[3];
               $last_email  = $print_data[4];
               $last_pc  = $print_data[5];
               $last_subject  = $print_data[6];
               $last_other  = $print_data[7];
               $last_body  = $print_data[8];


/* This is the redirection page in html which follows the same style of my previous page */ 

echo '
<html>
    <body>
    <link rel="styleSheet" href="../CSS_Folder/JFT_Contact_Form_CSS.css"> <!--- Provides a link to the Style Sheet ---> 
    <div class = "box">     
    <h1 text-align="center"> Thank You! </h1> <br> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <h4 style="color:white;"> Your summary looks like this</h4> <br>
    
    <div class="sql_last_id" style="background-color: #f2f2f2; opacity: 0.85; padding: 20px; border-radius:3px;">
    
        <div class="table-responsive">
        
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
     
            <table class="table table-bordered" style=" color:rgba(0, 0, 0, 0.473);">

                  <tr>
                     <th>ID</th>
                     <th>F Name</th>
                     <th>L Name</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Preferred Contact</th>
                     <th>Subject</th>
                     <th>Other</th>
                     <th>Body</th>
                  </tr>

                  <tr>
                      <td>'.$last_id.'</td>
                      <td>'.$last_fname.'</td>
                      <td>'.$last_lname.'</td>
                      <td>'.$last_phone.'</td>
                      <td>'.$last_email.'</td>
                      <td>'.$last_pc.'</td>
                      <td>'.$last_subject.'</td>
                      <td>'.$last_other.'</td>
                      <td>'.$last_body.'</td>
                  </tr>

                
            </table>
            
        </div>
    </div>
    
    
    
    <br>
    
    
    
    <div class="jftcontact" style=" color:rgba(0, 0, 0, 0.473);">
             <br><p>
               Thank you for taking your time to fill out the form '.$first_name.'. 
               I will be back to you in atleast 3 business days. Have a wondferful time. <br> MR J.
             </p><br> 
             <p class = "back_link" >Back to the <a href="../index.php">Form</a>.</p>
    </div>
    </div>
    </body>
</html>  ';                   }   
                         
                         else {
                            header("Location: /");  //This code will refresh the page
                            
                         }
                 
                     } 

                     /* This part will catch the statement incase it fails to let it fail gracefully */
                     catch (Exception $e) {
                         echo ("ERROR REFRESH AGAIN: " . $e . "<br />");
                     }

?>
