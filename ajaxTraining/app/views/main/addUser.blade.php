<html>
<head>
    <script src="js/jquery-1.11.0.min.js"></script>
    <style>
        td, th {
            width: 25%;
        }
        table {
            /*border-style: solid;*/
            width: 100%;
        }
    </style>


    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                var url = $('#ajaxForm').attr('action');
                $.ajax({
                    type : 'POST',
                    url : url,
                    data : $('#ajaxForm').serialize(),
                    success : function(userData){
                        $('#tableBody').append(userData['tableElement']);
                        $('#errorPanel').replaceWith(userData['msg']);
                    }
                })
                $('#message').val('');
                validateInput();
                setTimeout(function(){ $('#errorPanel').empty(); },4000);
            });

//            $('a').click(function(){
            $('a').on('click', function(){
                var url = $(this).attr('name');
                $.ajax({
                    type : 'POST',
                    url : url,
                    data : $('#'+url).serialize(),
                    success : function(tableData){
                        $('#'+url).closest('tr').remove();
                    }
                })
            });
        });

        function validateInput()
        {
            if(document.getElementById('password').value.length == 0 || document.getElementById('username').value.length == 0 || document.getElementById('userType').value == ''|| document.getElementById('firstname').value.length == 0 || document.getElementById('lastname').value.length == 0 )
                document.getElementById('submit').disabled = true;
            else
                document.getElementById('submit').disabled = false;
        }


        function sleep(seconds)
        {
            var e = new Date().getTime() + (seconds * 1000);
            while (new Date().getTime() <= e) {}
        }
    </script>
</head>
<body>
    <center>
        <h2 style="padding: 1em;"> <a href="home">Add a message</a> | <a href="logout">Logout</a> | Add another user</h2>
        <div>
            <form action="home/newUser" method="POST" name="ajaxForm" id="ajaxForm">
                <input type="text" id='firstname' name="firstname" onkeyup="validateInput()" placeholder="Enter first name"/><br/>
                <input type="text" id='lastname' name="lastname" onkeyup="validateInput()" placeholder="Enter last name"/><br/>
                <input type="text" id='username' name="username" onkeyup="validateInput()" placeholder="Enter username"/>
                <br/>
                <input type="password" id='password' name="password" onkeyup="validateInput()" placeholder="Enter password"/>
                <br/>
                <select name="userType" id="userType" onchange="validateInput()">
                    <option value="admin">Admin</option>
                    <option value="poster">Poster</option>
                </select>
            </form>
            <button id="submit" name="submit" disabled>Create User</button>
        </div>
        <div style="position: absolute; z-index: -1; width: 100%;">
            <h4 id="errorPanel"><font></font></h4>
        </div>
        <table border="2" style="margin-top: 5em;">
            <thead>
                <th>Username</th>
                <th>Name</th>
                <th>Account Type</th>
                <th>Action</th>
            </thead>
            <tbody id="tableBody">
                @foreach($users as $user)
                    <tr>
                        <td>{{{ $user->username }}}</td>
                        <td>{{{ $user->firstname }}} {{{ $user->lastname }}}</td>
                        <td>{{{ $user->type }}}</td>
                        <td>
                            <form method="POST" action="deleteUser_{{$user->id}}" id="deleteUser_{{$user->id}}">
                                <a href="#" name="deleteUser_{{$user->id}}">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
</body>
</html>