<script type="text/javascript">

        function update_assign ( form ) {
            
            let hours = form.hours.value;
            let minutes = form.minutes.value;
            let duration = form.duration.value;

            let promise = new Promise( (resolve, reject) => {
                let time = form.date.value + ' ' + hours + ':' + minutes + ':' + '0';
                
                let now = new Date();
                let date = new Date(time);

                if(date.getTime() <= now.getTime()) {
                    date_alert.innerText = 'Ngày giờ làm bài phải lớn hơn ngày hiện tại';
                    form.date.setAttribute('class', 'form-control border-danger');
                    form.hours.setAttribute('class', ' border-danger');
                    form.minutes.setAttribute('class', ' border-danger');
                    return reject();
                } else {
                    date_alert.innerText = '';
                    form.date.setAttribute('class', 'form-control');
                    form.hours.setAttribute('class', '');
                    form.minutes.setAttribute('class', '');
                    return resolve(date);
                }
            }). then( (date) => {

                let year = date.getFullYear();
                let month = date.getMonth() + 1;
                let day = date.getDate();
                
                let http = new XMLHttpRequest();
                http.open("GET", "../sources/requests_server/update_assign.php?aid=<?php echo c_assign()['aid']; ?>&year=" + year + "&month=" + month + "&day=" + day + "&duration=" + duration + "&hours=" + hours + "&minutes=" + minutes, false);
                http.send(null);

                $('#update_assign').modal('hide');
                window.location.reload()

                setTimeout(() => {
                    document.getElementById('message_create_assign').innerHTML = '';
                }, 5000);
            }).catch((err) => {
                
            });

        }
</script>