<!--  -->
<script type="text/javascript">
    
    $('#searchforadd').keyup( () => {
        let keyword = document.getElementById('searchforadd').value;
        let showforadd = document.getElementById('showforadd');

        if(keyword!='') {
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/searchforadd.php?keyword=" + keyword, false);
            http.send(null);

            showforadd.innerHTML = http.responseText;
        } else {
            showforadd.innerHTML = "<option class='dropdown-header' value=''>...mời nhập</option>";
        }

    });
    
    function applyadd( ) {
        let name = document.getElementById('searchforadd');
        let applyaddmessage = document.getElementById('applyaddmessage');

        if(name.value!='') {
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/applyadd.php?name=" + name.value, false);
            http.send(null);

            applyaddmessage.innerHTML = http.responseText;

            setTimeout( () => {
                applyaddmessage.innerHTML = '';
            }, 3000);

        } 

        name.value = '';
    }

    setTimeout( () => {
        let applyaddmessage = document.getElementById('applyaddmessage');
        applyaddmessage.innerHTML = '';
    }, 5000);
</script>