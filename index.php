  <!--- Jaleta Fanta Tesgera

        This is my contact form. I have used a couple refrences and sources for this and the CSS, I have them in order below:
        W3 Schools
        Stack Overflow
        Hostinger (for font tips)
        Tutorialspoint 
        Htmlcolorcodes
        Online tutorials Youtube channel 
        
        I hope you enjoy the output, and for any feedback or comment please feel free to fill out my contact form, Thank you!  --->
       


        <html>


          <head>
              
              <link rel="styleSheet" href="CSS_Folder/JFT_Contact_Form_CSS.css"> <!--- Provides a link to the Style Sheet ---> 
               
              <title>  Contact Jaleta Tesgera </title> <!--- The title of the contact form --->
                  
          </head>
      
          <body>

<!-- I am opening a php tag to verfiy that the inputs in the form are valid and not null -->
          <?php 

//This hides the php error reports so we don't initally see them in our page
error_reporting(0);

//we initially declare the variables 
$fnameErr = $lnameErr = $emailErr = $phoneErr = "";
$first_name = $last_name = $phone_number = $its_the_email = "";


// If the User requests to "Post" the form by the submit button the following will occur
if ($_SERVER["REQUEST_METHOD"] == "POST") {


// I have the "Loop" version for the validation in the java Script so I didn't go with it again; You can see commented below
// However, I have the detailed "if-statement" verification below


 // Loop and Array Validation Method
/*
  $inputs = array('first_name','last_name','phone_number','its_the_email');
  $err = array($fnameErr, $lnameErr, $phoneErr, $emailErr);
  $messages = array("First Name", "Last Name", "Phone Number", "Email Address");
  $variables = array($first_name, $last_name, $phone_number, $its_the_email);

for($i=0; $i<4; $i++){

  if (empty($_POST[$inputs[$i]])) {
      $err[$i] = $messages[$i]."is required";
    } else {
      $variables[$i] = test_input($_POST[$inputs[$i]]);
    }  

  if (($_POST[$inputs[2]]) == "") {

    if(!preg_match('/^[0-9]{10}+$/',$_POST[$inputs[2]])) {
        $err[2] = $messages[2]."must be valid";
        }  
      else {
        $variables[2] = test_input($_POST[$inputs[2]]);
         }
  } 

  if (($_POST[$inputs[3]]) == "") {

    if(!filter_var($_POST[$inputs[3]], FILTER_VALIDATE_EMAIL)){
      $err[3] = $messages[2]."must be valid";
        } 
       else {
        $variables[3] = test_input($_POST[$inputs[3]]);
  } 
 }
 } */


  // Detailed if statement validation method 
  // Fname validation (not null)
  if (empty($_POST['first_name'])) {
    $fnameErr = "First Name is required";
  } else {
    $first_name = test_input($_POST['first_name']);
  }
  
  //Lname validation (not null)
  if (empty($_POST['last_name'])) {
    $lnameErr = "Last Name is required";
  } else {
    $last_name = test_input($_POST['last_name']);
  }

  //Phone Number validation (valid and not null)
  if (empty($_POST['phone_number'])) {
    $phoneErr = "Phone number is required";
  } 
  else if(!preg_match('/^[0-9]{10}+$/',$_POST['phone_number'])) {
    $phoneErr = 'Phone Number must be valid';
  }  
  else {
    $phone_number = test_input($_POST['phone_number']);
  }

  //Email Address validation (valid and not null)
  if (empty($_POST['its_the_email'])) {
    $emailErr = "Email address is required";
  } 
  else if(!filter_var($_POST['its_the_email'], FILTER_VALIDATE_EMAIL)){
    $emailErr = 'Email must be valid';
  } 
  else {
    $its_the_email = test_input($_POST['its_the_email']);
  }

// Final "If statement" if all the values are valid and not null.
  if ($first_name != "" && $last_name != "" && $phone_number != "" && $its_the_email != "") {    

    // We collect all the non-required variables (they don't have to pass through verification proccess) from the input 
$options = test_input($_POST['options']);
$contact_subject = test_input($_POST['contact_subject']);
$other_subjects = test_input($_POST['other_subjects']);
$the_body = test_input($_POST['the_body']);


    //This is the database submit section using SQL
      $conn = new mysqli('localhost','jale74167804_jtesgera','@1b2c3d$','jale74167804_CLIENTS');
       if($conn->connect_error){
      echo "$conn->connect_error";
      die(" SQL Connection Failed : ". $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into Client_Info(Fname, Lname, Phone, Email, Preferred_Contact, Subject, Other, Body)
            values(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $first_name, $last_name, $phone_number, $its_the_email, $options, $contact_subject, $other_subjects, $the_body);
        $stmt->execute(); 
        $stmt->close();
        $conn->close();
    }



    // We are collecting all the other variables as a SESSION so we could extract it at the other php
    session_start();
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['its_the_email'] = $its_the_email;
    $_SESSION['options'] = $options;
    $_SESSION['contact_subject'] = $contact_subject;
    $_SESSION['other_subjects'] = $other_subjects;
    $_SESSION['the_body'] = $the_body;

    // Once the verification proccess is done and we have the other not-required variables we will procced to the other php section 
    // that makes cookies and sends mail, an exit from this one.
    header("Location: Php_Folder/JFT_Contact_Form_PHP.php");
    exit();
}

}

// This function protects against attackers by timming extra spaces, slashes, and against special characters
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?> 



      
            <!--- This div block division makes styling my cotact form easier --->
            <div class = "box">
             
            <div style="width: 53%; text-align: center;">
            <p align="justify" style="color:white;">
            Hello my name is Jaleta Tesgera. I am a Junior eager to jump into the professional software 
            engineering side of Computer Science. Demonstrated fast learning and adaptability skills with a
            remarkable ability to solve problems independently and jointly in coding environments and my 
            employment. Experienced languages include Java, C++, Java Script, Kotlin, SQL, PHP, Arduino, 
            Html, and CSS. Worked with VS code, Code Blocks, GitHub, Net beans, Workbench, cPanel, XAMPP,
            and Tableau. To learn more about me, you can find my resume attached <a href="http://jaletaftesgera.com/Resume/Jaleta_Tesgera_SWEI_Resume.pdf">here</a>. <br> <br>

            This below is a contact form I designed using HTML, CSS, and Java Script that stores cookies 
            and sends me the generated emails. Your responses are validated, stored, and sent using PHP 
            and organized in SQL Workbench. The validation on this form is done using PHP, if you want the 
            Java Script validation experience click <a href="http://jaletaftesgera.com/Contact/JFT_Contact_Form.html">here</a>. Please feel free to fill out the form. Thank you.  
            </p>
            </div> 
            <br><br>
             <h1 text-align="center"> Contact Me </h1> <br>  <!--- The header for the Contact Form--->
      
      
             <!--- This div section includes the main components of the Contact Form --->
              <div class="jftcontact">
      
                  <form id = "contact_form" method="POST" action="/">
              
      
                   <!--- Text box for the First Name --->
                   <div class="required_sections">
                    <label for="fname">First Name*: </label>
                    <input type="text" id="fname" name="first_name" placeholder="First name" value="<?php echo $_POST['first_name'];?>"> <!--- Give the inputboxes values so they can retain their right/wrong inputs --->
                    <!--- A small tag for the error message by js and A span to display the error message  in php --->
                    <small>Error message </small> <span class="error_ss"> <?php echo $fnameErr;?> </span> <br>
                    </div>
                
       
                    <!--- Text box for the Last Name --->
                    <div class="required_sections">
                    <label for="lname">Last Name*: </label>
                    <input class="lnamebox" type="text" id="lname" name="last_name" placeholder="Last name" value="<?php echo $_POST['last_name'];?>" >  <!--- Give the inputboxes values so they can retain their right/wrong inputs --->
                    <!--- A small tag for the error message by js and A span to display the error message  in php --->
                    <small>Error message</small> <span class="error_ss"> <?php echo $lnameErr;?> </span> <br>
                    </div>
       
                    <!--- Tel box for the Phone Number --->
                    <div class="required_sections">
                    <label for="pnumber">Phone No*: </label>
                    <input type="tel" id="pnumber" name="phone_number" placeholder="( - - - ) - - -  - - - - " value="<?php echo $_POST['phone_number'];?>">  <!--- Give the inputboxes values so they can retain their right/wrong inputs --->
                    <!--- A small tag for the error message by js and A span to display the error message  in php --->
                    &nbsp; <small>Error message</small> <span class="error_ss"> <?php echo $phoneErr;?> </span> <br>
                    </div>
                    
                    <!--- Email box for the Email --->
                    <div class="required_sections">
                    <label for="the_email">Email*: </label>
                    <input type="email" id="email" name="its_the_email" placeholder="example@xyz.com" value="<?php echo $_POST['its_the_email'];?>" >  <!--- Give the inputboxes values so they can retain their right/wrong inputs --->
                    <!--- A small tag for the error message by js and A span to display the error message  in php --->
                    &nbsp; &nbsp; &nbsp;<small>Error Message</small> <span class="error_ss"> <?php echo $emailErr;?> </span> <br>
                    </div>
       
      
                   <!--- Radio Button for the Preferd Mode of Contact --->
                   <label for = "your_email">Preferred mode of Contact:  </label>
                     <!--- Having the same name makes the user only select one radio button at a time--->
                   <input type="radio" id="your_email" name="options" value="Email">
                   <label for="your_email">Email</label>  &nbsp 
                   <input type="radio" id="your_pnumber" name="options" value="Phone"> 
                   <label for="your_pnumber">Phone</label> <br> <br>
                   
                   <!--- Dropdown for the Subjects options --->
                   <label for="subject">Subject: </label>
                   <select id="subject" name="contact_subject" >
                     <option value=""> </option>
                     <option value="Inquiries">Inquiries</option>
                     <option value="Comments">Comments</option>
                     <option value="Business">Business</option>
                     <option value="Other">Other</option>
                   </select>  <br>
                              
                   <!--- Text box for a description of the "Other" option --->
                   <label for="other">If other please specify: </label>
                   <input type="text" id="other" name="other_subjects"> 
                   
                   <!--- Text area for a description of the individuals message --->
                   <!--- Having the text area under a p section will help me align the label and text are on a central line --->
          
                   <p class = "text_message">
                   <label for="message_body">Body*: </label> 
                   <textarea id="body" class = "message_body" name="the_body" placeholder="Start typing your message here."  ></textarea>   </p>
                   &nbsp; &nbsp; &nbsp; &nbsp;  <br>
                 
      
                   <!--- Checkboxes for promotion and aggremment to terms and conditions --->
                   <!--- Having a separate div block is goign to be useful in justifying these texts --->
                   <div class = "tandc">
                   <input type="checkbox" id="promo" name="signup_updates" value="Yes">
                   <label for="promo">
                     Sign me up to receive updates of any additional content on the website
                   </label> <br> <br>
                   <input type="checkbox" id="tandc" name="terms_and_conditions" value="Agree">
                   <label for="tandc">
                     I agree and accept the conditions that submitting multiple contacts, 
                     or falsifying them will result in only having one response and possibly being banned from this site.
                   </label> <br> 
                   </div>
      
                   <!--- Submit Button --->
                   <!--- I will use thee class name later in styling this button --->
                   <button id="submit" type="submit" name="submit" class="last_button">Submit</button> <br>
                   
                   <script src="JS_Folder/JFT_Contact_Form_JS.js"> </script> <!--- Provides a link to the Java Script ---> 
      
                </form>


                

            
               </div>
      
             </div>
      
             
             
          </body>
      
        
      </html>
      
      