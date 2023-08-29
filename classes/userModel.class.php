<?php
require_once 'classes/db.class.php';

class UserModel extends Db
{

    # Insert user data into database

    public function insertUser($fname, $lname, $email, $phoneNo)
    {

        $sql = 'INSERT INTO users(first_name , last_name, email, phone_no) VALUES (:fname,:lname,:email,:phoneNo)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([

            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'phoneNo' => $phoneNo


        ]);
        return true;

    }

    # Fetch all users from database

    public function read()
    {

        $sql = 'SELECT * FROM users ORDER BY id DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    }


    # Fetch single user by id from database

    public function readById($id)
    {

        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;

    }
    # Update single user
    public function update($id, $fname, $lname, $email, $phoneNo)
    {
        $sql = 'UPDATE users SET first_name = :fname , last_name = :lname, email = :email, phone_no = :phoneNo WHERE id = :id ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([

            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'phoneNo' => $phoneNo,
            'id' => $id


        ]);
        return true;
    }


    # Delete user from database

    public function delete($id){
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }


}




?>