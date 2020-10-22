<?php require_once('./views/includes/header.php');
    $formAction = new captureForm();
    $SaveForm = $formAction->saveForm();
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Complete the form below to continue</h2>
                    Click here to see all submissions <a href="./" class="btn btn-primary btn-sm">View submission</a>
            </div>
            <div class="col-md-3"></div>
        </div>
        <br>
        <div class="row">   
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php echo $SaveForm;?>
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Name<span>*</span></label>
                        <input type="text" name="userName" class="form-control" id="userName" required value="<?php echo $_POST['userName'];?>">
                        <span class="usernameMsg"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address<span>*</span></label>
                        <input type="email" class="form-control" name="email" id="userEmail" placeholder="Ex: james@company.com" required value="<?php echo $_POST['email'];?>">
                        <span class="emailMsg"></span>
                    </div>
                   
                    <div class="form-group"> 
                        <label for="mobile">Phone Number<span>*</span></label>
                        <input type="text" class="form-control" name="mobile" id="userMobile" required value="<?php echo $_POST['mobile'];?>">
                        <span class="mobileMsg"></span>
                    </div>
                    <div class="AddFields"></div>
                    Click 
                    <select class="form-field CustomFieldAdd" name="AccessChange">
                        <option>Select field</option>
                        <option value="Age">Age</option>
                        <option value="Nationality">Nationality</option>
                        <option value="Favourite Animal">Favourite Animal</option>
                        <option value="Current Car">Current Car</option>
                    </select>
                    to add fields or <span class="btn btn-custom" id='addCustomField'>+</span> to add custom plain field.
                    
                    <!-- Insetrtion to store Count of added Fields From Script -->
                    <input type="text" name="AdditionsFields" class='CountExtraFields' hidden>
                    <div class="form-group">
                    <br>
                        <input type="submit" class="btn btn-success pull-right" name="saveForm" id="submtForm" value="Submit">
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
<?php require_once('./views/includes/footer.php');?>