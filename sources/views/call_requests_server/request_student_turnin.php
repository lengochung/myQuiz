
<script type="text/javascript">

    setInterval( () => {
        let http = new XMLHttpRequest();
        http.open("POST", "../sources/requests_server/request_student_turnin.php", false);
        http.send(null);

        let request_student_turnin = document.getElementById('request_student_turnin');
        request_student_turnin.innerHTML = http.responseText;


        <?php 

            $i = 1;
            while ( $i <= 40 ):
        ?>

            $("#detail_doassign<?php echo $i; ?>" ).hover(function() {
                
                <?php
                    $k = 1; 
                    while ($k <= 40) :
                ?>
                            $('#hovers<?php echo $k++; ?>').css('display', 'none');
                <?php
                    endwhile;
                ?>

                $('#hovers<?php echo $i++; ?>').css('display', 'block');
            });

        <?php 
                endwhile; 
        ?>
    }, 1000);


</script>