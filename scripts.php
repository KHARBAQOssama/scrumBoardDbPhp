<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    

    function getTasks($x)
    {   
        global $conn;
        //CODE HERE
        //SQL SELECT
        $sql = "SELECT t.id, t.title, types.name AS taskType, priorities.name AS taskPriority, statuses.name AS taskStatus, t.task_datetime,t.description FROM tasks t INNER JOIN types ON t.type_id = types.id INNER JOIN priorities ON t.priority_id = priorities.id INNER JOIN statuses ON t.status_id = statuses.id;";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)){
            if($row['taskStatus'] == $x){
            ?>
            
            <button class="border-0 w-100 rounded mb-2 shadow-sm d-flex text-start align-items-center">
                				<div class="editD">
									<i class="bi bi-trash mt-2" ></i>
									<i class="bi bi-pencil-square"  data-bs-toggle="modal" href="#modal-task" mt-1" href="#"></i>
								</div> 
								 <div class="" style="width: 10%;">
									<i class="bi bi-exclamation fw-bold fs-15px"></i> 
								</div>
                				<div class="d-flex justify-content-between w-100"> 
                    				<div class="col-10 ">
								<div class="fw-bolder fs-6" style="text-overflow: ellipsis; overflow: hidden;  height: 1.8em; white-space: nowrap; max-width: 25ch;"><?php echo $row['title']?></div>
								<div class="fs-10px text-gray"><?php echo $row['task_datetime']?></div>
								<div class=" mb-1 fs-10px" title="<?php echo $row['description']?>" style="text-overflow: ellipsis; overflow: hidden; height: 1.5em; white-space: nowrap; max-width: 25ch;">
								<?php echo $row['description']?>
								</div>
								</div>
								<div class="col-2 d-flex justify-content-center flex-column">
								
										<span class="rounded text-center mb-1 fs-8px" style=""><?php echo $row['taskType']?></span>
										<span class=" text-center  fs-8px " style="border: 1px solid rgb(0,0,0); border-radius: 4px;"><?php echo $row['taskPriority']?></span>
								</div>
								</div>
            				</button>
            <?php
             }
         }
    }


    function saveTask()
    {
        global $conn;
        //CODE HERE
        $title = $_POST['title'];
        $type = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        
        //SQL INSERT
        $sql = "INSERT INTO `tasks` (`title`,`type_id`,`priority_id`,`status_id`,`task_datetime`,`description`) VALUES ('$title','$type','$priority','$status','$date','$description')";

        $result = mysqli_query($conn ,$sql);

        if($result){
            $_SESSION['message'] = "Task has been added successfully !";
		    header('location: index.php');
        }
        
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }
    // getTasks();
