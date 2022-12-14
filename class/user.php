<?php

class User
{
    // connection
    private $conn;
    // table name  
    private $db_table = "users";
    // column data
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $gender;
    public $date_of_birth;
    public $residence;
    public $phone_no;
    public $id_number;
    public $marital_status;
    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_users()
    {
        $sql_query = "SELECT id , user_name , first_name, last_name, email , gender , date_of_birth , residence , phone_no , id_number ,  marital_status FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_user()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET user_name =:user_name , first_name = :first_name, last_name = :last_name , email = :email, gender = :gender , date_of_birth = :date_of_birth , residence = :residence , phone_no = :phone_no  , id_number = :id_number,  marital_status = :marital_status ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->residence = htmlspecialchars(strip_tags($this->residence));
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->id_number = htmlspecialchars(strip_tags($this->id_number));
        $this->marital_status = htmlspecialchars(strip_tags($this->marital_status));

        // bind data
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":residence", $this->residence);
        $stmt->bindParam(":phone_no", $this->phone_no);
        $stmt->bindParam(":id_number", $this->id_number);
        $stmt->bindParam(":marital_status", $this->marital_status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_user()
    {
        $sql_query = "SELECT id, user_name , first_name, last_name, email , gender , date_of_birth , residence , phone_no , id_number ,  marital_status FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->user_name = $data_row['user_name'];
        $this->first_name = $data_row['first_name'];
        $this->last_name = $data_row['last_name'];
        $this->email = $data_row['email'];
        $this->gender = $data_row['gender'];
        $this->date_of_birth = $data_row['date_of_birth'];
        $this->residence = $data_row['residence'];
        $this->phone_no = $data_row['phone_no'];
        $this->id_number = $data_row['id_number'];
        $this->marital_status = $data_row['marital_status'];
    }

    //UPDATE DATA
    public function update_user()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET  first_name = :first_name, last_name = :last_name , email = :email, gender = :gender , date_of_birth = :date_of_birth , residence = :residence , phone_no = :phone_no  , id_number = :id_number,  marital_status = :marital_status  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->residence = htmlspecialchars(strip_tags($this->residence));
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->id_number = htmlspecialchars(strip_tags($this->id_number));
        $this->marital_status = htmlspecialchars(strip_tags($this->marital_status));
        $this->id=htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":residence", $this->residence);
        $stmt->bindParam(":phone_no", $this->phone_no);
        $stmt->bindParam(":id_number", $this->id_number);
        $stmt->bindParam(":marital_status", $this->marital_status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_user()
    {
        $sql_query = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize param
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind param value
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
