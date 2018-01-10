<?php
require_once("Rest.inc.php");
date_default_timezone_set('asia/kolkata');
ini_set("expose_php",0);
class API extends REST {

    public $data = "";
    
    const DB_SERVER = "localhost";
    const DB_USER = "root"; 
    const DB_PASSWORD = "";
    const DB = "gallery";
	
	
   private $db = NULL;
    public function __construct() {
    parent::__construct();  // Init parent constructor
    $this->dbConnect();    // Initiate Database connection     
    }

    public function __destruct() {
    $this->db = NULL;
    }
    
    private function dbConnect() {
        // Set up the database
        try {            
            $this->db = new PDO('mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB, self::DB_USER, self::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
           /* $error = array('Type' => 'Error', "Error" => 'Some Error From Server', 'Responce' => "");
            $this->response($this->json($error), 251);*/
        }
    }
     /*
     * Public method for access api.
     * This method dynmically call the method based on the query string
     *
     */
    public function processApi(){
		$func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
		if ((int) method_exists($this, $func) > 0){
		$this->$func();
			   }
		else{
		$this->response('', 404);  
		//If the method not exist with in this class, response would be "Page not found".
			}	
        //,Jr@qc5#,5&C
    }
//-- DSU MENARIA DEVELOPED APIS


	public function login() 
	{
		global $link;
		include_once("common/global.inc.php");
		if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
        $username=$this->_request['username'];
		$password=$this->_request['password'];
		$newpassword=md5($password);
		
 		$sql = $this->db->prepare("SELECT * FROM admin_login WHERE user_name='".$username."' AND password='".$newpassword."'");
		$sql->execute();
			if($sql->rowCount()>0)
			{
				$row_login = $sql->fetch(PDO::FETCH_ASSOC);
 				$result = array('id' => $row_login['id'],
					'name' => $row_login['name'],
					'username' => $row_login['user_name'],
					'mobile_no' => $row_login['mobile_no'],
					'role_id' => $row_login['role_id'],
  				);
				$success = array('status'=> true, "Error" => "login successful",'login' => $result  );
				$this->response($this->json($success), 200);
			}    
			else
			{
				$error = array('status' => false, "Error" => "Try again",'Responce' => '');
				$this->response($this->json($error), 200);
			}
		
 	}
	
	public function CategoryList() 
	{
		global $link;
		include_once("common/global.inc.php");
		if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
		$sql_fetch = $this->db->prepare("SELECT * FROM master_category order by `id` ASC");
		$sql_fetch->execute();
		 if ($sql_fetch->rowCount() != 0) {  
			$x=0;   
			while($row_gp = $sql_fetch->fetch(PDO::FETCH_ASSOC)){
				foreach($row_gp as $key=>$valye)	
				{
					$string_insert[$x][$key]=$row_gp[$key];
				}
				$x++;
			}
			$success = array('status' => true , "Error" => '', 'Responce' => $string_insert);
			$this->response($this->json($success), 200);
		} 
		else {
			
			$error = array('status' => false , "Error" => "No data found", 'Responce' => '');
			$this->response($this->json($error), 200);
		}	
	}
	
	public function GalleryList() 
	{
		global $link;
		include_once("common/global.inc.php");
		if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
		$category_id=$this->_request['category_id'];
		$sql_fetch = $this->db->prepare("SELECT * FROM gallery_photos where `category_id`='$category_id' order by `id` DESC");
		$sql_fetch->execute();
		 if ($sql_fetch->rowCount() != 0) {  
			$x=0;   
			while($row_gp = $sql_fetch->fetch(PDO::FETCH_ASSOC)){
				$file_name=$row_gp['file_name'];
				
				foreach($row_gp as $key=>$valye)	
				{
					$string_insert[$x][$key]=$row_gp[$key];
					if(!empty($file_name))
					{
						$FilePath = $site_url.$file_name;
						$string_insert[$x]['image_fullpath']=$FilePath;
					}
				}
				$x++;
			}
			 
			$success = array('status' => true , "Error" => '', 'Responce' => $string_insert);
			$this->response($this->json($success), 200);
		} 
		else {
			
			$error = array('status' => false , "Error" => "No data found", 'Responce' => '');
			$this->response($this->json($error), 200);
		}	
	}







//-- DSU MENARIA DEVELOPED APIS
    private function json($data) {

        if (is_array($data)) {
         
            return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP );
        }
    }
}
$api = new API;
$api->processApi();
?>