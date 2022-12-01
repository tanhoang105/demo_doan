<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        body{
            background: rgb(202, 202, 202);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center flex-wrap align-content-center" style="height: 100px;">
            <img src="logo.png" style="width: 185px; height: 45px;">
        </div>

        <div class="bg-white">
            <div class="w-100" style="height: 50px;"></div>

            <div class="d-flex justify-content-center">
                <h2>Thay Đổi Mật Khẩu</h2>
            </div>

            <div class="w-100" style="height: 50px;"></div>

            <div class="d-flex justify-content-center">
                <p class="font-weight-bold" style="text-align: center;">
                    Chúng tôi nhận được yêu cầu lấy lại mật khẩu từ tài khoản của bạn.   
                    <br>
                    Để thay đổi mật khẩu mới vui lòng truy cập vào link bên dưới:
                </p>
            </div>

            <div class="">
                <div class="w-100" style="height: 30px;"></div>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('form_doi_mat_khau', $token) }}">
                      <button class="btn btn-primary" style="height: 50px; width: 200px; font-size: 18px;">
                        Thay Đổi Mật Khẩu 
                    </button>  
                    </a> 
                </div>

                <div class="w-100" style="height: 40px;"></div>
            </div>

            <div class="d-flex justify-content-center">
                <p style="text-align: center;">
                    Nếu bạn không gửi yêu cầu lấy lại mật khẩu, hãy đảm bảo rằng tải khoản của bạn vẫn an toàn,
                    <br>
                    hoặc liên hệ với chúng tôi để được hỗ trợ. Xin cảm ơn.
                </p>
            </div>

            <div class="w-100" style="height: 50px;"></div>
        </div>
    </div>
    
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>