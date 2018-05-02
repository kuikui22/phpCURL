<?php
	require('./connection.php');

	/**
	 *
	 * 擷取網頁API資料,並直接寫入資料庫
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
			echo "網站無回應!";
		}else {
			$result = json_decode($buff);
			$tot_data = Count_table();
			
			//如果資料庫內沒有資料則從網站API取出
			if($tot_data <= 0) {
				InsterDB($result);
			}
		}
	}
	
	
	/**
	 *
	 * 計算資料庫內以儲存的資料筆數
	 * @return(int) 資料筆數總計
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
	 * 將獲取的API寫入資料庫
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
	 * 從資料庫取出資料
	 * @return array 資料庫資料
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
	
	