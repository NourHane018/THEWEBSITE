

function showAppontment(){  
    $.ajax({
        url:"./adminView/viewAppointment.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


function showPatients(){
    $.ajax({
        url:"./adminView/viewPatient.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showAdv(){
    $.ajax({
        url:"./adminView/viewNotification.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}







