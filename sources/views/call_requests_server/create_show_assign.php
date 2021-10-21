<script type="text/javascript">

        setInterval( () => {
            let https = new XMLHttpRequest();
            https.open("POST", "../sources/requests_server/show_assigns.php", false);
            https.send(null);

            document.getElementById('show_assigns').innerHTML = https.responseText;
        }, 1000);

        function create_assign ( form ) {
            
            let aname = form.aname.value;
            let hours = form.hours.value;
            let minutes = form.minutes.value;
            let duration = form.duration.value;

            let aname_alert = document.getElementById('aname_alert');
            let date_alert = document.getElementById('date_alert');

            let promise = new Promise( (resolve, reject) => {
                if(form.aname.value=="") {
                    form.aname.setAttribute('class', 'form-control border-danger');
                    aname_alert.innerText = 'Không được để trống';
                    reject();
                } else { 
                    aname_alert.innerText = '';
                    form.aname.setAttribute('class', 'form-control');
                    resolve() 
                }
            }).then(() => {
                if(form.date.value=="") {
                    form.date.setAttribute('class', 'form-control border-danger');
                    date_alert.innerText = 'Vui lòng chọn ngày';
                    return Promise.reject();
                } else {
                    return Promise.resolve();
                }      
            }).then(() => {
                let time = form.date.value + ' ' + hours + ':' + minutes + ':' + '0';
                
                let now = new Date();
                let date = new Date(time);

                if(date.getTime() <= now.getTime()) {
                    date_alert.innerText = 'Ngày giờ làm bài phải lớn hơn ngày hiện tại';
                    form.date.setAttribute('class', 'form-control border-danger');
                    form.hours.setAttribute('class', ' border-danger');
                    form.minutes.setAttribute('class', ' border-danger');
                    return Promise.reject();
                } else {
                    date_alert.innerText = '';
                    form.date.setAttribute('class', 'form-control');
                    form.hours.setAttribute('class', '');
                    form.minutes.setAttribute('class', '');
                    return Promise.resolve(date);
                }
            }). then( (date) => {

                let year = date.getFullYear();
                let month = date.getMonth() + 1;
                let day = date.getDate();

                let timenow = new Date();
                let m = timenow.getMinutes();
                let h = timenow.getHours();
                let d = timenow.getDate();
                let mt = timenow.getMonth() + 1;
                let y = timenow.getFullYear();

                let timeStr = y + '-' + mt + '-' + d + ' ' + h + ':' + m + ':' + '0';
                
                let http = new XMLHttpRequest();
                http.open("GET", "../sources/requests_server/create_assigns.php?group=<?php echo current_group()['cid']; ?>&aname=" + aname + "&year=" + year + "&month=" + month + "&day=" + day + "&duration=" + duration + "&hours=" + hours + "&minutes=" + minutes + "&now=" + timeStr, false);
                http.send(null);

                $('#createassign').modal('hide');
                document.getElementById('message_create_assign').innerHTML = http.responseText;

                setTimeout(() => {
                    document.getElementById('message_create_assign').innerHTML = '';
                }, 3000);
            }).catch((err) => {
                
            });

        }
    
        

        

   
</script>