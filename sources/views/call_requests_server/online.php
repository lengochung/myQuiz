


<!--  -->
<script type="text/javascript">
    setInterval( () => {

        let http = new XMLHttpRequest();
        http.open("POST", "../sources/requests_server/online.php", false);
        http.send(null);

        let content_online = document.getElementById('content_online');
        content_online.innerHTML = http.responseText;

        let dem = 0;

        for (const ele of content_online.getElementsByTagName('h6')) {
            dem++;
        }

        document.getElementById('total_online').innerHTML = '(' + dem + ')';

    }, 1000);
</script>