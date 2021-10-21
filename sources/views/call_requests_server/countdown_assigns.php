<script type="text/javascript">
    
 
    let duration = 60*<?php echo c_assign()['duration']; ?>;
    let end = 5 + duration + <?php echo date_timestamp_get(new DateTime(c_assign()['start'])) - 5*60*60; ?>;

    let countdown_assigns = setInterval( () => {
        
        
        let now = new Date();
        now = Math.floor(now.getTime()/1000);

        let cd = end - now;

        let h = Math.floor(cd/(60*60)%24);
        let m = Math.floor(cd/(60)%(60));
        let s = Math.floor(cd%60);

        if(h==0&&m<=3){ document.getElementById('countdown_assigns').setAttribute('class', 'p-2 rounded text-danger') }

        if(h<10) { h = '0' + h}
        if(m<10) { m = '0' + m}
        if(s<10) { s = '0' + s}

        let countdown = h + ':' + m + ':' + s;

        <?php if(c_assign()['turn_in']): ?>
            let turn_in = '';
        <?php else: ?>
            let turn_in = "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#turn_in'>Nộp bài</button> ";

        <?php endif; ?>        
        document.getElementById('countdown_assigns').innerHTML = "<div class='border p-2'>" + turn_in + countdown + "</div>";

        if(cd < 0) {
            let http = new XMLHttpRequest();
            http.open("POST", "../sources/requests_server/unload_assignments.php", false);
            http.send(null);

            if(http.responseText) {
                window.alert('Kết thúc bài thi' + '<?php echo c_assign()['aname']; ?>');
                clearInterval(countdown_assigns);
                window.location.reload();
            } 
        } else {
            console.log('chua het gio');
        }
        

    },1000);

</script>
