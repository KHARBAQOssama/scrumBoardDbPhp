<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();   
    

    // function to display data 
    function getTasks($x)
    {   
        
        global $conn;
        //SQL SELECT
        $sql = "SELECT t.id, t.title, types.name AS taskType, priorities.name AS taskPriority, priorities.id AS piD, t.status_id,  t.task_datetime,t.description FROM tasks t INNER JOIN types ON t.type_id = types.id INNER JOIN priorities ON t.priority_id = priorities.id INNER JOIN statuses ON t.status_id = statuses.id;";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['id'];
            $title = $row['title'];
            $taskType = $row['taskType'];
            $taskPriority = $row['taskPriority'];
            $priorityId = $row['piD'];
            $status = $row['status_id'];
            $date = $row['task_datetime'];
            $description = $row['description'];

            if($status == $x){
            ?>
            <form action="script.php" method="POST" class="border-bottom border-top w-100 bg-white rounded shadow-sm d-flex text-start align-items-center p-2">
								 <div class="" style="width: 10%;">
                                 <?php if($status == 1){
                                ?>
									<i class="bi bi-exclamation fw-bold fs-15px"></i> 
                                    <?php }if($status == 2){
                                ?>
                                    <i class="bi bi-hourglass-split fw-bold fs-15px"></i>
                                    <?php }if($status == 3){
                                ?>
                                    <i class="bi bi-check-all fw-bold fs-15px"></i>
                                    <?php }
                                ?>
								</div>
                				<div class="d-flex justify-content-between w-100"> 
                    			<div class="col-10 ">
                                        <input type="hidden" name="id" value="<?php echo $id?>">
                                        <div class="fw-bolder fs-6 mt-1" style="text-overflow: ellipsis; overflow: hidden;  height: 1.8em; white-space: nowrap; max-width: 25ch;"><?php echo $title?></div>

                                        <div class="fs-10px text-gray" >#<span><?php echo $id?></span> created in <?php echo $date?></div>

                                        <div class=" mb-1 fs-10px"  title="<?php echo $description?>" style="text-overflow: ellipsis; overflow: hidden; height: 1.5em; white-space: nowrap; max-width: 40ch;">
                                        <?php echo $description?>
                                        </div>
                                        </div>
                                <div>
                                    <div class="mb-2">
                                        <i class="bi bi-pencil-square text-primary" data-bs-toggle="modal" onclick="fullForm('<?= $id?>','<?= $title?>','<?= $taskType?>','<?=$priorityId?>','<?= $status?>','<?= $date?>','<?= $description?>')" data-bs-target="#modal-task"></i>
                                        <button name="delete" type="submit" class="fa fa-times btn btn-xs btn-icon btn-danger"></button>
                                    </div>
                                    <div class="col-2 d-flex w-100 justify-content-center flex-column my-1">
                                            <div class="rounded  text-center mb-1 fs-8px bg-dark text-light" style="padding : 2px;"  value="<?php echo $row['taskType']?>"><?php echo $row['taskType']?></div>
                                            <div class=" text-center  fs-8px" style="border: 1px solid rgb(0,0,0); border-radius: 4px;" value="<?php echo $row['taskPriority']?>"><?php echo $row['taskPriority']?></div>
                                    </div>
                                </div>
								</div>
            				</form> 
            <?php
             }
         }
    }


    // function to count how many tasks have the same status
    function counter($x){
        global $conn;
        $sql = "SELECT COUNT(*) FROM `tasks` WHERE `status_id` = '$x'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['COUNT(*)'];
    }

    // function to store to store data in the db from the form 
    function saveTask()
    {
        global $conn;
        //CODE HERE
        $title = $_POST['title'];
        $taskType = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        
        //SQL INSERT
        $sql = "INSERT INTO `tasks` (`title`,`type_id`,`priority_id`,`status_id`,`task_datetime`,`description`) VALUES ('$title','$taskType','$priority','$status','$date','$description')";

        $result = mysqli_query($conn ,$sql);

        if($result){
            $_SESSION['message'] = "Task has been added successfully !";
		    header('location: index.php');
        }
        
    }


    // ediit part 
    function updateTask()
    {
        global $conn;
        //CODE HERE
        // $taskId = $_POST[''];
        $title = $_POST['title'];
        $taskType = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $taskId = $_POST['idT'];
        //SQL UPDATE
        $sql = "UPDATE tasks SET title = '$title',type_id = '$taskType', priority_id= '$priority',status_id = '$status',task_datetime = '$date' ,description = '$description' WHERE id = '$taskId';";  
        
        $result = mysqli_query($conn, $sql);
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    // delete part 
    function deleteTask()
    {
        //CODE HERE
        global $conn;
        $taskId = $_POST['id'];
        //SQL DELETE
        $sql = "DELETE FROM `tasks` WHERE `id`='$taskId'";
        $result = mysqli_query($conn, $sql);
        
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }

