<script type="text/javascript">
    setInterval( () => {
        let http = new XMLHttpRequest();
        http.open("POST", "../sources/requests_server/notifications.php", false);
        http.send(null);

        document.getElementById('notifications').innerHTML = http.responseText;

    }, 500);

    $('#content_nof').keypress( (event) => {
        let key = event.keyCode ? event.keyCode : event.which;
        if(key==13) {
            let content_nof = document.getElementById('content_nof');
            if(content_nof.value!='') {
                let http = new XMLHttpRequest();
                http.open("GET", "../sources/requests_server/content_nof.php?content_nof=" + content_nof.value, false);
                http.send(null);
                content_nof.value = '';
            }
        }
    });

    $('#btn_nof').click( (event) => {
            let content_nof = document.getElementById('content_nof');
            if(content_nof.value!='') {
                let http = new XMLHttpRequest();
                http.open("GET", "../sources/requests_server/content_nof.php?content_nof=" + content_nof.value, false);
                http.send(null);
                content_nof.value = '';
            }
    });
</script>