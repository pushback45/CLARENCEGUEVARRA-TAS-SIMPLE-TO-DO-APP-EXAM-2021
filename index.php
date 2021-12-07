  <?php
        // connect to database
        $conn = mysqli_connect('localhost', 'root', '123','todoapp');
        // Insert data 
        if (isset($_POST['submitted'])) {
            $taskname = $_POST['taskadd'];

            $result = mysqli_query($conn,"SELECT * FROM tasks WHERE task= '$taskname' ");
            $count = mysqli_num_rows($result);
            if($count>0){
                echo "<script>alert('Task already exist')</script>";
            }
            else if($count == 0){

            mysqli_query($conn, "INSERT INTO tasks (task,owner,stat_of_task)VALUES ('$taskname', 'Clarence Guevarra', 'In Progress')");
            header('location: index.php');
        }
    }
        // Delete Data
         if(isset($_GET['deletetask'])){
             $id = $_GET['deletetask'];
            mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
            header('location: index.php');
        }
        // Update Data
          if(isset($_GET['finishtask'])){
             $id = $_GET['finishtask'];
            mysqli_query($conn, "UPDATE tasks SET stat_of_task='Completed' WHERE id=$id");
            header('location: index.php');
        }

        $tasks = mysqli_query($conn,"SELECT * FROM tasks");     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo Task</title>
    <link rel="stylesheet" href="./css/style.css">    
</head>

<body>
    <header>ToDoTask Application</header>
       <form method="POST" action="index.php" class="todo">
         <input type="text" name="taskadd" class="inputtask" placeholder="Input Task" required>
         <button type="submit" class="taskadded" name="submitted">Add Task</button>
       </form>
       <table>
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Task</th>
                   <th>Date Created</th>
                   <th>Owner</th>
                   <th>Status of the Task</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
            <?php while($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                   <td><?php echo $row['id']; ?></td>
                   <td><?php echo $row['task']; ?></td>
                   <td><?php echo $row['datecreated']; ?></td>
                   <td><?php echo $row['owner']; ?></td>
                   <td><?php echo $row['stat_of_task']; ?></td>
                   <td> 
                    <a href="index.php?finishtask=<?php echo $row['id'];?>"
                      class = "btn-update">Finish</a>
                     <a href="index.php?deletetask=<?php echo $row['id'];?>"
                      class = "btn-delete">Delete</a>
                  </td>
               </tr>
            <?php } ?>             
           </tbody>
       </table>
       

</body>
</html>