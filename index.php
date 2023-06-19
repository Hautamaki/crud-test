<?php
require 'db_conn.php';
?>

<!-- THIS MIGHT HELP WITH THE UPDATE FUNCTION -->
<!-- https://www.youtube.com/watch?v=72U5Af8KUpA -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD test</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php
$list = $conn->query("SELECT * FROM list");
?>

<!-- HEADER -->
<header>



</header>
<!-- HEADER END -->

<!-- BODY -->
<body>

<!-- ADD NEW ITEM DIALOG -->
<dialog id="add-new-dialog">
    <h3>Add New Person</h3>
    <form action="app/create.php" method="POST" autocomplete="off">
    <input class="required-field" type="text" name="fname" placeholder="First Name">
    <input class="required-field" type="text" name="lname" placeholder="Last Name">
    <button type="submit">Add</button>
    <button formmethod="dialog">Cancel</button>
    </form>
</dialog>


<!-- EDIT ITEM DIALOG 2 -->
<dialog id="edit-dialog">
    <h3>Edit Person <?php echo $currentid ?></h3>
    <form action="app/update.php" method="POST" autocomplete="off">
    <input class="required-field" type="text" name="fname" placeholder="<?php echo $currentid ?>">
    <input class="required-field" type="text" name="lname" placeholder="<?php echo $currentid['lname'] ?>">
    <button type="submit">Save</button>
    <button formmethod="dialog">Cancel</button>
    </form>
</dialog>


<table>
    <tr>
        <th>ID#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th><a id="add-new-button" href="#">Add New</a></th>
    </tr>



<?php while($item = $list->fetch(PDO::FETCH_ASSOC)){ ?>

        <tr id="<?php echo $item['id'] ?>">
            <th><?php echo $item['id'] ?></th>
            <th><?php echo $item['fname'] ?></th>
            <th><?php echo $item['lname'] ?></th>
            <th><a class="edit-button" href="#" id="<?php echo $item['id'] ?>">Edit</a></th>
            <th><a class="remove-item" href="#" id="<?php echo $item['id'] ?>">Delete</a></th>
        </tr>

<?php } ?>

</table>

</body>
<!-- BODY END -->

<!-- FOOTER -->
<footer>
</footer>
<!-- FOOTER END -->

<script>
    // ADD NEW ITEM OPEN DIALOG
    const addNewButton = document.getElementById("add-new-button");
    const addNewDialog = document.getElementById("add-new-dialog");

    addNewButton.addEventListener("click", () => {
        addNewDialog.showModal();
    });

    // EDIT A TABLE ITEM
    const editDialog = document.getElementById("edit-dialog");


    $(".edit-button").click(function(e){
        const id = $(this).attr('id');
        //const id = $(this).attr('data-todo-id');
        
        $currentid = $(this).attr('id');

        editDialog.showModal();
                
        $.post('app/update.php', 
            {
                id: id
            },
            (data) => {
                if(data != 'error'){
  
                }
            }
        );
    });


    // DELETE A TABLE ITEM
    $('.remove-item').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/delete.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().parent().hide(300);
                         }
                      }
                );
    });


</script>