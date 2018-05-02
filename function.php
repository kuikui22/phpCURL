<?php
	require('./connection.php');

	/**
	 *
	 * �^������API���,�ê����g�J��Ʈw
	 *
	 **/
	function TakeAPIWeb() {
		$curl_handle = curl_init();
		$url = 'http://jsonplaceholder.typicode.com/users';
		
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		
		$buff = curl_exec($curl_handle);
		
		curl_close($curl_handle);
		
		if(empty($buff)) {
			echo "�����L�^��!";
		}else {
			$result = json_decode($buff);
			$tot_data = Count_table();
			
			//�p�G��Ʈw���S����ƫh�q����API���X
			if($tot_data <= 0) {
				InsterDB($result);
			}
		}
	}
	
	
	/**
	 *
	 * �p���Ʈw���H�x�s����Ƶ���
	 * @return(int) ��Ƶ����`�p
	 *
	 **/
	function Count_table() {
		global $pdo;
		$table_name = 'user';
		$sql = 'SELECT COUNT(*) FROM ' . $table_name;			   
		$sqlResult = $pdo -> prepare($sql);
		$sqlResult -> execute();
		$tot_rows = $sqlResult -> fetchColumn();
		return $tot_rows;
	}
	

	/**
	 *
	 * �N�����API�g�J��Ʈw
	 * @param(stdClass) $result
	 *
	 **/
	function InsterDB($result) {
		global $pdo;
		$table_name = 'user';	
		$sql = 'INSERT INTO ' . $table_name . '(name, username, email)' .
			   'VALUES (:name, :username, :email)';			   
		$sqlResult = $pdo -> prepare($sql);
		$tot = count((array)$result);	
		
		for($i = 0; $i < $tot; $i++) {
			$sqlResult -> execute(array(
				'name' => $result[$i] -> name,
				'username' => $result[$i] -> username,
				'email' => $result[$i] -> email
			));
		}
	}
	
	/**
	 * �q��Ʈw���X���
	 * @return array ��Ʈw���
	 **/
	function TakeDBData() {
		global $pdo;
		$table_name = 'user';	
		$sql = 'SELECT * FROM ' . $table_name . ' ORDER BY id ASC';
		$sqlResult = $pdo -> prepare($sql);
		$sqlResult -> execute();
		$data_result = $sqlResult -> fetchAll(PDO::FETCH_ASSOC);

		return $data_result;
	}
	
	