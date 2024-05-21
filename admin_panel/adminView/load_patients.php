<style>.edit-link,
.delete-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: #315467;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.edit-link:hover,
.delete-link:hover {
    color: white;
    text-decoration: none; 
    background-color: #5dadc4; /* Change this to the desired hover color */
}
</style>

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
// Include database connection
include_once "../inc/connections.php";

// Fetch data from the database for approved patients
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
        echo "<a href='adminView/edit_patient.php?id={$row['id']}' class='edit-link'>Edit</a> |";
        echo "<a href='#' class='delete-patient delete-link' data-id='{$row['id']}'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No patients found</td></tr>";
}

// Close the database connection
$conn->close();
?>
</table>

