<script>
$(document).ready(function(){
    // Event handler for deleting an appointment
    $('.delete-appointment').click(function(e){
        e.preventDefault();
        var appointmentId = $(this).data('id');
        
        // Display confirmation dialog
        var confirmation = confirm('Are you sure you want to delete this appointment?');
        
        // If user confirms deletion
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: 'adminView/delete_appointment.php?id=' + appointmentId,
                success: function(response){
                    $('#row_' + appointmentId).remove();
                    //alert('Appointment deleted successfully.');
                },
                error: function(xhr, status, error){
                    alert('Error occurred while deleting appointment.');
                    console.error(error);
                }
            });
        } else {
            // If user cancels, do nothing
            return false;
        }
    });
});
</script>

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
        .delete-appointment{
          text-decoration: none;
          color:#5dadc4; 
        }
</style>
<!-- Table in your HTML -->
<div>
  <h2 style=" 
            color:#315467;
            text-align: center;
        ">All Patient Appointments</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Patient Name</th>
        <th class="text-left">Appointment Date and Time</th>
        <th class="text-left">Status</th>
        <th class="text-left">Actions</th> 
      </tr>
    </thead>
    <tbody>
      <?php
        include_once "../inc/connections.php";

        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
        $count = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
    ?>
    <tr id="row_<?php echo $row['id']; ?>">
      <td><?=$count?></td>
      <td><?=$row["patient_name"]?></td>
      <td><?=$row["appointment_date"]?></td>
      <td><?=$row["status"]?></td>
      <td>
        <!-- Button to delete appointment -->
        <a href="#" class="delete-appointment" data-id="<?php echo $row['id']; ?>" >Delete</a>
      </td>
    </tr>
    <?php
            $count++;
          }
        }
    ?>
    </tbody>
  </table>
</div>
  <!-- Form to add a new appointment -->
  <div class="add-notification-button">
  <a href="adminView/add_appointment.php">Add New Appointment</a>
  </div>
</div>
