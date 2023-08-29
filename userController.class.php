<?php
require_once 'classes/userModel.class.php';
require_once 'classes/util.class.php';

$model = new UserModel;
$util = new Util;

# Handle add new user AJAX Request

if (isset($_POST['add'])) {

    $fname = $util->testInput($_POST['fname']);
    $lname = $util->testInput($_POST['lname']);
    $email = $util->testInput($_POST['email']);
    $phoneNo = $util->testInput($_POST['phone']);

    if ($model->insertUser($fname, $lname, $email, $phoneNo)) {
        echo $util->showMessage('success', 'User inserted sucessfully');

    } else {
        echo $util->showMessage('danger', 'Something went wrong');
    }

}

# Handle fetch all users AJAX Request
if (isset($_GET['read'])) {
    $users = $model->read();
    $output = '';

    if ($users) {
        foreach ($users as $row) {
            $output .= '			
            <tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["first_name"] . '</td>
            <td>' . $row["last_name"] . '</td>
            <td>' . $row["email"] . '</td>
            <td>' . $row["phone_no"] . '</td>
           
            
        <td>
            <a href="#"  id="' . $row["id"] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink"  data-target="#editNewUserModal" data-toggle="modal">Edit</a>
            <a href="#" id="' . $row["id"] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
        </td>
        </tr>';

        }
        echo $output;

    } else {
        '<tr>
        <td colspan="6">No Users Found in the Database</td>
        </tr>';

    }

}

# Handle edit user AJAX Request
if(isset($_GET['edit'])){
    $id = $_GET['id'];

    $user = $model->readById($id);
    echo json_encode($user);
}

# Handle update user AJAX Request

if(isset($_POST['update'])){
    $id = $util->testInput($_POST['id']);
    $fname = $util->testInput($_POST['fname']);
    $lname = $util->testInput($_POST['lname']);
    $email = $util->testInput($_POST['email']);
    $phoneNo = $util->testInput($_POST['phone']);

    if($model->update($id, $fname, $lname, $email, $phoneNo)){
        echo $util->showMessage('success' , 'User updated successfully!');

    }else{
        echo $util->showMessage('danger' , 'Something went wrong!');
    }

}

# Handle delete user AJAX Request

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    if($model->delete($id)){
        echo $util->showMessage('info','User deleted successfully!');
    }else{
        echo $util->showMessage('danger','Something went wrong!');
    }

}


?>