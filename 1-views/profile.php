<?php include __DIR__."/styles/index.php";?>
<div style="width: 50%;" class="container main0" style="text-align: center">
    <div class="container mb-3 main">
        <div class="mb-3">
            <img class="img"
                 style="width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        object-fit: cover;
                        object-position: center right;"
                 src="https://t4.ftcdn.net/jpg/04/10/43/77/360_F_410437733_hdq4Q3QOH9uwh0mcqAhRFzOKfrCR24Ta.jpg" /><br>
            <div class="m-5">
                <label for="exampleFormControlInput1" class="form-label w-50"><?php echo $Name ?? "";?></label><br><br>
                <?php \app\Core\form\Form::begin("", "POST", "", "multipart/form-data"); ?>
                <input type="file" name="ProfilePicture" class="btn btn-primary" >Change Profile Picture
                <button type="submit" name="btnProfilePicture">Upload</button>
                <button type="submit" class="btn btn-outline-primary" name="resetPic">Reset Profile Picture</button>
                <?php \app\Core\form\Form::end();?>
            </div>
        </div>
            <?php \app\Core\form\Form::begin("", "POST", ""); ?>
        <div>
            <div id="accordion" class="d-flex justify-content-sm-center">
                <h4 class="panel-title" style="display: block">
                    <a style="color: #007bff;" class="accordion-toggle card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Edit Personal Data
                    </a>
                </h4>
            </div>
            <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "firstName") ?>
            <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "lastName") ?>
        </div>
        <hr class="hr">
        <div>
            <div id="accordion" class="d-flex justify-content-sm-center">
                <h4 class="panel-title" style="display: block">
                    <a  style="color: #007bff;" class="accordion-toggle card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Edit Account Settings
                    </a>
                </h4>
            </div>
                <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "email") ?>
                <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "userName") ?>
                <?php echo \app\Core\form\Form::field((new \app\models\RegisterModel()), "password") ?>
            <?php \app\Core\form\Form::end();?>
            <hr class="hr">
        </div>
    </div>
</div>


<?php /*


<div style="width: 50%;" class="container main0" style="text-align: center">
    <div class="container mb-3 main">
        <div class="mb-3">
            <img class="img"
                 style="width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        object-fit: cover;
                        object-position: center right;"
                 src="https://t4.ftcdn.net/jpg/04/10/43/77/360_F_410437733_hdq4Q3QOH9uwh0mcqAhRFzOKfrCR24Ta.jpg"/><br>
            <div class="m-5">
                <label for="exampleFormControlInput1" class="form-label w-50"><?php echo $firstName ?? "";?></label><br><br>
                <button class="btn btn-primary" >Change Profile Picture</button>
                <button class="btn btn-outline-primary">Reset Profile Picture</button>
            </div>
        </div>


        <form action="" method="post" onsubmit="">
            <div>
                <div id="accordion" class="d-flex justify-content-sm-center">
                    <h4 class="panel-title" style="display: block">
                        <a  style="color: #007bff;" class="accordion-toggle card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Edit Personal Data
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" style="text-align: center">
                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                        <label class="d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">First Name</label>
                        <div class="d-flex justify-content-sm-start">
                            <input type="text" class="form-control w-50" value="<?php echo $firstName?>" name="fName" required>
                        </div>
                        <div class="invalid-feedback">
                            This field is required!
                        </div>
                        <div class="d-flex justify-content-sm-end">
                            <button  class="btn btn-sm btn-outline-primary">Change First Name</button>
                        </div>
                    </div>
                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                        <label class="d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">Last Name</label>
                        <div class="d-flex justify-content-sm-start">
                            <input type="text" class="form-control w-50" value="<?php echo $lastName?>" name="lName" required>
                        </div>
                        <div class="invalid-feedback">
                            This field is required!
                        </div>
                        <div class="d-flex justify-content-sm-end">
                            <button class="btn btn-sm btn-outline-primary">Change Last Name</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hr">
        </form>




        <form action="" method="post" onsubmit="">
            <div>
                <div id="accordion" class="d-flex justify-content-sm-center">
                    <h4 class="panel-title" style="display: block">
                        <a  style="color: #007bff;" class="accordion-toggle card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTow">
                            Edit Account Settings
                        </a>
                    </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" style="text-align: center">
                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                        <label class="d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">Email</label>
                        <div class="d-flex justify-content-sm-start">
                            <input type="email" class="form-control w-50" value="<?php echo $email?>" name="EmailProfile" required>
                        </div>
                        <div class="d-flex justify-content-sm-end">
                            <button  class="btn btn-sm btn-outline-primary">Submit</button>
                        </div>
                    </div>
                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                        <label class="d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">Username</label>
                        <div class="d-flex justify-content-sm-start">
                            <input type="text" class="form-control w-50" value="<?php echo str_replace("@","", $userName);?>" name="username" required>
                        </div>
                        <div class="d-flex justify-content-sm-end">
                            <button class="btn btn-sm btn-outline-primary">Submit</button>
                        </div>
                    </div>
                    <div class="mb-3" style="border: solid .5px #cdd;padding: 10px;">
                        <label class="form-label d-flex justify-content-sm-start mb-1" for="exampleFormControlInput1" class="form-label w-50">Password</label>
                        <div>
                            <div class="d-flex justify-content-sm-start">
                                <input class="form-control" type="password" class="form-control w-50" value="********" name="pswd" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-sm-end">
                            <button class="btn btn-sm btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hr">
        </form>

    </div>
</div>

*/ ?>