<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    * {
        padding: 0;
        margin: 0;
    }

    ul {
        background-color: #eee;
        cursor: pointer;
    }

    li {
        padding: 12px;
    }

    .anyClass {
        overflow-y: scroll;
        height: 60vh;

    }
    </style>
</head>

<body>

    <span id="success_msg" class="text-success"></span>
    <span id="error_msg" class="text-danger"></span>

    <div class="container" style="width: 500px;">
        <form id="myForm" class="mt-5">

            <input type="text" id="fname" placeholder="First Name" class="form-control">

            <div id="output" class="panel-inner"></div>



        </form>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#fname').keyup(function() {
            let fname = $(this).val();
            if (fname != '') {
                $.ajax({
                    type: "POST",
                    url: "itemList.php",
                    data: {
                        fname: fname
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#output').fadeIn();
                        $('#output').html(data);
                    }
                });
            } else {
                $('#output').fadeOut();
                $('#output').html("");
            }

        });
        $('#output').parent().on('click', 'li', function() {
            $('#fname').val($(this).text());
            $('#output').fadeOut();
        });

    });
    </script>

</body>

</html>