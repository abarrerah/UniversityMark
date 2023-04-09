<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"> </script>
    <style>
        .container {
            position: absolute !important;
            width: 85% !important;
            height: 45vh !important;
            z-index: 99 !important;
            left: 7.5% !important;
            top: 10% !important;
            background-color: #EFF2EF !important;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-2 col-sm-12">
        <div class="form-outline mb-4">
            <input type="email" id="emailAddress" class="form-control mt-2" required />
            <label class="form-label" for="emailAddress">Email address</label>
        </div>

        <div class="form-outline">
            <input type="password" id="password" class="form-control" required />
            <label class="form-label" for="password">Password</label>
        </div>

        <button id="login-submit-button" type="submit" class="btn btn-primary btn-block mb-4 col-sm-3 mt-3">Sign in</button>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#login-submit-button").on("click", function() {
            var password = $("#password").val();
            var email = $("#emailAddress").val();
            if (email == '' || password == '') {
                alert("Password or email are empty.");
            } else {
               if (!validateEmail(email)) {
                    alert("Incorrect format of Email");
               } else {
                    var request = $.ajax({
                        url: '/index.php/user/signin',
                        method: "POST",
                        context: false,
                        dataType: 'json',
                        data: {
                            password: password,
                            email: email
                        },
                        cache: false,
                        success: function(data) {
                            if (data['status'] === 200) {
                                $(location).prop('href', '/index.php/mark/marks')
                            } else {
                                alert('Ha ocurrido un error.');
                            } 
                        },
                        error: function(xhr) {
                            Alert("Ha ocurrido un error.");
                        }
                    })
               } 
            }
        })
    })

    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return (!emailReg.test(email)) ? false : true;
    }
</script>