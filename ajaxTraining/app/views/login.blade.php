<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
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
                        $('#usernameDiv').replaceWith(userData);
                    }
                })
            });
        });

    </script>
</head>
<body>
    <form name="ajaxForm" id="ajaxForm" method="POST" action="doLogin">
        <input type="text" id="username" name="username" placeholder="Enter Username">
        <br/>
        <input type="password" id="password" name="password" placeholder="Enter Password">
        <br/>
    </form>

    <div id="usernameDiv" name="usernameDiv"></div>
    <br/>
    <button id="submit" onclick="subForm()" name="submit">Submit</button>
<!--    <button onclick="document.getElementById('forsm2').submit()">Submit</button>-->
<!--    <button>Submit</button>-->
</body>
</html>