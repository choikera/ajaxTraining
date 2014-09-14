<html>
<head>
    <script src="js/jquery-1.11.0.min.js"></script>
    <style>
        td, th {
            padding: 1em;
        }
        div {
            padding: 1em;
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
            });

//            $('a').click(function(){
            $('a').on('click', function(){
                var url = $(this).attr('name');
                alert(url);
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
            if(document.getElementById('message').value.length == 0)
                document.getElementById('submit').disabled = true;
            else
                document.getElementById('submit').disabled = false;
        }
    </script>
</head>
<body>
    <center>
        <h2 style="padding: 1em;">Add a message or <a href="logout">Logout</a></h2>
        <div>
            <form action="home/enterMessage" method="POST" name="ajaxForm" id="ajaxForm">
                <input type="text" id='message' name="message" onkeyup="validateInput()" placeholder="Enter message here"/>
            </form>
            <button id="submit" name="submit" disabled>Submit message</button>
        </div>
        <div>
            <h4 id="errorPanel"></h4>
        </div>

        <table border="2">
            <thead>
                <th>Message</th>
                <th>Posted By</th>
                <th>Action</th>
            </thead>
            <tbody id="tableBody">
                @foreach($msg as $msgs)
                    <tr>
                        <td>{{{ $msgs->msg }}}</td>
                        <td>{{{ $msgs->firstname }}}</td>
                        <td><form action="deleteMessage/{{$msgs->mid}}" method="POST" id="deleteForm_{{ $msgs->mid }}"><a href="#" id="deleteItem" name="deleteForm_{{ $msgs->mid }}">Delete!</a></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
</body>
</html>