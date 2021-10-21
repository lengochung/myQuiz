<script type="text/javascript">

    function update_answer (  form, qid ) {

        let http = new XMLHttpRequest();
        http.open("GET", "../sources/requests_server/update_answer.php?qid=" + qid + "&answer=" + form.answer.value, false);
        http.send(null);
        
        document.getElementById('message_update_answer').innerHTML = 'Đã cập nhật đáp án ' + form.answer.value;
    }
</script>