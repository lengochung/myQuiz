<script>

    function updatepassword (  form ) {

        let old_password = document.getElementById('old_password')
        let alert_old_password = document.getElementById('alert_old_password')
        let new_password = document.getElementById('new_password')
        let alert_new_password = document.getElementById('alert_new_password')
        let cfm_password = document.getElementById('cfm_new_password')
        let alert_cfm_password = document.getElementById('alert_cfm_new_password')

        let arr_pass = [old_password, new_password, cfm_password];
        let arr_alert = [alert_old_password, alert_new_password, alert_cfm_password]

        arr_pass.forEach(element => {
            element.setAttribute('class', 'form-control');
        });
        arr_alert.forEach(element => {
            element.style.display = "none";
        });

        // Validate
        promise = new Promise( (resolve, reject) => {
            if(form.old_password.value == "")
                return reject(1);
            else
                return resolve(form.old_password.value);
        }).then((result) => {
            
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/update_password.php?password=" + result + "&mode=0", false);
            http.send(null);
            
            if(http.responseText==1)
                return Promise.resolve();
            else
                return Promise.reject(2);
        }).then((result) => {
           
            if(form.new_password.value == "")
                return Promise.reject(3);
            else
                return Promise.resolve();

        }).then((result) => {

            if(form.new_password.value.length < 8)
                return Promise.reject(7);
            else
                return Promise.resolve();
            
        }).then((result) => {
            
            if(form.cfm_new_password.value == "")
                return Promise.reject(4);
            else
                return Promise.resolve();

        }).then((result) => {
            
            if(form.new_password.value==form.cfm_new_password.value)
                return Promise.resolve(form.cfm_new_password.value)
            else
                return Promise.reject(5)

        }).then((result) => {
            
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/update_password.php?password=" + result + "&mode=0", false);
            http.send(null);

            if(http.responseText==1)
                return Promise.reject(6);
            else
               return Promise.resolve(result); 

        }).then((result) => {
            
            let http = new XMLHttpRequest();
            http.open("GET", "../sources/requests_server/update_password.php?password=" + result + "&mode=1", false);
            http.send(null);
            
            if(http.responseText)
                window.location.reload()

        }).catch((err) => {

            
            switch (err) {
                case 1:
                    old_password.setAttribute('class', 'border-danger form-control');
                    alert_old_password.style.display = 'block';
                    alert_old_password.innerText = 'Không được bỏ trống';
                    break;
                case 2:
                    old_password.setAttribute('class', 'border-danger form-control');
                    alert_old_password.style.display = 'block';
                    alert_old_password.innerText = 'Sai mật khẩu';
                    break;
                case 3:
                    new_password.setAttribute('class', 'border-danger form-control');
                    alert_new_password.style.display = 'block';
                    alert_new_password.innerText = 'Không được bỏ trống';
                    break;
                case 4:
                    cfm_password.setAttribute('class', 'border-danger form-control');
                    alert_cfm_password.style.display = 'block';
                    alert_cfm_password.innerText = 'Không được bỏ trống';
                    break;
                case 5:
                    cfm_password.setAttribute('class', 'border-danger form-control');
                    alert_cfm_password.style.display = 'block';
                    alert_cfm_password.innerText = 'Không khớp mật khẩu mới, vui lòng nhập lại';
                    break;
                case 6:
                    new_password.setAttribute('class', 'border-danger form-control');
                    alert_new_password.style.display = 'block';
                    alert_new_password.innerText = 'Bạn đang sử dụng lại mật khẩu cũ';
                    break;
                case 7:
                    new_password.setAttribute('class', 'border-danger form-control');
                    alert_new_password.style.display = 'block';
                    alert_new_password.innerText = 'Mật khẩu có 8 ký tự trở lên';
                    break;
            
                
            }
        });

    }
</script>
