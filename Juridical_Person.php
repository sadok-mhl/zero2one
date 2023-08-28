<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

// Database credentials
$hostname = "localhost";
$username = "id21144778_root";
$password = "sadokED926E288A*";
$database = "id21144778_neo4j";


// Create a connection
  $conn = new mysqli($hostname, $username, $password, $database);

// Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

?>
 
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
     <!-- Fontawesome CDN Link For Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Open Sans', sans-serif;
}
/* Notification Pop-up Styles */
.notification {
  position: fixed;
  top: 50px;
  left: 50%;
  transform: translateX(-50%);
  padding: 10px 20px;
  background-color: #179b81;
  color: #fff;
  border-radius: 5px;
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
  z-index: 9999;
}

.notification.show {
  opacity: 1;
}
body {
      font-family: Arial, sans-serif;
      background-color: rgb(88, 88, 88);
      margin: 0;
    }

form {
  padding: 25px;
  background: #fff;
  max-width: 500px;
  width: 100%;
  border-radius: 7px;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
  
  /* Center the form horizontally and vertically */
  position: absolute;
  margin-top: 600px;
  left: 50%;
  transform: translate(-50%, -50%);
}

form h3{
  font-size: 25px;
  text-align: center;
  margin: 0px 0 30px;
}

form .form-group {
  margin-bottom: 15px;
  position: relative;
}

form label {
  display: block;
  font-size: 14px;
  margin-bottom: 7px;
}
.back-button {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 20px;
  color: white;
  cursor: pointer;
}
form input,
form select {
  height: 45px;
  padding: 10px;
  width: 100%;
  font-size: 15px;
  outline: none;
  background: #fff;
  border-radius: 3px;
  border: 1px solid #bfbfbf;
}

form input:focus,
form select:focus {
  border-color: #9a9a9a;
}

form input.error,
form select.error {
  border-color: #f91919;
  background: #f9f0f1;
}

form small {
  font-size: 14px;
  margin-top: 5px;
  display: block;
  color: #f91919;
}

form .password i {
  position: absolute;
  right: 0px;
  height: 45px;
  top: 28px;
  font-size: 13px;
  line-height: 45px;
  width: 45px;
  cursor: pointer;
  color: #939393;
  text-align: center;
}

.submit-btn {
  margin-top: 30px;
}

.submit-btn input {
  color: white;
  border: none;
  height: auto;
  font-size: 16px;
  padding: 13px 0;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 500;
  text-align: center;
  background: #333;
  transition: 0.2s ease;
}

.submit-btn input:hover {
  background: #179b81;
}
.navbar {
  background-color: #333;
  overflow: hidden;
  text-align: center; /* Center the content */
     align-items: center;

  
}

.navbar a {
  /* Update display and margin to center the links */
  display: inline-block;
  margin: 0 15px;
  color: white;
  text-align: center;
  padding: 20px 16px;
  text-decoration: none;
}

.navbar a:hover {
  background-color: #ddd;
  color: black;
}
.right-links {
  margin-left : 90%;
  margin-top : -58px;
 
    
}

@media screen and (max-width: 900px) {
 form {
  position: absolute;
  top: 90%;
}
.navbar a {
  /* Update display and margin to center the links */
  display: inline-block;
  margin: 0 15px;
   text-align: center;
  padding: 12px 16px;
  text-decoration: none;
}

 
.right-links {
  margin-left : 80%;
  margin-top : -58px;
 
    
}
 
}
    </style>
  </head>
  <body>
      <div class="navbar">
  <a href="Home.php"><label>Home</label></a>
  <a href="graph.php"><label>Graph</label></a>
  <div class="right-links">
    <a href="logout.php"><label>Sign Out</label></a>
  </div>
</div>
    <a href="Home.php" class="back-button"><i class="fas fa-chevron-left"></i></a>
    <div class="notification" id="notification">
      Juridical Person created successfully!
          
    </div>
    <form id="userForm" action="">
      <h3>Juridical Person </h3>

      <div class="form-group fullname">
         <input disabled type="text" id="Juridical" value="Juridical" placeholder="Enter name of the company "hidden>
      </div>

      <div class="form-group fullname">
        <label for="Name">Name of company or organisation </label>
        <input type="text" id="Name" placeholder="Enter name of the company ">
      </div>
      
      <div class="form-group fullname">
        <label for="Location">Location Headquarter</label>
<select class="form-select" id="country" >
    <option value="">select country</option>
 <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antartica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo">Congo, the Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cota D'Ivoire">Cote d'Ivoire</option>
<option value="Croatia">Croatia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="France Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
<option value="Holy See">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran (Islamic Republic of)</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
<option value="Korea">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon" >Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia, Federated States of</option>
<option value="Moldova">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint LUCIA">Saint LUCIA</option>
<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia (Slovak Republic)</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
<option value="Span">Spain</option>
<option value="SriLanka">Sri Lanka</option>
<option value="St. Helena">St. Helena</option>
<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Viet Nam</option>
<option value="Virgin Islands (British)">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Serbia">Serbia</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>             <input type="text" id="city" placeholder="Enter the city ">
 </div>
      
      
      <div class="form-group fullname">
        <label for="fullname">Type</label>
        <select id="Type">
          <option value="" selected disabled>Select the Type</option>
          <option value="Company">Company</option>
          <option value="NGO">NGO</option>
          <option value="Authority">Authority</option>
          <option value="n/a">n/a</option>

        </select>      </div>

      <div class="form-group fullname">
        <label for="fullname">Industry</label>
          <select id="Industry">
        <option value="">Select an industry</option>
        <option value="Automotive Industry">Automotive Industry</option>
        <option value="Technology Industry">Technology Industry</option>
        <option value="Healthcare Industry">Healthcare Industry</option>
        <option value="Finance Industry">Finance Industry</option>
        <option value="Retail Industry">Retail Industry</option>
        <option value="Telecommunications Industry">Telecommunications Industry</option>
        <option value="Energy Industry">Energy Industry</option>
        <option value="Media and Entertainment Industry">Media and Entertainment Industry</option>
        <option value="Hospitality Industry">Hospitality Industry</option>
        <option value="Manufacturing Industry">Manufacturing Industry</option>
        <option value="Agriculture Industry">Agriculture Industry</option>
        <option value="Construction Industry">Construction Industry</option>
        <option value="Education Industry">Education Industry</option>
        <option value="Real Estate Industry">Real Estate Industry</option>
        <option value="Fashion and Apparel Industry">Fashion and Apparel Industry</option>
        <option value="Transportation Industry">Transportation Industry</option>
        <option value="Travel and Tourism Industry">Travel and Tourism Industry</option>
        <option value="Pharmaceutical Industry">Pharmaceutical Industry</option>
        <option value="Food and Beverage Industry">Food and Beverage Industry</option>
        <option value="Environmental Industry">Environmental Industry</option>
    </select>
      </div>

      <div class="form-group fullname">
        <label for="tools">Main tools used</label>
          <select id="Selecttools">
        <option value="" selected disabled>Select the tools</option>
        <!-- Options will be dynamically added here using JavaScript -->
      </select>
        <input type="text" id="tools" placeholder="Enter Main tools">
      </div>
     
       <div class="form-group fullname">
        <label for="products">Main products offered or traded</label>
        <input type="text" id="products" placeholder="Enter Main products">
      </div>

      <div class="form-group fullname">
        <label for="employees">Number of employees</label>
        <input type="text" id="employees" placeholder="Enter Number of employees">
      </div>

      <div class="form-group fullname">
        <label for="foundation">Year of foundation</label>
        <input type="date" id="foundation" placeholder="Enter your Year of foundation">
      </div>

      <div class="form-group fullname">
        <label for="turnover">(Latest) turnover</label>
        <input type="text" id="turnover" placeholder="Enter your turnover">
      </div>

      <div class="form-group fullname">
        <label for="Internal">Internal</label>
        <input type="text" id="internal" placeholder="Enter the internal">
      </div>



       
      <div class="form-group submit-btn">
        <input type="submit" value="Submit">
      </div>
    </form>
    <script src="https://unpkg.com/neo4j-driver"></script>

    <script >// Selecting form and input elements
   // Selecting form and input elements
   const form = document.querySelector("form");
   // Retrieving input elements
   const nameInput = document.getElementById("Name");
   const countryInput = document.getElementById("country");
     const cityInput = document.getElementById("city");
   const typeInput = document.getElementById("Type");
   const industryInput = document.getElementById("Industry");
   const toolsInput = document.getElementById("tools");
   const productsInput = document.getElementById("products");
   const employeesInput = document.getElementById("employees");
   const foundationInput = document.getElementById("foundation");
   const turnoverInput = document.getElementById("turnover");
   const internalInput = document.getElementById("internal");

   // Function to display error messages
   const showError = (field, errorText) => {
     field.classList.add("error");
     const errorElement = document.createElement("small");
     errorElement.classList.add("error-text");
     errorElement.innerText = errorText;
     field.closest(".form-group").appendChild(errorElement);
   }
 // Function to show pop-up notification
 const showNotification = () => {
  const notification = document.getElementById("notification");
  notification.classList.add("show");
  setTimeout(() => {
    notification.classList.remove("show");
  }, 5000); // 5000 milliseconds = 5 seconds
};

   // Connect to the Neo4j database
  const driver = neo4j.driver("neo4j+s://d23e285f.databases.neo4j.io", neo4j.auth.basic("neo4j", "i8-YwK-zrafll8WVYGCO-3flZYjq5yjTvxEOAuzFrIk"));
   const session = driver.session();

   // Function to handle form submission
   const handleFormData = (e) => {
     e.preventDefault();

     // Getting trimmed values from input fields
     const name = nameInput.value.trim();
     const country = countryInput.value.trim();
     const city = cityInput.value.trim();
     const type = typeInput.value.trim();
     const industry = industryInput.value.trim();
     const tools = toolsInput.value.trim();
     const products = productsInput.value.trim();
     const employees = employeesInput.value.trim();
     const foundation = foundationInput.value;
     const turnover = turnoverInput.value.trim();
     const internal = internalInput.value.trim();

     // Clearing previous error messages
     document.querySelectorAll(".form-group .error").forEach(field => field.classList.remove("error"));
     document.querySelectorAll(".error-text").forEach(errorText => errorText.remove());
function isNumeric(value) {
  return /^-?(\d{1,3}(,\d{3})*|\d+)(\.\d+)?$/.test(value);
}

     // Performing validation checks
     if (name === "") {
       showError(nameInput, "Enter the name of the company or organization");
     }
     if (country === "") {
       showError(countryInput, "Enter the country");
     }
      if (city === "") {
       showError(cityInput, "Enter the city");
     }
     if (type === "") {
       showError(typeInput, "Select the type");
     }
     if (industry === "") {
       showError(industryInput, "Enter the industry");
     }
     if (tools === "") {
       showError(toolsInput, "Enter the main tools used");
     }
     if (products === "") {
       showError(productsInput, "Enter the main products offered or traded");
     }
     if (employees === "") {
       showError(employeesInput, "Enter the number of employees");
     } else if (!isNumeric(employees)) {
  showError(employeesInput, "Turnover must be a valid number Exemple : 100");
}
     if (foundation === "") {
       showError(foundationInput, "Select the year of foundation");
     }
   if (turnover === "") {
  showError(turnoverInput, "Enter the latest turnover");
} else if (!isNumeric(turnover)) {
  showError(turnoverInput, "Turnover must be a valid number Exemple : 100.000");
}
        if (internal === "") {
       showError(internalInput, "Enter the internal");
     }
     // Checking for any remaining errors before form submission
     const errorInputs = document.querySelectorAll(".form-group .error");
     if (errorInputs.length > 0) return;
     
const location = country + ", " + city;

     // Submit form data to Neo4j
 session
  .run("CREATE (user:JuridicalPerson {  id: apoc.create.uuid(), name: $name, location: $location, type: $type, industry: $industry, tools: $tools, products: $products, employees: $employees, foundation: $foundation, turnover: $turnover, internal : $internal })",
    { name, location, type, industry, tools, products, employees, foundation, turnover, internal})
  .then(() => {
    // Show notification and reset the form after submission
    showNotification();
    form.reset();
  // Get the person's name and the logged in action
    const personName = name; // Assuming `name` is the person's name from the form
  const loggedInAction = `Added a Juridical Person named "${personName}"`;
    // Send an AJAX request to insert history using PHP
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "insert_history.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response if needed
      }
    };
    xhr.send(`loggedInAction=${encodeURIComponent(loggedInAction)}`);
  })
  .catch(error => {
    console.error("Error creating user:", error);
  });


   }
// Function to populate 'tools' select 
const populatetools = () => {
  session
    .run("MATCH (jp:JuridicalPerson) RETURN jp.tools AS tools")
    .then(result => {
      const selecttools = document.getElementById("Selecttools");
      const addedTools = new Set(); // To store added tools

      result.records.forEach(record => {
        const toolsString = record.get("tools");
        if (toolsString) {
          const toolsArray = toolsString.split(",").map(tool => tool.trim());
          toolsArray.forEach(tool => {
            if (!addedTools.has(tool)) {
              addedTools.add(tool); // Add to set to prevent duplicates
              const option = document.createElement("option");
              option.value = tool;
              option.textContent = tool;
              selecttools.appendChild(option);
            }
          });
        }
      });

      // Add event listener to select element
      selecttools.addEventListener("change", function () {
        const selectedTool = this.value;
        const toolsInput = document.getElementById("tools");

        if (selectedTool) {
          if (toolsInput.value) {
            toolsInput.value += ", " + selectedTool;
          } else {
            toolsInput.value = selectedTool;
          }
        }

        // Reset select element to default option
        this.selectedIndex = 0;
      });
    })
    .catch(error => {
      console.error("Error fetching JuridicalPersons:", error);
    });
};

// Populate 'tools' select on page load
document.addEventListener("DOMContentLoaded", populatetools);

   // Handling form submission event
   form.addEventListener("submit", handleFormData);
      </script>
  </body>
</html>