<script type="text/javascript">

    let load = setInterval( () => {
        
        let http = new XMLHttpRequest();
        http.open("POST", "../sources/requests_server/load_assignment.php?", false);
        http.send(null);

        if(http.responseText) {
            console.log(http.responseText);
            window.alert("Bài thi đang tải lên, vui lòng chờ 5s và nhấn OK")
            window.location = "<?php echo URL; ?>assignments/?assignments=<?php echo load_assign()['aname']; ?>";

        } else {

            let start = <?php echo date_timestamp_get(new DateTime(load_assign()['start'])) - 5*60*60; ?>;
            let now = new Date();

            now = Math.floor(now.getTime()/1000);

            let cd = start - now;

            let d = Math.floor(cd/(24*60*60));
            let h = Math.floor(cd/(60*60)%24);
            let m = Math.floor(cd/(60)%(60));
            let s = Math.floor(cd%60);

            if(d<10) { d = '0' + d}
            if(h<10) { h = '0' + h}
            if(m<10) { m = '0' + m}
            if(s<10) { s = '0' + s}

            let nof = "<b><a class='btn btn-secondary' href='<?php echo URL; ?>assignments?assignments=<?php echo load_assign()['aname']; ?>'><?php echo load_assign()['aname']; ?></a></b> ";

            let str = d + ' ngày ' + h + ':' + m + ':' + s;
           
            document.getElementById('nof_load_assign').innerHTML =  nof + str;
        }


    }, 1000);

    
</script>
