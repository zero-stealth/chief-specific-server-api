<?php

class Chief
{
    // connection
    private $conn;
    // table name  
    private $db_table = "chief";
    // column data
    public $id;
    public $user_name;
    public $first_name;
    public $last_name;
    public $email;
    public $gender;
    public $date_of_birth;
    public $phone_no;
    public $service_no;
    public $location;
    public $rank;
    public $about;
    public $date_of_join;
    public $status_id;


    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_chiefs()
    {
        $sql_query = "SELECT id, user_name , first_name, last_name, email , gender , date_of_birth , phone_no, service_no , location ,  rank ,  about , date_of_join , status_id FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_chief()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET user_name = :user_name , first_name = :first_name, last_name = :last_name , email = :email, gender = :gender , date_of_birth = :date_of_birth , phone_no = :phone_no , service_no = :service_no , location = :location , rank = :rank, about = :about , date_of_join = :date_of_join, status_id = :status_id ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->rank = htmlspecialchars(strip_tags($this->rank));
        $this->about = htmlspecialchars(strip_tags($this->about));
        $this->date_of_join = htmlspecialchars(strip_tags($this->date_of_join));
        $this->status_id = htmlspecialchars(strip_tags($this->status_id));




        // bind data
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":phone_no", $this->phone_no);
        $stmt->bindParam(":service_no", $this->service_no);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":rank", $this->rank);
        $stmt->bindParam(":about", $this->about);
        $stmt->bindParam(":date_of_join", $this->date_of_join);
        $stmt->bindParam(":status_id", $this->status_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_chief()
    {
        $sql_query = "SELECT id, user_name , first_name, last_name, email , gender , date_of_birth , phone_no, service_no , location ,  rank ,  about , date_of_join , status_id FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
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
        $this->phone_no = $data_row['phone_no'];
        $this->service_no = $data_row['service_no'];
        $this->location = $data_row['location'];
        $this->rank = $data_row['rank'];
        $this->about = $data_row['about'];
        $this->date_of_join = $data_row['date_of_join'];
        $this->status_id = $data_row['status_id'];
    }

    //UPDATE DATA
    public function update_chief()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET first_name = :first_name, last_name = :last_name , email = :email, gender = :gender , date_of_birth = :date_of_birth , phone_no = :phone_no , service_no = :service_no , location = :location, rank = :rank, about = :about , date_of_join = :date_of_join, status_id = :status_id  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->phone_no = htmlspecialchars(strip_tags($this->phone_no));
        $this->service_no = htmlspecialchars(strip_tags($this->service_no));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->rank = htmlspecialchars(strip_tags($this->rank));
        $this->about = htmlspecialchars(strip_tags($this->about));
        $this->date_of_join = htmlspecialchars(strip_tags($this->date_of_join));
        $this->status_id = htmlspecialchars(strip_tags($this->status_id));

        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":phone_no", $this->phone_no);
        $stmt->bindParam(":service_no", $this->service_no);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":rank", $this->rank);
        $stmt->bindParam(":about", $this->about);
        $stmt->bindParam(":date_of_join", $this->date_of_join);
        $stmt->bindParam(":status_id", $this->status_id);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_chief()
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


class Alert
{
    // connection
    private $conn;
    // table name  
    private $db_table = "alert";
    // column data
    public $id;
    public $title;
    public $alert_type;
    public $message;

    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_alerts()
    {
        $sql_query = "SELECT id, title, alert_type , message FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_alert()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET title = :title, alert_type = :alert_type , message = :message ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->alert_type = htmlspecialchars(strip_tags($this->alert_type));
        $this->message = htmlspecialchars(strip_tags($this->message));


        // bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":alert_type", $this->alert_type);
        $stmt->bindParam(":message", $this->message);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_alert()
    {
        $sql_query = "SELECT  id, title, alert_type , message  FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $data_row['id'];
        $this->title = $data_row['title'];
        $this->alert_type = $data_row['alert_type'];
        $this->message = $data_row['message'];
    
    }

    //UPDATE DATA
    public function update_alert()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET title = :title , alert_type = :alert_type , message = :message   WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->alert_type = htmlspecialchars(strip_tags($this->alert_type));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":alert_type", $this->alert_type);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_alert()
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
    