<html>
 <head>
 <Title>☕️Registration Form aditya06</Title>
 <style type="text/css">
 body { 
   background-color: #eaeaea; 
   border-top: solid 10px #000;
 	 color: #333; 
   font-size: .85em; 
   margin: 20; 
   padding: 20;
 	 font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
* {
  box-sizing: border-box;
}
.text-center{
    text-align:center;
}
form {
  padding: 1em;
  background: #f9f9f9;
  border: 1px solid #c1c1c1;
  margin-top: 2rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
  padding: 1em;}
form input {
  margin-bottom: 1rem;
  background: #fff;
  border: 1px solid #9c9c9c;}
form button {
  background: lightgrey;
  padding: 0.7em;
  border: 0;}
form button:hover {
  background: gold;}
label {
  text-align: right;
  display: block;
  padding: 0.5em 1.5em 0.5em 0;}
input {
  width: 100%;
  padding: 0.7em;
  margin-bottom: 0.5rem;}
input:focus {
  outline: 3px solid gold;}

@media (min-width: 400px) {
  form {
    overflow: hidden;
 }
  label {
    float: left;
    width: 200px;
  }
  input {
    float: left;
    /*width: calc(100% - 200px);*/
  }

  button {
    float: right;
    width: calc(100% - 200px);
  }
}
 </style>
 </head>
 <body>
 <div class="text-center">
 <h1>Register here Submission 1!</h1>
 <p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>
 </div>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Name :  <input type="text" name="name" id="name"/></br></br>
       Email : <input type="text" name="email" id="email"/></br></br>
       Job : <input type="text" name="job" id="job"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" />
 </form>
 <?php
    $host = "<Nama server database Anda>";
    $user = "<Nama admin database Anda>";
    $pass = "<Password admin database Anda>";
    $db = "<Nama database Anda>";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $job = $_POST['job'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (name, email, job, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $job);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Job</th>";
                echo "<th>Date</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['name']."</td>";
                    echo "<td>".$registrant['email']."</td>";
                    echo "<td>".$registrant['job']."</td>";
                    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>
