/* This is the JScript page (sources and acknowledgment found in the main HTML page) */

// We get the variables from the input by their ids
const form = document.getElementById('form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const phone = document.getElementById('pnumber');
const email = document.getElementById('email');



// Picks up on the submitting action from a form and if they all pass the validation test and are not null the form will submit
// However is the values dont pass the validation tests cancel the submit and report which values are invalid to the user. 
form.addEventListener('submit', e => {
   
if (fname.value !='' && lname.value !='' && phone.value !='' && email.value !='' && isValidEmail(email.value) && isValidPhone(phone.value)) {     
    e.submit(); 
} 
else {
    e.preventDefault();
    checkInputs();
}

});

// Form Input Validation Function
function checkInputs() {

    // trim to remove the whitespaces
	const fnameValue = fname.value.trim();
	const lnameValue = lname.value.trim();
	const phoneValue = phone.value.trim();
	const emailValue = email.value.trim();
	
    // Declare Arrays so it will be easier to loop through errors
    const Values = [fnameValue, lnameValue, phoneValue, emailValue];
    const Initials = [fname, lname, phone, email];
    const Messages = ["First Name ","Last Name ","Phone Number ","Email "];

    // This is the loop to verify the null and formatting errors
    for(var i=0;i<4;i++) {
    if(Values[i] === '') {
		setErrorFor(Initials[i], Messages[i] + 'cannot be blank');
	} 
    else {
    setSuccessFor(Initials[i]);
    }
    if (Values[2]!='') {
        if (!isValidPhone(Values[2])) {
	 	setErrorFor(Initials[2], 'This is not a valid ' +  Messages[2]);
     } else {
	 	setSuccessFor(Initials[2]);
	 }
    }
    if (Values[3]!='') {
        if (!isValidEmail(Values[3])) {
	 	setErrorFor(Initials[3], 'This is not a valid ' + Messages[3]);
     } else {
	 	setSuccessFor(email);
	 } 
    }
  }
}

     

// Function that states error messages for the respective inputs by adding to the class of a required section
// This will send a message and border the input boxes red
function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'required_sections error';
	small.innerText = message;
}

// Function that takes a value and normalizes the border color
function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'required_sections success';
}

// Function that verifies the email using REGEX
function isValidEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

// Function that verifies the phone number using REGEX
function isValidPhone(phone) {
    return /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/.test(phone);
}
