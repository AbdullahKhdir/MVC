
<?php
/*
<div class="container-sm">
    <?php $form = \app\Core\form\Form::begin("", "post"); ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "firstName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "lastName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "userName") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "email") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "password") ?>
    <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "passwordConfirm") ?>
    <button class="btn btn-outline-primary" type="submit" name="register" style="margin-bottom: 20px"> Register </button>
    <?php \app\Core\form\Form::end(); ?>
</div>
*/?>

   <div class="container-sm">
    <form action="" method="post">
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

