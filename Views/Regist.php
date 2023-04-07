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
            height: 70vh !important;
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
        <div class="row mb-4 pt-2">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="firstNameStudent" class="form-control" required />
                    <label class="form-label" for="firstNameStudent">First name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="surnameStudent" class="form-control" required />
                    <label class="form-label" for="surnameStudent">Last name</label>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="password" id="password" class="form-control" required />
                    <label class="form-label" for="password">Password</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="password" id="repeatPassword" class="form-control" required />
                    <label class="form-label" for="repeatPassword">Repeat password</label>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="form-outline mb-4">
                    <input id="studentBirthDate" type="date" class="form-control" placeholder="dd-mm-yyyy" value="" min="1900-01-01" max="2005-12-31" required>
                    <label class="form-label" for="studentBirthDate">Birth Date</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline mb-3">
                    <input type="text" id="phone" class="form-control" required />
                    <label class="form-label" for="phone">Phone</label>
                </div>
            </div>
        </div>
        <div class="form-outline mb-4">
            <input type="email" id="emailAddress" class="form-control" required />
            <label class="form-label" for="emailAddress">Email address</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="termsAndConditions" class="form-check-input" required />
            <label class="form-check-label" for="termsAndConditions">Checking out you are ACCEPTING our <a href="#">TERMS and CONDITIONS</a></label>
        </div>
        <button id="register-submit-button" type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
    </div>
</body>

</html>

<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd/mm/yyyy'
    });
    $(document).ready(function() {
        $("#register-submit-button").on("click", function() {
            if (checkInputsAreNotEmpty().length == 0) {
                var password = $("#password").val();
                var phone = $("#phone").val();
                var email = $("#emailAddress").val();
                if (validatePassword(password) && validatePhone(phone) && validateEmail(email) && validateTerms()) {
                    var fName = $("#firstNameStudent").val();
                    var sName = $("#surnameStudent").val();
                    var birthDate = $("#studentBirthDate").val();

                    var request = $.ajax({
                        url: '/index.php/user/register',
                        method: "POST",
                        context: false,
                        dataType: 'json',
                        data: {
                            password: password,
                            email: email,
                            phone: phone,
                            name: fName,
                            surname: sName,
                            birthDate: birthDate
                        },
                        cache: false,
                        success: function(data) {
                            $(location).prop('href', '/index.php/user/login')

                        },
                        error: function(xhr) {
                            Alert("Ha ocurrido un error.");
                        }
                    });
                }
            }
        })
    })

    function validatePassword(password) {
        var repeatPassword = $("#repeatPassword").val();
        return (password === repeatPassword) ? true : false;
    }

    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return (!emailReg.test(email)) ? false : true;
    }

    function validatePhone(phone) {
        var phoneReg = /[0-9]{9}$/;
        return (!phoneReg.test(phone)) ? false : true;
    }

    function validateTerms() {
        return $("#termsAndConditions").is(":checked");
    }

    function checkInputsAreNotEmpty() {
        var required = $('input,textarea,select').filter('[required]:visible');
        var emptyRequired = [];
        required.each(function() {
            if ($(this).val() == '' && $(this).attr('id') != 'termsAndConditions') {
                emptyRequired.push($(this).attr('id'));
            }
            if ($(this).attr('id') == 'termsAndConditions' && !$(this).is(":checked")) {
                emptyRequired.push($(this).attr('id'));
            }
        });

        return emptyRequired;
    }
</script>