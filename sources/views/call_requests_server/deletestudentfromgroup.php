<script type="text/javascript">

        function deletestudentfromgroup (uid) {

            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/deletestudentfromgroup.php?uid=" + uid, false);
            http.send(null);

            $('#deletestudent').modal('hide');

            let applyaddmessage = document.getElementById('applyaddmessage');
            applyaddmessage.innerHTML = http.responseText;

            document.getElementById('inforstudent').innerHTML = '';

            setTimeout(() => {
                applyaddmessage.innerHTML = '';
            }, 3000);
        }
    
        

        

   
</script>