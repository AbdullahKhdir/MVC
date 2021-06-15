
<?php
    function onsubmit (){
        if (isset($_POST["firstName"]) &&
            isset($_POST["lastName"]) &&
            isset($_POST["userName"]) &&
            isset($_POST["email"]) &&
            isset($_POST["password"]) &&
            isset($_POST["passwordConfirm"])) {
            if ((new \app\models\RegisterModel())->getError() === false) {
                $_SESSION["userName"] = $_POST["userName"];
                header("location: /home?register=success");
                exit();
            }
        }
    }
?>

<script type="application/javascript">
    let onclickeJS = () => {

        <?php
        /*
            if(isset($_POST["firstName"]) &&
               isset($_POST["lastName"]) &&
               isset($_POST["userName"]) &&
               isset($_POST["email"]) &&
               isset($_POST["password"]) &&
               isset($_POST["passwordConfirm"])){
               if ((new \app\models\RegisterModel())->getError() === false){
                   header("Location: /");
                   $params = [
                      "name" => "User",
                   ];
                   echo (new \app\core\Request())->getBody();
                   (new \app\Core\Controller())->render("home", $params);
                   exit();
               }
            }
        */?>
    }
</script>

  <div class="container-sm">
    <?php \app\Core\form\Form::begin("" , "POST", onsubmit()); ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "firstName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "lastName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "userName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "email") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "password") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "passwordConfirm") ?>
    <?php //<button onclick='onclickeJS()' class='btn btn-outline-primary' type='submit' name='register' style='margin-bottom: 20px'> Register </button>?>
    <?php echo \app\core\form\Form::btn()?>
    <?php \app\Core\form\Form::end(); ?>
  </div>

<?php //<button class="btn btn-outline-primary" type="submit" name="register" style="margin-bottom: 20px"> Register </button> ?>

<?php
/*
     <script type="application/javascript">
        const notify = () => {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        }
    </script>
    <div class="container-sm">
        <form class="needs-validation" method="POST" novalidate>
            <div class="mb-3 col">
                    <label for="exampleFormControlInput1" class="form-label">First Name</label>
                    <input type="text"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("firstName")){echo 'is-invalid';}else{ echo $_POST["firstName"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleFormControlInput1"
                           placeholder="Max"
                           name="firstName"
                           value="<?php echo $_POST["firstName"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('firstName') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <?php  if(!empty($FirstNameError)){echo $FirstNameError."<br><br>";} ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                    <input type="text"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("lastName")){echo 'is-invalid';}else{ echo $_POST["lastName"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleFormControlInput1"
                           placeholder="Mustermann"
                           name="lastName"
                           value="<?php echo $_POST["lastName"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('lastName') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <?php if(!empty($LastNameError)){echo $LastNameError."<br><br>";} ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("userName")){echo 'is-invalid';}else{ echo $_POST["userName"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleFormControlInput1"
                           placeholder="@maxMustermann"
                           name="userName"
                           value="<?php echo $_POST["userName"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('userName') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <?php if(!empty($UserNameError)){echo $UserNameError."<br><br>";} ?>
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("email")){echo 'is-invalid';}else{ echo $_POST["email"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter email"
                           name="email"
                           value="<?php echo $_POST["email"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('email') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <?php if(!empty($EmailError)){echo $EmailError."<br><br>";} ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("password")){echo 'is-invalid';}else{ echo $_POST["password"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleFormControlInput1"
                           placeholder="Password"
                           name="password"
                           value="<?php echo $_POST["password"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('password') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <?php if(!empty($PswdError)){echo $PswdError."<br><br>";} ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Password Confirmation</label>
                    <input type="password"
                           class="form-control <?php  if((new \app\models\RegisterModel())->hasError("passwordConfirm")){echo 'is-invalid';}else{ echo $_POST["passwordConfirm"] == null ? "is-invalid" : "is-valid"; } ?>"
                           id="exampleFormControlInput1"
                           placeholder="Password Confirmation"
                           name="passwordConfirm"
                           value="<?php echo $_POST["passwordConfirm"] ?>">
                    <div class="invalid-feedback">
                        <?php echo (new \app\models\RegisterModel())->getFirstError('passwordConfirm') ?>
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-1">
                    <p class="notify"> <?php if(!empty($PswdConfirmError)){echo $PswdConfirmError."<br><br>";} ?> </p>
                </div>
                <button class="col-1 btn btn-outline-primary"
                        type="submit"
                        name="register"
                        style="margin-bottom: 20px">
                    Register
                </button>
            </form>
        </div>
 */

?>

<?php
/*
     <div class="container-sm">
    <form onchange="notify()" class="needs-validation" action="" method="post" novalidate>
        <div class="mb-3 col">
                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text"
                       class="form-control <?php echo (new \app\models\RegisterModel())->hasError('firstName') ? ' is-invalid' : ''; ?>"
                       id="exampleFormControlInput1"
                       placeholder="Max"
                       name="firstName"
                       value="">
                <div class="invalid-feedback">
                    <?php echo (new \app\models\RegisterModel())->getFirstError('firstName') ?>
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
        </div>
        <div class="mb-1">
            <?php  if(!empty($FirstNameError)){echo $FirstNameError."<br><br>";} ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
            <input type="text"
                   class="form-control <?php echo (new \app\models\RegisterModel())->hasError('lastName') ? ' is-invalid' : ''; ?>"
                   id="exampleFormControlInput1"
                   placeholder="Mustermann"
                   name="lastName">
            <div class="invalid-feedback">
                <?php echo (new \app\models\RegisterModel())->getFirstError('lastName') ?>
            </div>
        </div>
        <div class="mb-1">
            <?php if(!empty($LastNameError)){echo $LastNameError."<br><br>";} ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="text"
                   class="form-control <?php echo (new \app\models\RegisterModel())->hasError('lastName') ? ' is-invalid' : ''; ?>"
                   id="exampleFormControlInput1"
                   placeholder="@maxMustermann"
                   name="userName">
            <div class="invalid-feedback">
                <?php echo (new \app\models\RegisterModel())->getFirstError('userName') ?>
            </div>
        </div>
        <div class="mb-1">
            <?php if(!empty($UserNameError)){echo $UserNameError."<br><br>";} ?>
        </div>
        <div class="mb-3 form-group">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email"
                   class="form-control <?php echo (new \app\models\RegisterModel())->hasError('email') ? ' is-invalid' : ''; ?>"
                   id="exampleInputEmail1"
                   aria-describedby="emailHelp"
                   placeholder="Enter email"
                   name="email">
            <div class="invalid-feedback">
                <?php echo (new \app\models\RegisterModel())->getFirstError('email') ?>
            </div>
        </div>
        <div class="mb-1">
            <?php if(!empty($EmailError)){echo $EmailError."<br><br>";} ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password"
                   class="form-control <?php echo (new \app\models\RegisterModel())->hasError('password') ? ' is-invalid' : ''; ?>"
                   id="exampleFormControlInput1"
                   placeholder="Password"
                   name="password">
            <div class="invalid-feedback">
                <?php echo (new \app\models\RegisterModel())->getFirstError('email') ?>
            </div>
        </div>
        <div class="mb-1">
            <?php if(!empty($PswdError)){echo $PswdError."<br><br>";} ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password Confirmation</label>
            <input type="password"
                   class="form-control <?php echo (new \app\models\RegisterModel())->hasError('passwordConfirm') ? ' is-invalid' : ''; ?>"
                   id="exampleFormControlInput1"
                   placeholder="Password Confirmation"
                   name="passwordConfirm">
            <div class="invalid-feedback">
                <?php echo (new \app\models\RegisterModel())->getFirstError('passwordConfirm') ?>
            </div>
        </div>
        <div class="mb-1">
            <p class="notify"> <?php if(!empty($PswdConfirmError)){echo $PswdConfirmError."<br><br>";} ?> </p>
        </div>
        <button class="col-1 btn btn-outline-primary"
                type="submit"
                name="register"
                style="margin-bottom: 20px">
            Register
        </button>
    </form>
</div>

    */
?>