<script type="text/javascript">

        setInterval( () => {
            let http = new XMLHttpRequest();
            http.open("POST", "../sources/requests_server/btn_questions.php", false);
            http.send(null);

            document.getElementById('btn_questions').innerHTML = http.responseText;
        }, 1000);

        function showquestionfordo( qid, num ) {
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/questionfordo.php?qid=" + qid + "&num=" + num, false);
            http.send(null);

            document.getElementById('questionfordo').innerHTML = http.responseText;
        }

        function updateanswer(qid, answer) {
            
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/updateanswerrolestudent.php?qid=" + qid + "&answer=" + answer, false);
            http.send(null);

        }

        setInterval( () => {
            let btns = document.getElementById('btn_questions').getElementsByClassName('btn-primary');

            let dem = 0;
            for (const iterator of btns) {
                dem++;
            }
            document.getElementById('process').innerHTML = dem;
        }, 1000);
    
        

        

   
</script>