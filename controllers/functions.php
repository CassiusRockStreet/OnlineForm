<?php  
    require_once('config.php');
    class captureForm{
        
        public $message,$emailSet;
        public $AgeSet,$nationSet,$FavAnimSet,$CarSet=0;
        public $ageSetter,$NationSetter,$FavAnimalSetter,$CurrentCarSetter;

        function saveForm(){

            if(isset($_POST['saveForm'])){
                $username = $_POST['userName'];
                $email = $_POST['email'];
                $phone = $_POST['mobile'];
                $this->emailSet = $email;
                $checkAdditions = $_POST['AdditionsFields'];

                //First check if either of the drop down additions are available
                if($_POST['Age']){
                        $Age = $_POST['Age'];
                        $this->AgeSet = 1;
                        $this->ageSetter = "age = '$Age'";
                    };

                if($_POST['Nationality'] && $_POST['Nationality'] !=""){
                    $Nationality = $_POST['Nationality'];
                    $this->nationSet = 1;
                    $this->NationSetter = "nationality ='$Nationality'";
                };
                if($_POST['Favoutiteanimal'] && $_POST['Favoutiteanimal'] !=""){
                    $FavAnimal = $_POST['Favoutiteanimal'];
                    $this->FavAnimSet = 1;
                    $this->FavAnimalSetter = "FavorAnimal ='$FavAnimal'";
                };
                if($_POST['currentcar'] && $_POST['currentcar'] != ""){
                    $CurrentCar = $_POST['currentcar'];
                    $this->CurrentCarSetter = "currentCar ='$CurrentCar'";
                    $this->CarSet = 1;
                };
                
                //Checking the mandatory fields incase Front end faild
                if(empty($username) || empty($email) || empty($phone)){
                   
                    $this->message = "<p class='alert alert-danger'>Please provide all required details</p>";
                
                }else{
                    //Validate username and matches only characters
                    if(!preg_match('/^[a-zA-Z]*$/',$username)){
                       
                        $this->message = "<p class='alert alert-danger'>Username requires only alphabets and no space</p>";
                    
                    }elseif(!preg_match('/^[0-9]*$/',$phone)){
                        // validateNumber Phones
                        $this->message = "<p class='alert alert-danger'>Phone number is invalid, please use numbers only</p>";
                    
                    }
                    elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email)){
                        //Now we validate email address type
                            $this->message = "<p class='alert alert-danger'>Email address is invalid</p>";
                    }else{
                        // All is done read to pass to DB
                        //Start by checking the user Details if exists... if yes Then update, Or we start a new Data from Fresh
                        $queryData = queryMysql("SELECT email FROM formdata WHERE email = '$email' ");
                        if($queryData->num_rows > 0){
                        
                            $UpdateData = queryMysql("UPDATE formdata SET username='$username',phone='$phone' WHERE email='$email'");
                        
                            if($UpdateData){
                        
                                $this->message = "<p class='alert alert-success'>Data succesffully updated</p>";
                                //Calling inscript updater for form fields
                                $this->setUpdates();
                        
                            }else{
                        
                                $this->message = "<p class='alert alert-danger'>An erro occured, try again later</p>";
                        
                            }
                        }else{
                        
                            $insertData = queryMysql("INSERT INTO formdata(username,email,phone) VALUES('$username','$email','$phone')");
                        
                            if($insertData){
                                //Calling inscript updater for form fields
                                $this->setUpdates();
                                $this->message = "<p class='alert alert-success'>Data succesffully captured</p>";
                        
                            }else{
                                $this->message = "<p class='alert alert-danger'>An erro occured, try again later</p>";
                            }
                        }

                        // Checking if we have additional Fields
                        if(!empty($checkAdditions) && $checkAdditions != ""){
                            
                            //Pulling out all Extra Columns
                            for($i=1;$i <= $checkAdditions; $i++){
                            
                                $postColum = $_POST['field_'.$i];
                                $postValue = $_POST['customfield_'.$i];
                            
                                if($this->alterDatabase($postColum)){
                                    //Here if the form column exist it is being added to the database using the alterDatabase function
                                }else if("exist"){
                                    $this->updateExtras($postColum,$postValue,$email);
                                }
                            }
                            
                        }

                    }
                }
            }
            return $this->message;
        }

        public function setUpdates(){
            /**
             * the follwoing scripts are called individual based on if its elemenst exist from the selection. 
             * Not all of these scripts get called only 1 or 2 of fre even all if all are a success, reason we check first
            */

            // Auto script updator for Age
            if($this->AgeSet == 1){
                queryMysql("UPDATE formdata set $this->ageSetter WHERE email='$this->emailSet'");
            }
            // Auto script updator for Nationality
            if($this->nationSet == 1){
                queryMysql("UPDATE formdata set $this->NationSetter WHERE email='$this->emailSet'");
            }
            // Auto script updator for Animal
            if($this->FavAnimSet == 1){
                queryMysql("UPDATE formdata set $this->FavAnimalSetter WHERE email='$this->emailSet'");
            }
            // Auto script updator for Current car
            if($this->CarSet == 1){
                queryMysql("UPDATE formdata set $this->CurrentCarSetter WHERE email='$this->emailSet'");
            }
        } 

        public function alterDatabase($column_Name){
            //First we check if Colum exist in curent database.table if not we go right ahead and add it with a default value of NULL
            $checkColumn = queryMysql("SHOW COLUMNS FROM formdata LIKE '$column_Name'");
            if(!$checkColumn->num_rows > 0){

                $AddColumn = queryMysql("ALTER TABLE formdata ADD $column_Name varchar(255) NULL DEFAULT NULL");
                ($AddColumn) ?  true : false;

            }
        } 

        public function updateExtras($column,$value,$emailAddress){
            // This is a dynamic script for updating all external additional fields with custom columns
            $update = queryMysql("UPDATE formdata SET $column='$value' WHERE email='$emailAddress'");
            if($update){
                return true;
            }else{
                return false;
            }
        }
    }  

    class pullRecords{
        //First Function here is to pull all existing columns inclduing those added dynamicaly and storring them in an array to use later
        function AllColumns(){
            $getData = queryMysql("SELECT * FROM formdata");
            $AllColumns = [];
            if(mysqli_num_fields($getData) > 0){
                
                while ($finfo = mysqli_fetch_field($getData)) {
                    $AllNames = $finfo->name;
                    array_push($AllColumns,$AllNames);
                }

            }
            return $AllColumns;
        }

        //Getting all the inputs from the database.table
        function getAllFrields(){
            $getInputs = queryMysql("SELECT * FROM formdata");
            if($getInputs->num_rows > 0){
                return mysqli_fetch_all($getInputs, MYSQLI_ASSOC);
            }
        }
    }
?>