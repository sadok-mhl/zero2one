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
  max-width: 1000px; /* Adjust the max-width as needed */
  width: 100%;
  border-radius: 7px;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
  display: grid;
  grid-template-columns: 1fr 1fr; /* Split into 2 equal columns */
  grid-gap: 20px; /* Gap between columns and rows */
  justify-items: center; /* Center items horizontally */
  align-items: center; /* Center items vertically */
  position: absolute;
  margin-top: 550px;
  left: 50%;
  transform: translate(-50%, -50%);
}
form h3 {
   text-align: center; /* Center the text horizontally */
  font-size: 25px;
  margin: 0;
}
 /* Style for form groups */
.form-group {
  width: 100%;
}

   /* Style for labels */
form label {
  display: block;
  font-size: 14px;
  margin-bottom: 7px;
  text-align: left; /* Align labels to the left */
}

/* Style for inputs and selects */
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
  grid-column: span 2; /* Span the button across both columns */
  display: flex;
  justify-content: center; /* Center horizontally */
  margin-top: 30px;
}

    .back-button {
      position: absolute;
      top: 20px;
      left: 30px;
      font-size: 20px;
      color: white;
      cursor: pointer;
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
    position: static; /* Reset position for small screens */
    margin-top: 20px; /* Adjust top margin as needed */
    transform: none; /* Reset transform for small screens */
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
    Natural Person created successfully!
  </div>
  <form id="userForm">
    <h3>Natural Person</h3>
    <div class="form-group fullname">
      <input disabled type="text" id="Natural" value="Natural" placeholder="Enter the name of the company" hidden>
    </div>

    <div class="form-group fullname">
      <label for="Fullname">Fullname</label>
      <input type="text" id="Fullname" placeholder="Enter your Fullname">
    </div>
    
     <div class="form-group fullname">
      <label for="Business title">Buisness title</label>
      <input type="text" id="Business title" placeholder="Enter your Business title">
    </div>

    <div class="form-group fullname">
      <label for="Birthday">Birthday</label>
      <input type="date" id="Birthday" placeholder="Enter your Birthday">
    </div>

    <div class="form-group fullname">
      <label for="Gender">Gender</label>
      <select id="Gender">
        <option value="" selected disabled>Select your gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Non-binary">Non-binary </option>
        <option value="n/a">n/a</option>
      </select>
    </div>

    <div class="form-group fullname">
      <label for="Status">Status of person</label>
      <select id="Status">
        <option value="" selected disabled>Select your Status</option>
        <option value="active">active</option>
        <option value="not active">not active</option>
        <option value="n/a">n/a</option>
      </select>
    </div>

    <div class="form-group fullname">
      <label for="competencies">Main demonstrable competencies</label>
       <select id="Selectcompetencies">
        <option value="" selected disabled>Select the competencies</option>
        <!-- Options will be dynamically added here using JavaScript -->
      </select>
      <input type="text" id="competencies" placeholder="Enter Main competencies">
    </div>

    <div class="form-group fullname">
      <label for="tools">Main tools used</label>
      <input type="text" id="tools" placeholder="Enter Main tools">
    </div>

    <div class="form-group fullname">
      <label for="Location">Work Location</label>
      <input type="text" id="Location" placeholder="Enter the address">
    </div>

    <div class="form-group fullname">
      <label for="foundation">Hobbies / Interests</label>
       <select id="SelectHobbies">
        <option value="" selected disabled>Select the Hobbies</option>
        <!-- Options will be dynamically added here using JavaScript -->
      </select>
      <input type="text" id="Hobbies" placeholder="Enter your Hobbies">
    </div>

    <div class="form-group fullname">
      <label for="turnover">Main accomplishments</label>
      <input type="text" id="accomplishments" placeholder="Enter your accomplishments">
    </div>

    <div class="form-group fullname">
      <label for="Worked">Worked for</label>
      <select id="Worked">
        <option value="" selected disabled>Select the organization you worked for</option>
        <!-- Options will be dynamically added here using JavaScript -->
      </select>
    </div>

    <div class="form-group fullname">
      <label for="turnover">Shareholder of</label>
    <select id="Shareholder">
        <option value="" selected disabled>Shareholdder of</option>
        <!-- Options will be dynamically added here using JavaScript -->
      </select>    </div>

    <div class="form-group fullname">
      <label for="turnover">Regular attended Professional Events</label>
      <input type="text" id="Events" placeholder="Enter your Events">
    </div>

    <div class="form-group fullname">
      <label for="turnover">Professional Topics</label>
      <input type="text" id="Topics" placeholder="Enter your Topics">
    </div>

    <div class="form-group fullname">
        <label for="Internal">Internal</label>
        <input type="text" id="internal" placeholder="Enter the internal">
      </div>
    <div class="form-group submit-btn">
      <input type="submit" value="Submit">
    </div>
  </form>
  <script src="https://unpkg.com/neo4j-driver@4.3.0"></script>

  <script>
    // Selecting form and input elements
    const form = document.querySelector("form");
    const fullnameInput = document.getElementById("Fullname");
    const TitleInput = document.getElementById("Business title");
    const birthdayInput = document.getElementById("Birthday");
    const genderInput = document.getElementById("Gender");
    const statusInput = document.getElementById("Status");
    const competenciesInput = document.getElementById("competencies");
    const toolsInput = document.getElementById("tools");
    const locationInput = document.getElementById("Location");
    const hobbiesInput = document.getElementById("Hobbies");
    const accomplishmentsInput = document.getElementById("accomplishments");
    const workedForSelect = document.getElementById("Worked");
    const shareholderInput = document.getElementById("Shareholder");
    const eventsInput = document.getElementById("Events");
    const topicsInput = document.getElementById("Topics");
   const internalInput = document.getElementById("internal");

    // Function to display error messages
    const showError = (field, errorText) => {
      field.classList.add("error");
      const errorElement = document.createElement("small");
      errorElement.classList.add("error-text");
      errorElement.innerText = errorText;
      field.closest(".form-group").appendChild(errorElement);
    };

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
      const fullname = fullnameInput.value.trim();
      const title = TitleInput.value.trim();
      const birthday = birthdayInput.value.trim();
      const gender = genderInput.value;
      const status = statusInput.value;
      const competencies = competenciesInput.value.trim();
      const tools = toolsInput.value.trim();
      const location = locationInput.value.trim();
      const hobbies = hobbiesInput.value.trim();
      const accomplishments = accomplishmentsInput.value.trim();
      const workedFor = workedForSelect.value.trim();
      const shareholder = shareholderInput.value.trim();
      const events = eventsInput.value.trim();
      const topics = topicsInput.value.trim();
     const internal = internalInput.value.trim();

      // Clearing previous error messages
      document.querySelectorAll(".form-group .error").forEach((field) => field.classList.remove("error"));
      document.querySelectorAll(".error-text").forEach((errorText) => errorText.remove());

      // Performing validation checks
      if (fullname === "") {
        showError(fullnameInput, "Enter your full name");
      }
         if (title === "") {
        showError(TitleInput, "Enter your Business title");
      }
      if (birthday === "") {
        showError(birthdayInput, "Enter your birthday");
      }
      if (gender === "") {
        showError(genderInput, "Select your gender");
      }
      if (status === "") {
        showError(statusInput, "Select your status");
      }
      if (competencies === "") {
        showError(competenciesInput, "Enter your main competencies");
      }
      if (tools === "") {
        showError(toolsInput, "Enter the main tools used");
      }
      if (location === "") {
        showError(locationInput, "Enter the work location");
      }
      if (hobbies === "") {
        showError(hobbiesInput, "Enter your hobbies/interests");
      }
      if (accomplishments === "") {
        showError(accomplishmentsInput, "Enter your main accomplishments");
      }
      if (workedFor === "") {
        showError(workedForSelect, "Select the organization you worked for");
      }
      if (shareholder === "") {
        showError(shareholderInput, "Enter the organization you are a shareholder of");
      }
      if (events === "") {
        showError(eventsInput, "Enter the professional events you regularly attend");
      }
      if (topics === "") {
        showError(topicsInput, "Enter the professional topics");
      }
 if (internal === "") {
       showError(internalInput, "Enter the internal");
     }
      // Checking for any remaining errors before form submission
      const errorInputs = document.querySelectorAll(".form-group .error");
      if (errorInputs.length > 0) return;

      // Submit form data to Neo4j
      session
      .run(
    "MATCH (user:NaturalPerson { name: $name, workedFor: $workedFor }) RETURN user",
    { name: fullname, workedFor: workedFor }
  )
  .then((result) => {
    if (result.records.length > 0) {
      // If the NaturalPerson already exists, show the error message
      showError(fullnameInput, "NaturalPerson with the same fullname and company already in database");
    } else {
          // If the NaturalPerson doesn't exist, create the node
     session
  .run(
    "CREATE (user:NaturalPerson { id: apoc.create.uuid(), name: $name, title: $title, birthday: $birthday, gender: $gender, status: $status, competencies: $competencies, tools: $tools, location: $location, hobbies: $hobbies, accomplishments: $accomplishments, workedFor: $workedFor, shareholder: $shareholder, events: $events, topics: $topics, internal: $internal })",
    { name: fullname, title, birthday, gender, status, competencies, tools, location, hobbies, accomplishments, workedFor, shareholder, events, topics, internal }
  )
  .then(() => {
    showNotification();
    // Reset the form after successful submission
    form.reset();
           // Get the person's name and the logged in action
              const personName = fullname; // Assuming `name` is the person's name from the form
              const loggedInAction = `Added a Natural Person named "${personName}"`;

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
      })
      .catch((error) => {
        console.error("Error checking if NaturalPerson exists:", error);
      });
    };
  // Function to populate 'workedFor' select with JuridicalPerson node names
    const populateJuridicalPersons = () => {
      session
        .run("MATCH (jp:JuridicalPerson) RETURN jp.name AS name")
        .then(result => {
          const workedForSelect = document.getElementById("Worked");
 
          result.records.forEach(record => {
            const option = document.createElement("option");
            option.value = record.get("name");
            option.textContent = record.get("name");
            workedForSelect.appendChild(option);
 
          });
        })
        .catch(error => {
          console.error("Error fetching JuridicalPersons:", error);
        });
    };

    // Populate 'workedFor' select on page load
    populateJuridicalPersons();


  // Function to populate 'Shareholde' select with JuridicalPerson node names
    const populateShareholde = () => {
          const session = driver.session(); // Create a new session for this operation

      session
        .run("MATCH (jp:JuridicalPerson) RETURN jp.name AS name")
        .then(result => {
           const ShareholderSelect = document.getElementById("Shareholder");

          result.records.forEach(record => {
            const option = document.createElement("option");
            option.value = record.get("name");
            option.textContent = record.get("name");
             ShareholderSelect.appendChild(option);

          });
        })
        .catch(error => {
          console.error("Error fetching JuridicalPersons:", error);
        });
    };

    // Populate 'Shareholde' select on page load
    populateShareholde();
    
    
  // Function to populate 'competencies' select 
const populateCompetencies = () => {
  const session = driver.session(); // Create a new session for this operation

  session
    .run("MATCH (jp:NaturalPerson) RETURN jp.competencies AS competencies")
    .then(result => {
      const selectCompetencies = document.getElementById("Selectcompetencies");
      const addedCompetencies = new Set(); // To store added competencies

      result.records.forEach(record => {
        const competenciesString = record.get("competencies");
 
        if (competenciesString) {
          const competenciesArray = competenciesString.split(",").map(competency => competency.trim());
 
          competenciesArray.forEach(competency => {
            if (!addedCompetencies.has(competency)) {
              addedCompetencies.add(competency); // Add to set to prevent duplicates
              const option = document.createElement("option");
              option.value = competency;
              option.textContent = competency;
              selectCompetencies.appendChild(option);
            }
          });
        }
      });

      // Add event listener to competencies select element
      selectCompetencies.addEventListener("change", function () {
        const selectedCompetency = this.value;
        const competenciesInput = document.getElementById("competencies");

        if (selectedCompetency) {
          if (competenciesInput.value) {
            competenciesInput.value += ", " + selectedCompetency;
          } else {
            competenciesInput.value = selectedCompetency;
          }
        }

        // Reset competencies select element to default option
        this.selectedIndex = 0;
      });
    })
    .catch(error => {
      console.error("Error fetching JuridicalPersons:", error);
    });
};

// Populate 'competencies' select on page load
document.addEventListener("DOMContentLoaded", populateCompetencies);


// Function to populate 'Hobbies' select 
const populateHobbies = () => {
  const session = driver.session(); // Create a new session for this operation

  session
    .run("MATCH (jp:NaturalPerson) RETURN jp.hobbies AS hobbies")
    .then(result => {
      const selectHobbies = document.getElementById("SelectHobbies");
      const addedHobbies = new Set(); // To store added hobbies

      result.records.forEach(record => {
        const hobbiesString = record.get("hobbies");
        if (hobbiesString) {
          const hobbiesArray = hobbiesString.split(",").map(hobby => hobby.trim());
          hobbiesArray.forEach(hobby => {
            if (!addedHobbies.has(hobby)) {
              addedHobbies.add(hobby); // Add to set to prevent duplicates
              const option = document.createElement("option");
              option.value = hobby;
              option.textContent = hobby;
              selectHobbies.appendChild(option);
            }
          });
        }
      });

      // Add event listener to hobbies select element
      selectHobbies.addEventListener("change", function () {
        const selectedHobby = this.value;
        const hobbiesInput = document.getElementById("Hobbies");

        if (selectedHobby) {
          if (hobbiesInput.value) {
            hobbiesInput.value += ", " + selectedHobby;
          } else {
            hobbiesInput.value = selectedHobby;
          }
        }

        // Reset hobbies select element to default option
        this.selectedIndex = 0;
      });
    })
    .catch(error => {
      console.error("Error fetching JuridicalPersons:", error);
    })
    .finally(() => {
      session.close(); // Close the session when the operation is done
    });
};

// Populate 'Hobbies' select on page load
document.addEventListener("DOMContentLoaded", populateHobbies);

    // Handling form submission event
    form.addEventListener("submit", handleFormData);
  </script>
</body>

</html>
