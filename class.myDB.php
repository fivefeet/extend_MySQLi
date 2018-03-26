<?php
/*
* extend_MySQLi - Used to extend MySQLi functions.
* Copyright (C) 2018  Christopher D TerVree
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
How to use:
// create the $db object
$db = new myDB($DBHost,$DBUser,$DBPass,$db_name);

$result_array = $db->fetch_array($sql);
*/

class myDB extends MySQLi {
	private $host = "localhost";
	private $db_name = "";
	private $username = "root";
	private $password = "";
	public $conn;
	
	public function __construct($host='',$username='',$password='',$db_name='') {
		$this->host = ($host == '') ? $this->host : $host;
		$this->username = ($username == '') ? $this->username : $username;
		$this->password = ($password == '') ? $this->password : $password;
		$this->db_name =($db_name == '') ? $this->db_name : $db_name;
		$this->connect_me();
		return;
	}
	
	private function connect_me() {
		$this->conn = null;
		$this->conn = $this->connect($this->host,$this->username,$this->password,$this->db_name);
		if( $this->connect_error )
			die($this->connect_error);
		return;
	}
	
	// returns all results as an array
	public function fetch_array($sql) {
		$result = $this->query($sql);
		if($this->error) {
			return $this->error;
		} else {
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			if (empty($data)) {
				return '';
			} else {
				return $data;
			}
		}
	}
	
	public function query_first($sql) {
		$result = $this->query($sql);
		if($this->error) {
			return $this->error;
		} else {
			$row = $result->fetch_assoc();
			return $row;
		}
	}
	
}
?>