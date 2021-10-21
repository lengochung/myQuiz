<script>
    function admin_check_student(box, uid) {
        let bool = 0;
        if(box.checked) bool = 1;

        let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/admin_check_student.php?uid=" + uid + "&bool=" + bool, false);
            http.send(null);
    }

</script>