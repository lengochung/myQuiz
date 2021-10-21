<script type="text/javascript">

    function showquestion (qid, num) {

        let http = new XMLHttpRequest();
        http.open("GET", "../sources/requests_server/showquestion.php?qid=" + qid + "&num=" + num, false);
        http.send(null);
        
        document.getElementById('showquestion').innerHTML = http.responseText;
    }
</script>