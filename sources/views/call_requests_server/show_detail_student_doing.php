
<script>

    setInterval( ()=> {
        let https = new XMLHttpRequest();
            https.open("GET", "../sources/requests_server/show_detail_student_doing.php?name=" + "<?php echo $_GET['requestnamestudent']; ?>", false);
            https.send(null); 

            let id = "show_detail_student_doing";

            let show_detail_student_doing = document.getElementById(id);
            
            show_detail_student_doing.innerHTML = https.responseText;
           
    },1000);
    
    
    
    
    
</script>