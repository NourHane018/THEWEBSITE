<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-6vpoFPwVuVhC2Y2Yvf2kHvI3s63PeSsqwcC4tZ/xqbyIi0eo5uDPzRf3F4ESdCL3HS2deW7E9cugc5icPbOJLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<script>
$(document).ready(function(){
  


    $(document).on('click', '.delete-patient', function(e){
        e.preventDefault();
        var patientId = $(this).data('id');
        
        // Display confirmation dialog
        var confirmation = confirm('Are you sure you want to delete this patient?');
        
        // If user confirms deletion
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: 'adminView/delete_patient.php?id=' + patientId,
                success: function(response){
                    $('#row_' + patientId).remove();
                    // alert('Patient deleted successfully.');
                },
                error: function(xhr, status, error){
                    alert('Error occurred while deleting patient.');
                    console.error(error);
                }
            });
        }
    });
    
    // Event handler for approving a pending registration and sending email
    $(document).on('click', '.approve-registration', function(e){
        e.preventDefault();
        var registrationId = $(this).data('id');
        console.log('Registration ID:', registrationId); 
        
        $.ajax({
            type: 'GET',
            url: 'adminView/approve.php?id=' + registrationId,
            success: function(response){
                $('#row_' + registrationId).remove();
                alert('Patient approved successfully.');
                
                // AJAX request to send email
                $.ajax({
                    type: 'POST',
                    url: 'adminView/send_email_to_user.php',
                    data: { registrationId: registrationId },
                    success: function(response){
                        alert('An email was successfully sent to the user');
                    },
                    error: function(xhr, status, error){
                        alert('Error occurred while sending email :(.');
                        console.error(error);
                    }
                });
            },
            error: function(xhr, status, error){
                alert('Error occurred while approving registration.');
                console.error(error);
            }
        });
    });
});

</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Table in your HTML -->
<style>
    .add-notification-button {
            margin-top: 20px;
            text-align: center;
        }
        .add-notification-button a {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            background-color: #5dadc4;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .add-notification-button a:hover {
            background-color: #315467;
        }
        .delete-patient{
          text-decoration: none; 
          
          color:#5dadc4;
        }
        .delete-patient:hover {
          text-decoration: none; 
    background-color: #315467; /* Change this to the desired hover color */
}
        

</style>
<div>
<h2 style=" 
            color:#315467;
            text-align: center;
        ">Pending Registrations</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Username</th>
        <th class="text-left">Email</th>
        <th class="text-left">Birthday Date</th>
        <th class="text-left">Gender</th>
        <th class="text-left">Actions</th> 
      </tr>
    </thead>
    <?php
        // Include database connection
        include_once "../inc/connections.php";
        // Fetch pending registrations from database
        $sql = "SELECT * FROM users WHERE status='pending'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id='row_{$row['id']}'>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['birthday']}</td>";
                echo "<td>{$row['gender']}</td>";
                echo "<td><a href='#' class='approve-registration' data-id='{$row['id']}'>Approve</a> | <a href='#' class='delete-patient' data-id='{$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No pending registrations</td></tr>";
        }
      ?>

  </table>
</div>

<div>
<h2 style="color:#315467; text-align: center;">All Patients</h2>

<i id="refreshPatients" class="fas fa-sync-alt" style="color: #315467; cursor: pointer;" onclick="refreshPatients()"></i>



</div>

    <table id="allPatientsTable" class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Username</th>
        <th class="text-left">Email</th>
        <th class="text-left">Birthday Date</th>
        <th class="text-left">Gender</th>
        <th class="text-center">Actions</th> 
      </tr>
    </thead>
    <?php
      // Fetch data from database for approved patients
      $sql = "SELECT * FROM users WHERE status='approved'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr id='row_{$row['id']}'>";
              echo "<td>{$row['id']}</td>";
              echo "<td>{$row['username']}</td>";
              echo "<td>{$row['email']}</td>";
              echo "<td>{$row['birthday']}</td>";
              echo "<td>{$row['gender']}</td>";
              echo "<td>";
              echo "<a href='adminView/edit_patient.php?id={$row['id']}' style='display: inline-block; padding: 10px 20px; background-color: #315467; color: white; text-decoration: none; border-radius: 5px;'>Edit</a> |";
              echo "<a href='#' class='delete-patient' data-id='{$row['id']}' style='display: inline-block; padding: 10px 20px; background-color: #315467; color: white; text-decoration: none; border-radius: 5px;'>Delete</a>";
              echo "</td>";
              echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No patients found</td></tr>";
      }
    ?>
  </table>
  <div class="add-notification-button">
  <a href="adminView/add_patiente.php" >Add New Patient</a>
  </div>
  
</div>
<script>
    $(document).ready(function(){
        // Function to load patients into the table
        function loadPatients() {
            $.ajax({
                type: 'GET',
                url: 'adminView/load_patients.php', // Modify the URL to the script that fetches patients
                success: function(response){
                    $('#allPatientsTable').html(response); // Update the table content
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        }

        // Initial load of patients when the page loads
        loadPatients();

        // Event handler for the refresh button
        $('#refreshPatients').click(function(){
            loadPatients(); // Reload patients when the button is clicked
        });
    });
</script>
