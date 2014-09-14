<html>
<head>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script>
        window.onload = function()
        {
            document.getElementById('testHidden').value = 'none'
        };

        $(document).ready(function(){
           $('#submit').click(function(){
               var username = $('#username').val();
               var password = $('#password').val();
               var url = $('#ajaxForm').attr('action');
                $.ajax({
                    type : 'POST',
                    url : url,
                    data : $('#ajaxForm').serialize(),
                    success : function(userData)
                    {
                        $('#usernameDiv').replaceWith(userData['success']);
                        $('#testHidden').replaceWith(userData['hidden']);
                        checkForm();
                    }
                })
            });
        });

        function checkLength()
        {
            if(document.getElementById('username').value.length != 0 && document.getElementById('password').value.length != 0)
            {
                document.getElementById('submit').disabled = false;
            }
            else
            {
                document.getElementById('submit').disabled = true;
            }
        }

        function checkForm()
        {
            if(document.getElementById('testHidden').value == 'true')
            {
                document.getElementById('form2').submit();
            }
        }
    </script>
</head>
<body>
<center>
    <div style="margin: 3ex;">
        <h4>username : admin</h4>
        <h4>password : password</h4>
    </div>
    <form name="ajaxForm" id="ajaxForm" method="POST" action="doLogin">
        <input type="text" id="username" name="username" onkeyup="checkLength()" placeholder="Enter Username">
        <br/>
        <input type="password" id="password" name="password" onkeyup="checkLength()" placeholder="Enter Password">
        <br/>
    </form>
    <form method="GET" action="home" name="form2" id="form2"></form>
    <div id="usernameDiv"></div>
    <input type="hidden" name="testHidden" id="testHidden" value="none"/>
    <br/>
    <button id="submit" name="submit" disabled>Submit</button>
<!--    <button onclick="document.getElementById('forsm2').submit()">Submit</button>-->
<!--    <button>Submit</button>-->
</center>
</body>
</html>