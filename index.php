<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .highLight {
        background-color: yellowgreen;

    }

    .remo {
        padding: 15px;
        cursor: pointer;
    }


    span {
        padding: 5px;
        border: 1px solid #eee;
    }
    </style>
</head>

<body>

    <span id="success_msg" class="text-success"></span>
    <span id="error_msg" class="text-danger"></span>

    <form id="myForm">

        <input type="text" id="fname" placeholder="First Name"><br>
        <div id="userMsg"></div>
        <input type="text" id="lname" placeholder="Last Name"><br>
        <input type="number" id="age" placeholder="Age"><br>
        <input type="submit" value="AJAX">
    </form>

    <div id="output"></div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {

        myObj();

        $('#output').on('click', '.remo span', function() {
            console.log($(this).text());
            if ($(this).text() == 'Delete') {

                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: {
                        u_id: $(this).parent().attr('data-value')
                    },
                    dataType: "text",
                    success: function(data) {
                        myObj();
                        console.log(data);
                    }
                });
            } else {
                // console.log(this.getAttribute('data-value'));
                let mark = $(this).parent().hasClass('highLight');
                // console.log(mark);
                mark = mark ? 1 : 0;
                mark ^= 1;
                // console.log(mark);
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: {
                        u_id: $(this).parent().attr('data-value'),
                        mark: mark
                    },
                    dataType: "text",
                    success: function(data) {
                        // console.log(data);
                        myObj();
                        console.log('UPDATED');
                    }
                });
            }


        })

        function myObj() {
            $.getJSON("show.php",
                function(data) {
                    $('#output').html('<h1>People List</h1>');
                    $.each(data, function(i, item) {
                        let className = '';
                        if (item.checked == 1) {
                            className = 'highLight';
                        }
                        $('#output').append('<div class="remo ' + className + ' " data-value="' +
                            item.id + '" >' +
                            data[i].fname + ' ' + data[i].lname + '(' + data[i].age +
                            ')<span>Check</span><span>Delete</span> </div>'
                        );
                    });
                }
            );
        }

        $('#fname').keyup(function() {
            let firstName = $('#fname').val();
            $.ajax({
                type: "POST",
                url: "find.php",
                data: {
                    fname: firstName
                },
                dataType: "text",
                success: function(response) {
                    $('#userMsg').fadeIn().html(response);
                }
            });
        });


        // $('#fname').keyup(function() {
        //     let firstName = $('#fname').val();

        //     $.ajax({
        //         type: "POST",
        //         url: "find.php",
        //         data: {
        //             fname_search: firstName
        //         },
        //         dataType: "text",
        //         success: function(data) {

        //             if (data) {
        //                 $('#userMsg').fadeIn().html(data);

        //             } else {
        //                 $('#userMsg').fadeOut();
        //             }


        //         }
        //     });

        // });

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
                        myObj();
                        $('#success_msg').fadeIn().html(data);

                        setTimeout(() => {
                            $('#success_msg').fadeOut('slow');
                            $('#userMsg').fadeOut('slow');
                        }, 2000);

                    }
                });
            }

        })
    })
    </script>

</body>

</html>