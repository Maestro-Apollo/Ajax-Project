<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <span id="success_msg" class="text-success"></span>
    <span id="error_msg" class="text-danger"></span>

    <form id="myForm">

        <input type="text" id="fname" placeholder="First Name"><br>
        <input type="text" id="lname" placeholder="Last Name"><br>
        <input type="number" id="age" placeholder="Age"><br>
        <input type="submit" value="AJAX">
    </form>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let fname = $('#fname').val();
            let lname = $('#lname').val();
            let age = $('#age').val();
            if (fname == '' || lname == '' || age == '') {
                $('#error_msg').fadeIn().html("Error Message");
                setTimeout(() => {
                    $('#error_msg').fadeOut('slow');
                }, 2000);

            } else {
                $('#error_msg').html("");
                let vars = {
                    fname: fname,
                    lname: lname,
                    age: age,
                }
                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: vars,
                    dataType: "text",
                    success: function(data) {
                        $('form').trigger("reset");
                        $('#success_msg').fadeIn().html(data);

                        setTimeout(() => {
                            $('#success_msg').fadeOut('slow');
                        }, 2000);
                    }
                });
            }

        })
    })
    </script>

</body>

</html>