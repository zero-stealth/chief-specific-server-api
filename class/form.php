<?php


class Report
{
    // connection
    private $conn;
    // table name  
    private $db_table = "report";
    // column data
    public $id;
    public $query;
    public $report_type;
    public $location;
    public $report_date;
    public $time_of_report;
    public $report_status;
    public $description;
    public $station;
    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_reports()
    {
        $sql_query = "SELECT id, report_type, location, report_date , time_of_report , report_status, description , station FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_report()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET report_type = :report_type, location = :location , report_status = :report_status, description = :description , station = :station ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->report_type = htmlspecialchars(strip_tags($this->report_type));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->report_status = htmlspecialchars(strip_tags($this->report_status));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->station = htmlspecialchars(strip_tags($this->station));

        // bind data
        $stmt->bindParam(":report_type", $this->report_type);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":report_status", $this->report_status);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":station", $this->station);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_report()
    {
        $sql_query = "SELECT id, report_type, location, report_date , time_of_report , report_status,description , station  FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->report_type = $data_row['report_type'];
        $this->location = $data_row['location'];
        $this->report_date = $data_row['report_date'];
        $this->time_of_report = $data_row['time_of_report'];
        $this->report_status = $data_row['report_status'];
        $this->description = $data_row['description'];
        $this->station = $data_row['station'];
    }

    //UPDATE DATA
    public function update_report()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET  report_type = :report_type, location = :location , report_status = :report_status, description = :description , station = :station WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->report_type = htmlspecialchars(strip_tags($this->report_type));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->report_status = htmlspecialchars(strip_tags($this->report_status));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->station = htmlspecialchars(strip_tags($this->station));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":report_type", $this->report_type);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":report_status", $this->report_status);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":station", $this->station);
        $stmt->bindParam(":id", $this->id);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // SEARCH PARAM
  public function search()
  {
      $sql_query = "SELECT report_type, location, report_date , time_of_report , report_status, description , station  FROM " . $this->db_table . " WHERE report_type = ?  ";
      $stmt = $this->conn->prepare($sql_query);
      $stmt->bindParam(1, $this->query);
      $stmt->execute();
      $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->report_type = $data_row['report_type'];
      $this->location = $data_row['location'];
      $this->report_date = $data_row['report_date'];
      $this->time_of_report = $data_row['time_of_report'];
      $this->report_status = $data_row['report_status'];
      $this->description = $data_row['description'];
      $this->station = $data_row['station'];
  }



    //DELETE DATA
    function delete_report()
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




class Missing
{
    // connection
    private $conn;
    // table name  
    private $db_table = "missing";
    // column data
    public $id;
    public $first_name;
    public $last_name;
    public $last_seen;
    public $date_reported;
    public $description;

    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_missing_persons()
    {
        $sql_query = "SELECT id, first_name, last_name , last_seen , date_reported , description FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_missing_person()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET first_name = :first_name, last_name = :last_name , last_seen = :last_seen ,  description = :description ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->last_seen = htmlspecialchars(strip_tags($this->last_seen));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // bind data
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":last_seen", $this->last_seen);
        $stmt->bindParam(":description", $this->description);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_missing_person()
    {
        $sql_query = "SELECT id,  first_name, last_name , last_seen , date_reported , description FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->first_name = $data_row['first_name'];
        $this->last_name = $data_row['last_name'];
        $this->last_seen = $data_row['last_seen'];
        $this->date_reported = $data_row['date_reported'];
        $this->description = $data_row['description'];
    
    }

    //UPDATE DATA
    public function update_missing_person()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET  first_name = :first_name, last_name = :last_name , last_seen = :last_seen , date_reported = :date_reported , description = :description  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->firstname = htmlspecialchars(strip_tags($this->first_name));
        $this->secondname = htmlspecialchars(strip_tags($this->last_name));
        $this->last_seen = htmlspecialchars(strip_tags($this->last_seen));
        $this->date_reported = htmlspecialchars(strip_tags($this->date_reported));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":firstname", $this->first_name);
        $stmt->bindParam(":secondname", $this->last_name);
        $stmt->bindParam(":last_seen", $this->last_seen);
        $stmt->bindParam(":date_reported", $this->date_reported);
        $stmt->bindParam(":description", $this->description);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_missing_person()
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


class Complain
{
    // connection
    private $conn;
    // table name  
    private $db_table = "complains";
    // column data
    public $id;
    public $username;
    public $complain;
    public $location;

    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_complains()
    {
        $sql_query = "SELECT id, username, complain , location FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_complain()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET  username = :username , complain = :complain , location = :location";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->complain = htmlspecialchars(strip_tags($this->complain));
        $this->location = htmlspecialchars(strip_tags($this->location));


        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":complain", $this->complain);
        $stmt->bindParam(":location", $this->location);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_complain()
    {
        $sql_query = "SELECT id, username, complain , location FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $data_row['username'];
        $this->complain = $data_row['complain'];
        $this->location = $data_row['location'];
    }

    //UPDATE DATA
    public function update_complain()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET username = :username , complain = :complain , location = :location  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->complain = htmlspecialchars(strip_tags($this->complain));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":complain", $this->complain);
        $stmt->bindParam(":location", $this->location);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_complain()
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

class ChatSender
{
    // connection
    private $conn;
    // table name  
    private $db_table = "chat_sender";
    // column data
    public $id;
    public $username;
    public $message;
    public $account_type;
    public $time_sent;

    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_chats()
    {
        $sql_query = "SELECT id, username, message, account_type , time_sent FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_chat()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET username = :username, message = :message , account_type = :account_type , time_sent = :time_sent ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->account_type = htmlspecialchars(strip_tags($this->account_type));
        $this->time_sent = htmlspecialchars(strip_tags($this->time_sent));

        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":account_type", $this->account_type);
        $stmt->bindParam(":time_sent", $this->time_sent);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_chat()
    {
        $sql_query = "SELECT id, username, message, account_type , time_sent FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $data_row['username'];
        $this->message = $data_row['message'];
        $this->account_type = $data_row['account_type'];
        $this->time_sent = $data_row['time_sent'];
    }

    //UPDATE DATA
    public function update_chat()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET username = :username, message = :message , account_type = :account_type  , time_sent = :time_sent  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->account_type = htmlspecialchars(strip_tags($this->account_type));
        $this->time_sent = htmlspecialchars(strip_tags($this->time_sent));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":account_type", $this->account_type);
        $stmt->bindParam(":time_sent", $this->time_sent);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_chat()
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

class ChatReciever
{
    // connection
    private $conn;
    // table name  
    private $db_table = "chat_reciever";
    // column data
    public $id;
    public $username;
    public $message;
    public $account_type;
    public $time_sent;

    //db connection

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //GET ALL DATA
    public function get_chats()
    {
        $sql_query = "SELECT id, username, message, account_type , time_sent FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt;
    }

    //CREATE DATA
    public function create_chat()
    {
        $sql_query = "INSERT INTO " . $this->db_table . " SET username = :username, message = :message , account_type = :account_type , time_sent = :time_sent ";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize 
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->account_type = htmlspecialchars(strip_tags($this->account_type));
        $this->time_sent = htmlspecialchars(strip_tags($this->time_sent));

        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":account_type", $this->account_type);
        $stmt->bindParam(":time_sent", $this->time_sent);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        };
    }


    //GET SINGLE DATA
    public function get_chat()
    {
        $sql_query = "SELECT id, username, message, account_type , time_sent FROM " . $this->db_table . " WHERE id = ? LIMIT 0,1 ";
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $data_row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $data_row['username'];
        $this->message = $data_row['message'];
        $this->account_type = $data_row['account_type'];
        $this->time_sent = $data_row['time_sent'];
    }

    //UPDATE DATA
    public function update_chat()
    {
        $sql_query = "UPDATE " . $this->db_table . " SET username = :username, message = :message , account_type = :account_type  , time_sent = :time_sent  WHERE id = :id";
        $stmt = $this->conn->prepare($sql_query);

        //sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->account_type = htmlspecialchars(strip_tags($this->account_type));
        $this->time_sent = htmlspecialchars(strip_tags($this->time_sent));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":account_type", $this->account_type);
        $stmt->bindParam(":time_sent", $this->time_sent);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //DELETE DATA
    function delete_chat()
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
