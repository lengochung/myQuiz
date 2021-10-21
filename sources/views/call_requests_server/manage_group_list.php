<script type="text/javascript">

    setInterval( () => {
        let http = new XMLHttpRequest();
        http.open("POST", "../sources/requests_server/manage_group_list.php", false);
        http.send(null);
        
        document.getElementById('manage_group_list').innerHTML = http.responseText;

        <?php 
            $i = 1;
            while ( $i <= 40 ):
        ?>

            $("#item<?php echo $i; ?>" ).hover(function() {
                
                <?php
                    $k = 1; 
                    while ($k <= 40) :
                ?>
                            $('#hover<?php echo $k++; ?>').css('display', 'none');
                <?php
                    endwhile;
                ?>

                $('#hover<?php echo $i++; ?>').css('display', 'block');
            });

        <?php endwhile; ?>

    }, 1000);

</script>
