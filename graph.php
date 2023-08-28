<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
 
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <title>Graph</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    #cy {
      width: 100%;
      height: 90%;
      display: block;
      background-color: #ffffff;
      float: left;
      border-radius: 15px;

    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin: 0 auto;
      /* Center the table */

    }

    th,
    td {
      border: 2px solid #ddd;
      padding: 18px;
      text-align: center;
      /* Center the content horizontally within cells */

    }

    th {
      background-color: #f2f2f200;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #e4e4e4;
     }

    h2 {
      text-align: center;
      padding: 30px;
    }

    .tables-container {
      background-color: #f0f0f0;
      /* Light gray background */
      border-radius: 5px;
      margin-top: 150px;
      padding: 50px;
      /* Add 50px padding on all sides */
      max-width: 95%;
      /* Set the maximum width to 80% of its container */
      margin-left: auto;
      margin-right: auto;
    }

    .graph-container {
      border-radius: 15px;

      position: relative;
      height: 100%;
      border-radius: 12px;
      background-color: #f5f5f5;
      margin-left: 5vh;
      /* Adjust the value as needed to move it to the right */
      margin-top: 40px;
    }


    .zoom-buttons {
      position: absolute;
      bottom: 10px;
      right: 10px;
    }

    .zoom-button {
      width: 30px;
      height: 30px;
      border: none;
      background-color: #ccc;
      color: #000;
      font-size: 18px;
      border-radius: 50%;
      cursor: pointer;
      margin-left: 5px;
    }

    .zoom-button:hover {
      background-color: rgb(138, 150, 183);
    }
.search-container {
  display: flex;
  align-items: center;
}

.form-control,.form-select {
  width: 30vh; /* Adjust this value to your desired width */
}


    .search-container label {
      margin-right: 10px;
    }

    .col-lg-9 {
      padding-left: 0;
      /* Add this line */
      padding-right: 0;
      /* Add this line */
    }

    .info-container {
      height: 100%;
      color: rgb(0, 0, 0);
      margin-top: 40px;  
 
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      overflow-y: auto;
      width: 100%;
      max-width: 91%;
      /* Adjust padding for smaller screens */
      padding: 10px;
      /* Set the width to 100% to make it responsive */
      overflow-y: auto;
    }

    .info-container h4 {
      font-size: 20px;
      margin-bottom: 15px;

    }

    .info-container table {
      width: 100%;
            height :90%; 

      font-size: 14px;
      border-collapse: collapse;
    }

    .info-container th,
    .info-container td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #fff;
      /* Add a bottom border to separate rows */
    }

    .info-container th {
      background-color: #9c9c9c;
      /* Header background color */
      color: #fff;
    }

    .info-container tr:nth-child(even) {
      background-color: #e4e4e4;
      /* Alternate row background color */
    }

    .info-container tr:hover {
      background-color: #5f7092;
      /* Hover row background color */
    }

     /* Date range container */
     .date-range-container {
      display: flex;
      align-items: center;
    }

    /* Date range labels */
    .date-label {
      margin-right: 5px;
    }

    /* Date range inputs */
    .date-input {
      margin-right: 10px;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    .text-center {
   margin-top: 20px; /* Adjust as needed */
}

    #apply-filter {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 8px 15px;
      cursor: pointer;
      border-radius: 4px;
    }

    #apply-filter:hover {
      background-color: #45a049;
    }
    .back-button {
      position: absolute;
      top: 20px;
      left: 30px;
      font-size: 20px;
      color: white;
      cursor: pointer;
    }


    /* Style the input fields inside the info container */
    .info-container table input[type="text"] {
      width: 100%;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    /* Style the th and td elements inside the info container */
    .info-container table th,
    .info-container table td {
      padding: 10px;
    }

    /* Style the Save button */
    #save-button {
      display: none;
      margin-top: 10px;
      padding: 8px 20px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      background-color: #28a745;
      /* Green color */
      color: #fff;
      cursor: pointer;
    }

    /* Style the Edit button */
    #edit-button {
      margin-top: 10px;
      padding: 8px 20px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      /* Blue color */
      color: #fff;
      cursor: pointer;
    }

    /* Style the Edit and Save buttons on hover */
    #edit-button:hover,
    #save-button:hover {
      opacity: 0.8;
    }
    .custom-button {
  display: inline-block;
  padding: 18px 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #ffffff;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.custom-button:hover {
  background-color: #0056b3;
  color: #fff;
}
/* Bar styles */
.bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 20px;
  background-color: #333; /* For visibility in this example */
  color: #fff;
}

 

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  right: 100%; /* Move the dropdown to the left of the user icon */
  top: 100%; /* Position it below the user icon */
}

.user-circle i {
  cursor: pointer;
color: #333; /* For visibility in this example */

   margin-left : 20%;

}

#user-circle {
  position: relative;
  margin-left : 97%;
    background-color: white;
    border-radius : 50%;
    width : 25px;

}

#sign-out, #dashboard {
  width: 100%;
  padding: 20px 60px;
  border: none;
  background-color: transparent;
  cursor: pointer;
}

#sign-out:hover, #dashboard:hover {
  background-color: #f1f1f1;
}


  </style>
</head>

<body>
<div class="bar">
  <div class="user-circle" id="user-circle">
    <div class="dropdown-content" id="dropdown-content">
      <button id="sign-out">Sign Out</button>
 
  <?php
    if ($_SESSION['role'] === 'admin') {

      echo ' <button id="dashboard">Dashboard</button>';
  }
 else {
           echo ' <button id="dashboard"></button>';

 }
    ?>
    </div>
    <i class="fas fa-user"></i>
  </div>
</div>
    <a href="Home.php" class="back-button"><i class="fas fa-chevron-left"></i></a>





  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-md-12">
        <div class="graph-container">
          <div class="search-container">
            <input type="text" id="search" placeholder="Search by Name" class="form-control">
            <select id="relationship" class="form-select">
              <option value="">All Relationships</option>
              <option value="Worked_for">Worked_for</option>
              <option value="Co_Workers">Co-Workers</option>
              <option value="Uses">Uses</option>
              <option value="pursued">Hobby</option>
              <option value="participated_in">Participation</option>
              <option value="developed">Products</option>
              <option value="worked_on">Projects</option>
              <option value="Shareholded_by">Shareholder</option>


            </select>
          </div>
          <div id="cy"></div>
          <div class="zoom-buttons">
            <button id="zoom-in-button" class="zoom-button">+</button>
            <button id="zoom-out-button" class="zoom-button">-</button>
          </div>
        </div>
      </div>
<div class="col-lg-3">
  <div id="info" class="info-container">
    <h3 style="color: rgb(44, 44, 44)">Click on a node for details</h3>
  </div>

  <div class="d-flex flex-column mb-2" style="margin-left: 13vh;">
    <button id="delete-button" class="btn btn-danger" style="width: 20vh;">Delete</button>
    <button id="edit-button" class="btn btn-primary" style="width: 20vh;">Edit</button>
    <button id="save-button" class="btn btn-success" style="width: 20vh; display: none;">Save</button>
  </div>
</div>


      <div class="tables-container">
        <div>

          <h2 style="color:rgb(53, 50, 50)">Juridical Persons</h2>
          <div class="table-responsive">
             <!-- Add the select drop-down filter for sorting -->
            <div class="search-container">
              <input type="text" id="search-juridical" placeholder="Search Juridical Persons" class="form-control">
              <!-- Add the select drop-down filter for sorting -->
              <select id="juridical-sort-by" class="form-select">
                <option value="default">Sort by</option>
                <option value="turnover-asc">Turnover (Ascending)</option>
                <option value="turnover-desc">Turnover (Descending)</option>
                <option value="employees-asc">Employees (Ascending)</option>
                <option value="employees-desc">Employees (Descending)</option>
              </select>
      
       
            </div>
            <table class="table table-bordered table-hover" id="juridical-table">

              <tbody id="juridical-table-body">
               </tbody>
            </table>
          </div>
        </div>

        <div>
          <h2 style="color:rgb(53, 50, 50)">Natural Persons</h2>
         <div class=" table-responsive">
            <table class="table table-bordered table-hover" id="natural-table">
              <div class="search-container">

              <input type="text" id="search-natural" placeholder="Search Natural Persons" class="form-control">
 
        
            </div>
              <tbody id="natural-table-body">
               </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>



      
  <script src="https://unpkg.com/neo4j-driver"></script>
  <script src="https://unpkg.com/cytoscape"></script>
    <script src="https://unpkg.com/cytoscape/dist/cytoscape.min.js"></script>
      <script src="https://unpkg.com/layout-base/layout-base.js"></script>
      <script src="https://unpkg.com/cose-base/cose-base.js"></script>
      <script src="https://unpkg.com/cytoscape-layout-utilities/cytoscape-layout-utilities.js"></script>
 
  <script>
document.getElementById("user-circle").addEventListener("click", function() {
  var dropdown = document.getElementById("dropdown-content");
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
});

document.getElementById("sign-out").addEventListener("click", function() {
  window.location.href = "logout.php"; // Redirect to logout.php
});


document.getElementById("dashboard").addEventListener("click", function() {
  window.location.href = "Dashboard.php"; // Redirect to logout.php
});


   fetch('api.php', {
    method: 'GET',
})
.then(response => response.json())
.then(driverConfig => {
    // Initialize your Neo4j driver using the fetched configuration
    const driver = neo4j.driver(
        driverConfig.uri,
        neo4j.auth.basic(driverConfig.username, driverConfig.password)
    );
    
    // The rest of your existing code...
    const session = driver.session();
     // Function to populate a table with data from Neo4j
    async function populateTable(neo4jQuery, tableBodyId, tableHeader) {
      const session = driver.session();
      try {
        const result = await session.run(neo4jQuery);
        const records = result.records;

        const tableBody = document.getElementById(tableBodyId);
        tableBody.innerHTML = ""; // Clear previous table contents

        // Add the table header row
        const headerRow = document.createElement("tr");
        tableHeader.forEach(headerText => {
          const headerCell = document.createElement("th");
          headerCell.textContent = headerText;
          headerRow.appendChild(headerCell);
        });
        tableBody.appendChild(headerRow);

        // Add the table data rows
        records.forEach(record => {
          const row = document.createElement("tr");
          record.forEach(value => {
            const cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
          });
          tableBody.appendChild(row);
        });
      } catch (error) {
        console.error("Error fetching data from Neo4j:", error);
      } finally {
        session.close();
      }
    }

    const neo4jQueryJuridical = `
    MATCH (jp:JuridicalPerson)
    RETURN jp.name, jp.location, jp.industry, jp.foundation, jp.employees, jp.tools, jp.turnover, jp.products, jp.internal
  `;

    const juridicalHeader = ["Name", "Location", "Industry", "Foundation", "Employees", "Tools", "Turnover", "Products" ,"Internal"];

    const neo4jQueryNatural = `
    MATCH (np:NaturalPerson)
    RETURN  np.name, np.title , np.birthday, np.gender, np.topics, np.shareholder, np.competencies, np.tools, np.hobbies, np.workedFor, np.accomplishments, np.location, np.events, np.status, np.internal
  `;

  const naturalHeader = [ "Name","Business Title", "Birthday", "Gender", "Topics", "Shareholder", "Competencies", "Tools", "Hobbies", "Worked For", "Accomplishments", "Location", "Events", "Status" ,"Internal"];

    // Populating both tables at the same time using Promise.all
    Promise.all([
      populateTable(neo4jQueryJuridical, "juridical-table-body", juridicalHeader),
      populateTable(neo4jQueryNatural, "natural-table-body", naturalHeader)
    ]).then(() => {
      // Both tables have been populated
      console.log("Both tables populated successfully.");
    });

    // Function to filter the table rows based on the search input
    function filterTable(tableId, searchInputId) {
      const table = document.getElementById(tableId);
      const filter = searchInputId.value.toLowerCase();
      const rows = table.rows; // Get all rows, including the header row

      for (let i = 1; i < rows.length; i++) { // Start from i = 1 to skip the header row
        const row = rows[i];
        const cells = row.getElementsByTagName("td");
        let found = false;

        for (let j = 0; j < cells.length; j++) {
          const cell = cells[j];
          if (cell) {
            const textValue = cell.textContent || cell.innerText;
            if (textValue.toLowerCase().indexOf(filter) > -1) {
              found = true;
              break;
            }
          }
        }

        row.style.display = found ? "" : "none";
      }
    }

    // Attach event listeners for the search inputs in each table
    const searchInputJuridical = document.getElementById("search-juridical");
    searchInputJuridical.addEventListener("input", () => {
      filterTable("juridical-table", searchInputJuridical);
    });

    const searchInputNatural = document.getElementById("search-natural");
    searchInputNatural.addEventListener("input", () => {
      filterTable("natural-table", searchInputNatural);
    });
  // Function to check if a node with the same id already exists in the nodes array
  function findNodeById(nodes, id) {
    return nodes.find(node => node.data.id === id);
  }

  // Retrieve user data from Neo4j and visualize the graph using Cytoscape.js
  session
    .run(
      `MATCH (user)
      RETURN user`
    )
    .then(result => {
      const nodes = [];

      result.records.forEach(record => {
        const user = record.get("user").properties;
        const label = record.get("user").labels[0];
        let type = "user";

        if (label === "JuridicalPerson") {
          type = "juridicalPerson";
        } else if (label === "NaturalPerson") {
          type = "naturalPerson";
        }

        const userNode = { data: { id: user.id, label: user.name, type, ...user } };

        // Check if a node with the same id already exists in the nodes array
        const existingNode = findNodeById(nodes, user.name);
        if (existingNode) {
          // Update the existing node with new data
          Object.assign(existingNode.data, userNode.data);
        } else {
          nodes.push(userNode); // Add the node to the array
        }

        const tools = user.tools ? user.tools.split(",") : [];
        tools.forEach(tool => {
          const toolId = `tool-${tool}`;
          const toolNode = { data: { id: toolId, label: tool, type: "tool" } };

          // Check if a node with the same id already exists in the nodes array
          const existingToolNode = findNodeById(nodes, toolId);
          if (!existingToolNode) {
            nodes.push(toolNode); // Add the tool node to the array
          }
        });

        const hobbies = user.hobbies ? user.hobbies.split(",") : [];
        hobbies.forEach(hobby => {
          const hobbyId = `hobby-${hobby}`;
          const hobbyNode = { data: { id: hobbyId, label: hobby, type: "hobby" } };

          // Check if a node with the same id already exists in the nodes array
          const existingHobbyNode = findNodeById(nodes, hobbyId);
          if (!existingHobbyNode) {
            nodes.push(hobbyNode); // Add the hobby node to the array
          }
        });
        
         const products = user.products ? user.products.split(",") : [];
        products.forEach(product => {
          const productId = `product-${product}`;
          const productNode = { data: { id: productId, label: product, type: "product" } };

          // Check if a node with the same id already exists in the nodes array
          const existingproductNode = findNodeById(nodes, productId);
          if (!existingproductNode) {
            nodes.push(productNode); // Add the product Node to the array
          }
        });
        
            const events = user.events ? user.events.split(",") : [];
        events.forEach(event => {
          const eventId = `event-${event}`;
          const eventNode = { data: { id: eventId, label: event, type: "event" } };

          // Check if a node with the same id already exists in the nodes array
          const existingeventNode = findNodeById(nodes, eventId);
          if (!existingeventNode) {
            nodes.push(eventNode); // Add the product Node to the array
          }
        });
      });

        // Visualize the graph using Cytoscape.js
        const cy = cytoscape({
          container: document.getElementById("cy"),
            wheelSensitivity: 0.05, // Set the wheel sensitivity to 0 to disable zooming

          elements: nodes,
          style: [
            {
              selector: "node",
              style: {
                "background-color": "#ff8080",
                "border-color": "#ff8080",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "14px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "30px"
              }
            }, {
              selector: "node[type='tool']",
              style: {
                "background-color": "#8DB895",
                "border-color": "#f5f5f5",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "12px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "20px"
              }
            },
            {
              selector: "node[type='hobby']",
              style: {
                "background-color": "#B88DB0",
                "border-color": "#f5f5f5",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "12px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "20px"
              }
            },
             {
              selector: "node[type='product']",
              style: {
                "background-color": "#F79FEB",
                "border-color": "#f5f5f5",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "12px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "20px"
              }
            },
             {
              selector: "node[type='event']",
              style: {
                "background-color": "#F3D474",
                "border-color": "#f5f5f5",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "12px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "20px"
              }
            },
             {
              selector: "node[type='shareholder']",
              style: {
                "background-color": "#00FF36",
                "border-color": "#f5f5f5",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "12px",
                "label": "data(label)",
                "text-valign": "center",
                "text-halign": "center",
                "text-wrap": "wrap",
                "text-max-width": "80px",
                "padding": "20px"
              }
            },
            {
              selector: "node[type='juridicalPerson']",
              style: {
                "width": "60px",
                "height": "60px",
                "background-color": "#80c0ff",
                "border-color": "#80c0ff",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "14px",
                "label": "data(label)"
              }
            },
            {
              selector: "node[type='naturalPerson']",
              style: {
                "width": "60px",
                "height": "60px",
                "background-color": "#80c0ff",
                "border-color": "#80c0ff",
                "border-width": "2px",
                "border-opacity": "1",
                "font-size": "14px",
                "label": "data(label)"
              }
            },
            {
              selector: "edge",
              style: {
                "curve-style": "bezier",
                "target-arrow-shape": "triangle",
                "line-color": "#ccc",
                "target-arrow-color": "#ccc",
                label: "data(label)",
                "font-size": "12px",
                "text-rotation": "autorotate",
                "text-margin-y": "-10px",
                "text-background-color": "#f5f5f5",
                "text-background-opacity": "0.8",
                "text-background-padding": "2px"
              }
            }
          ],

          //layout: {
          //  name: "grid",
          //   rows: 2
          //  }
       layout: {
  name: "concentric",
  concentric: (node) => node.degree(),
  levelWidth: (nodes) => 0.4,
  spacingFactor: 0.8, // Adjust the spacing between nodes (smaller value means smaller radii)
  padding: 10,
  animate: false,
},

        });


 
        // Handle the Edit button click event
        const editButton = document.getElementById("edit-button");
        const saveButton = document.getElementById("save-button");

        editButton.addEventListener("click", () => {
          const infoContainer = document.getElementById("info");
          const table = infoContainer.querySelector("table");
          if (!table) return;

          // Replace the table with input fields for editing
          const inputFields = Array.from(table.querySelectorAll("td")).map(td => {
            const key = td.previousElementSibling.textContent;
            const value = td.textContent;
            return `<tr><th>${key}</th><td><input type="text" value="${value}" data-key="${key}"></td></tr>`;
          });

          table.innerHTML = inputFields.join("");
          editButton.style.display = "none";
          saveButton.style.display = "block";
        });

        // Handle the Save button click event
        saveButton.addEventListener("click", async () => {
          const infoContainer = document.getElementById("info");
          const table = infoContainer.querySelector("table");
          if (!table) return;

          // Extract updated values from input fields
          const updatedData = {};
          const inputFields = table.querySelectorAll("input");
          inputFields.forEach(input => {
            const key = input.dataset.key;
            const value = input.value;
            updatedData[key] = value;
          });

          // Update Cytoscape node data
          const selectedNodes = cy.$(":selected");
          selectedNodes.forEach(selectedNode => {
            selectedNode.data({ ...selectedNode.data(), ...updatedData });
          });

          // Save changes to the database
          const nodeIds = selectedNodes.map(node => node.data("id"));
          const query = `
    UNWIND $nodes AS node
    MATCH (n { id: node.id })
    SET n += node
  `;

           try {
    // Update node data in the database
    await session.run(query, { nodes: selectedNodes.map(node => node.data()) });
    console.log("Node data updated in the database.");

    // Insert history entry
    const loggedInAction = `Modified a node`;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "insert_history.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response if needed
      }
    };
    xhr.send(`loggedInAction=${encodeURIComponent(loggedInAction)}`);
    
  } catch (error) {
    console.error("Error updating node data in the database:", error);
  }

          // Update the info container to display the updated data
          const updatedProps = Object.entries(updatedData)
            .map(([key, value]) => `
      <tr>
        <th>${key}</th>
        <td>${value}</td>
      </tr>
    `)
            .join("");

          infoContainer.innerHTML = `
    <h4>${selectedNodes.first().data("label")}</h4>
    <table>
      ${updatedProps}
    </table>
  `;

          // Hide the Save button and show the Edit button
          saveButton.style.display = "none";
          editButton.style.display = "block";
        });




        // Create edges between nodes that have the same non-empty workedFor value
        const workedForEdges = [];
        const relationshipEdges = [];

        const nodesWithWorkedFor = nodes.filter(node => node.data.workedFor);

        const nodesByWorkedFor = new Map();
        for (const node of nodesWithWorkedFor) {
          const workedFor = node.data.workedFor;
          if (!nodesByWorkedFor.has(workedFor)) {
            nodesByWorkedFor.set(workedFor, []);
          }
          nodesByWorkedFor.get(workedFor).push(node);
        }

        nodesByWorkedFor.forEach(nodes => {
          for (let i = 0; i < nodes.length - 1; i++) {
            for (let j = i + 1; j < nodes.length; j++) {
              const sourceId = nodes[i].data.id;
              const targetId = nodes[j].data.id;

              // Check if the workedFor values are equal
              if (nodes[i].data.workedFor === nodes[j].data.workedFor) {
                workedForEdges.push(
                  { data: { source: sourceId, target: targetId, label: "Co_Workers" } },
                  { data: { source: targetId, target: sourceId, label: "Co_Workers" } } // Add a two-way edge
                );
              }
            }
          }
        });

        cy.add(workedForEdges); // Add the workedFor edges to the graph

        // Create edges between NaturalPerson and JuridicalPerson nodes based on workedFor and name columns
        nodes.forEach(node => {
          if (node.data.type === "naturalPerson") {
            const workedFor = node.data.workedFor;
            const juridicalPersonNodes = nodes.filter(n => n.data.name === workedFor);
    
            for (const juridicalPersonNode of juridicalPersonNodes) {
              const sourceId = node.data.id;
              const targetId = juridicalPersonNode.data.id;
              relationshipEdges.push({ data: { source: sourceId, target: targetId, label: "Worked_for" } });
            }
          }
        });

        cy.add(relationshipEdges); // Add the relationship edges to the graph

        session
          .writeTransaction(tx => {
            const workedForRelationships = [];

            nodes.forEach(node => {
              if (node.data.type === "naturalPerson" && node.data.workedFor) {
                const sourceName = node.data.label;
                const targetName = node.data.workedFor;

                const query = `
          MATCH (source { name: $sourceName })
          MATCH (target { name: $targetName })
          MERGE (source)-[:Worked_for]->(target)
        `;

                workedForRelationships.push(tx.run(query, { sourceName, targetName }));
              }
            });

            return Promise.all(workedForRelationships);
          })
          .then(() => {
            console.log("Created 'Worked_for' relationships in the Neo4j database.");
          })
          .catch(error => {
            console.error("Error creating 'Worked_for' relationships:", error);
          });
          
          
/////////////////////////Relationships////////////////////////////////////
         
         
        // Create edges between NaturalPerson nodes and tool nodes
        nodes.forEach(node => {
          const tools = node.data.tools ? node.data.tools.split(",") : [];
          tools.forEach(tool => {
            const toolId = `tool-${tool}`;
            const edge = { data: { source: node.data.id, target: toolId, label: "Uses" } };
            cy.add(edge);
          });
        });

        // Create edges between NaturalPerson nodes and hobbies nodes
        nodes.forEach(node => {
          const hobbies = node.data.hobbies ? node.data.hobbies.split(",") : [];
          hobbies.forEach(hobby => {
            const hobbyId = `hobby-${hobby}`;
            const edge = { data: { source: node.data.id, target: hobbyId, label: "Pursued" } };
            cy.add(edge);
          });
        });

         // Create edges between NaturalPerson nodes and product nodes
        nodes.forEach(node => {
          const products = node.data.products ? node.data.products.split(",") : [];
          products.forEach(product => {
            const productId = `product-${product}`;
            const edge = { data: { source: node.data.id, target: productId, label: "Developed" } };
            cy.add(edge);
          });
        });

       // Create edges between NaturalPerson nodes and product nodes
        nodes.forEach(node => {
          const events = node.data.events ? node.data.events.split(",") : [];
          events.forEach(event => {
            const eventId = `event-${event}`;
            const edge = { data: { source: node.data.id, target: eventId, label: "participated_in" } };
            cy.add(edge);
          });
        });
        
      
/////////////////////////End Relationships////////////////////////////////////
        
        // Zoom buttons functionality
        const zoomInButton = document.getElementById("zoom-in-button");
        zoomInButton.addEventListener("click", () => {
          cy.zoom({
            level: cy.zoom() * 1.2,
            renderedPosition: { x: cy.width() / 2, y: cy.height() / 2 },
          });
        });

        cy.on("tap", "node", event => {
          const node = event.target;
          const label = node.data("label");
          const type = node.data("type");
          const props = Object.entries(node.data())
            .filter(([key]) => key !== "id" && key !== "label" && key !== "type")
            .map(([key, value]) => `
                <tr>
                  <th>${key}</th>
                  <td>${value}</td>
                </tr>
              `)
            .join("");

          // Display the information in the info container
          const infoContainer = document.getElementById("info");
          infoContainer.innerHTML = `
              <h4>${label}</h4>
              <table>
                ${props}
              </table>
            `;
        });

        const zoomOutButton = document.getElementById("zoom-out-button");
        zoomOutButton.addEventListener("click", () => {
          cy.zoom({
            level: cy.zoom() * 0.9,
            renderedPosition: { x: cy.width() / 2, y: cy.height() / 2 },
          });
        });
        //Delete node
        async function deleteSelectedNode() {
          const selectedNodes = cy.elements(":selected");
          if (selectedNodes.nonempty()) {
            const nodeId = selectedNodes.first().data("id");

            // Delete the nodes and their connected edges from the graph
            selectedNodes.remove();
            cy.elements(`[source='${nodeId}'], [target='${nodeId}']`).remove();

            // Delete the node and its relationships from the database
            try {
           const result = await session.run(
  `MATCH (node) WHERE node.id = $nodeId
   DETACH DELETE node`,
  { nodeId: nodeId } // Use "nodeId" without the "$" symbol
);

              console.log(`Node '${nodeId}' and its relationships deleted from the database.`);
                          // Insert history entry
                const loggedInAction = `Deleted a node`;
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "insert_history.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response if needed
                  }
                };
                xhr.send(`loggedInAction=${encodeURIComponent(loggedInAction)}`);
            } catch (error) {
              console.error("Error deleting node from the database:", error);
            }

            // Clear the info container when the node is deleted
            const infoContainer = document.getElementById("info");
            infoContainer.innerHTML = "";
          }
        }


        // Attach click event to the delete button
        const deleteButton = document.getElementById("delete-button");
        deleteButton.addEventListener("click", deleteSelectedNode);


        // Search filter by name and relationship
        const searchInput = document.getElementById("search");
        const relationshipInput = document.getElementById("relationship");

        // Apply filters when search or relationship value changes
        searchInput.addEventListener("input", applyFilters);
        relationshipInput.addEventListener("change", applyFilters);

        function applyFilters() {
          const searchText = searchInput.value.toLowerCase();
          const relationshipText = relationshipInput.value.toLowerCase();

          cy.elements().forEach(element => {
            if (element.isNode()) {
              const label = element.data("label").toLowerCase();
              const visibleByName = label.includes(searchText);
              const visibleByRelationship = element.connectedEdges().some(edge => {
                const edgeLabel = edge.data("label").toLowerCase();
                return edgeLabel.includes(relationshipText);
              });

              // Hide the node if it doesn't match the search or relationship criteria
              if (!visibleByName || !visibleByRelationship) {
                element.hide();
                // Hide the connected edges as well
                element.connectedEdges().hide();
              } else {
                // Show the node and its connected edges
                element.show();
                element.connectedEdges().show();
              }
            }
          });
        }


      })
      .catch(error => {
        console.error("Error retrieving user data:", error);
      });

    function showRowDataInInfoContainer(tableId, infoContainerId) {
      const table = document.getElementById(tableId);

      table.addEventListener("click", event => {
        const clickedCell = event.target;
        const clickedRow = clickedCell.parentElement;
        const rowData = Array.from(clickedRow.children).map(cell => cell.textContent);
        const headerRow = Array.from(table.rows[0].children).map(cell => cell.textContent);

        // Exclude the header row from the rowData
        const infoTableHTML = rowData.map((data, index) => {
          if (data !== headerRow[index]) {
            return `
                  <tr>
                    <th>${headerRow[index]}</th>
                    <td>${data}</td>
                  </tr>
                `;
          }
          return "";
        }).join("");

        // Set the info container content to the HTML table
        const infoContainer = document.getElementById(infoContainerId);
        infoContainer.innerHTML = `
              <table>
                ${infoTableHTML}
              </table>
            `;
      });
    }

    // Call the function to attach event listeners for the two tables
    showRowDataInInfoContainer("juridical-table", "info");
    showRowDataInInfoContainer("natural-table", "info");
})
.catch(error => {
    // Handle errors
    console.error(error);
});
  </script>
</body>

</html>