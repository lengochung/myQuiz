<?php

class Mail {

            public static function send_confirm_code ( $email, $code ) {
                    echo   "<script language='javascript'>
                                var Email = { send: function (a) { return new Promise(function (n, e) { a.nocache = Math.floor(1e6 * Math.random() + 1), a.Action = 'Send'; var t = JSON.stringify(a); Email.ajaxPost('https://smtpjs.com/v3/smtpjs.aspx?', t, function (e) { n(e) }) }) }, ajaxPost: function (e, n, t) { var a = Email.createCORSRequest('POST', e); a.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'), a.onload = function () { var e = a.responseText; null != t && t(e) }, a.send(n) }, ajax: function (e, n) { var t = Email.createCORSRequest('GET', e); t.onload = function () { var e = t.responseText; null != n && n(e) }, t.send() }, createCORSRequest: function (e, n) { var t = new XMLHttpRequest; return 'withCredentials' in t ? t.open(e, n, !0) : 'undefined' != typeof XDomainRequest ? (t = new XDomainRequest).open(e, n) : t = null, t } };
                                  
                                Email.send({
                                    Host : 'smtp.gmail.com',
                                    Username : 'hungln006@gmail.com',
                                    Password : 'ndbpgazfwbqtvlcf',
                                    To : '$email',
                                    From : 'hungln006@gmail.com',
                                    Subject : 'QUÊN MẬT KHẨU - HỆ THỐNG BÀI THI TRẮC NGHIỆM',
                                    Body: '<div>Mã xác nhận: <b>$code</b></div>'                       
                                });
                                  
                            </script>";
            }

            public static function send_reset_password ( $email, $reset ) {
                    echo   "<script language='javascript'>
                                var Email = { send: function (a) { return new Promise(function (n, e) { a.nocache = Math.floor(1e6 * Math.random() + 1), a.Action = 'Send'; var t = JSON.stringify(a); Email.ajaxPost('https://smtpjs.com/v3/smtpjs.aspx?', t, function (e) { n(e) }) }) }, ajaxPost: function (e, n, t) { var a = Email.createCORSRequest('POST', e); a.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'), a.onload = function () { var e = a.responseText; null != t && t(e) }, a.send(n) }, ajax: function (e, n) { var t = Email.createCORSRequest('GET', e); t.onload = function () { var e = t.responseText; null != n && n(e) }, t.send() }, createCORSRequest: function (e, n) { var t = new XMLHttpRequest; return 'withCredentials' in t ? t.open(e, n, !0) : 'undefined' != typeof XDomainRequest ? (t = new XDomainRequest).open(e, n) : t = null, t } };
                                  
                                Email.send({
                                    Host : 'smtp.gmail.com',
                                    Username : 'hungln006@gmail.com',
                                    Password : 'ndbpgazfwbqtvlcf',
                                    To : '$email',
                                    From : 'hungln006@gmail.com',
                                    Subject : 'MẬT KHẨU RESET',
                                    Body: '<div>Đây là mật khẩu đã reset, hãy thay đổi mật khẩu khi quay lại hệ thống: <b>$reset</b></div>'                       
                                });
                                  
                                setTimeout(() => {
                                    window.alert('Mật khẩu đã được gửi đến email');
                                    window.location = './';
                                }, 1000);
                            </script>";
            }
        }

?>
