<?php
require_once('Connect.class.php');
class Manager extends Connect{

	//Inserir(INSERT INTO)
	public static function insert($table, $data){
		//INSERT INTO tb_x(c1, c2) 
		//VALUES('v1','v2');

		//chamar a conexão
		$pdo = parent::get_instance();

		//preparando colunas/campos
		$fields = implode(", ", array_keys($data));

		//preparando os valores
		$values = ":".implode(", :", array_keys($data));

		//iniciando query(consulta)
		$query = "INSERT INTO $table";
		$query .= "($fields) ";
		$query .= "VALUES($values);";

		//preparar envio da query
		$statement = $pdo->prepare($query);

		//validar campos
		foreach($data as $key=>$value){
			$value = filter_var($value);
			//substituir os :campos pelo valor
			// :name por Alessandro
			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}

		//concluir envio
		if($statement->execute()){
			//caso dê certo retorna o id.
			return $pdo->lastInsertId();
		}else{
			//caso dê errado.
			return false;
		}

	}//fim do insert()

	//Selecionar/Buscar(SELECT)
	public static function select($table, $fields, $filters, $query_extra =""){
		//criando o objeto pdo...
		$pdo = parent::get_instance();


		//preparando a query(consulta)
		$query = "SELECT ";
		if($fields != null){
			$query .= implode(", ", $fields);
		}else{
			$query .= "*";
		}
		$query .= " FROM $table";

		//Filtros(WHERE)
		if($filters != null){
			$query .= " WHERE ";
			foreach ($filters as $key => $value) {
				$query .= "$key=:$key AND ";
			}

			$query = substr($query, 0, -4);
		}

		//se a consulta precisar de algo mais..
		$query .= $query_extra;
		

			
		//preparando consulta
		$statement = $pdo->prepare($query);
		
		//substituindo os parametros pelos reais valores dos filtros, caso haja...
		if($filters != null){
			//filtrando valores para serem inseridos, tecnica segura para evitar SQL Injection...
			foreach ($filters as $key => $value) {
				$value = filter_var($value);

				$statement->bindValue(":$key", $value, PDO::PARAM_STR);
			}
		}

		//executando consulta
		$statement->execute();

		if($statement->rowCount()){
			return $statement->fetchAll();
		}else{
			return false;
		}

	}//fim do select()

	//Atualizar (UPDATE)
	public static function update($table, $data, $filters, $query_extra=""){
		//criando o objeto pdo...
		$pdo = parent::get_instance();

		//valores a serem atualizados
		$new_values = "";
		foreach ($data as $key => $value) {
			$new_values .= "$key=:$key, ";
		}
		//removendo ultima "," da query
		$new_values = substr($new_values, 0, -2);

		//filtros
		foreach ($filters as $key => $value) {
			$filters_up = "$key=:$key AND ";
		}
		//removendo ultimo "AND";
		$filters_up = substr($filters_up, 0, -4);

		//preparando query apartir dos campos($fields) e os parametros de valores nomeados($values)
		$query = "UPDATE $table SET $new_values WHERE $filters_up;";


		//se a consulta precisar de algo mais..
		$query .= $query_extra;
		
		//continuação da preparação da query...
		$statement = $pdo->prepare($query);

		//filtrando valores para serem inseridos, tecnica segura para evitar SQL Injection...
		//substituindo os parametros nomeados pelos verdadeiros valores, ex: ":name" por "Alessandro"
		foreach ($data as $key => $value) {
			$data[$key] = filter_var($value);

			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}

		//substituindo os parametros dos filtros nomeados pelos verdadeiros valores, ex: ":name" por "Alessandro"
		foreach ($filters as $key => $value){
			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}
		
		//executando a query já com seus valores
		if($statement->execute()){
			//se der certo retorna true...
			return true;
		}else{
			//se não der certo, retornará false...
			return false;
		}
	}//fim do update()

	//Excluir (DELETE)
	public static function delete($table, $filters, $query_extra=""){
		//criando o objeto pdo...
		$pdo = parent::get_instance();
		
		//filtros
		foreach ($filters as $key => $value) {
			$filters_delete = "$key=:$key AND ";
		}
		//removendo ultimo "AND";
		$filters_delete = substr($filters_delete, 0, -4);

		//preparando query apartir dos campos($fields) e os parametros de valores nomeados($values)
		$query = "DELETE FROM $table WHERE $filters_delete;";


		//se a consulta precisar de algo mais..
		$query .= $query_extra;
		

		//continuação da preparação da query...
		$statement = $pdo->prepare($query);

		//substituindo os parametros dos filtros nomeados pelos verdadeiros valores, ex: ":name" por "Alessandro"
		foreach ($filters as $key => $value){
			$statement->bindValue(":$key", $value, PDO::PARAM_STR);
		}

		//executando a query já com seus valores
		if($statement->execute()){
			//se der certo retorna true...
			return true;
		}else{
			//se não der certo, retornará false...
			return false;
		}

	}//fim do delete()

	public static function select_join($tables, $relationships, $filters, $query_extra = ""){
		//criando o objeto pdo...
		$pdo = parent::get_instance();


		$query = "SELECT ";
		
		//informando colunas a serem selecionadas
		foreach ($tables as $table=>$fields){
			if(!empty($fields)){
				foreach ($fields as $each_field){
					$query .= "$table.$each_field, ";
				}
			}else{
				$query .= "$table.*, "; //quando as colunas nao forem informadas
			}
		}

		//removendo ultima "," 
		$query = substr($query, 0, -2);
		
		//inner join's
		$tables_names = array_keys($tables);
		
		$query .= " FROM ".implode(" INNER JOIN ", $tables_names);
		
		//relacionamentos
		$query .= " ON ";
		foreach($relationships as $foreign=>$primary){
			$query .= "$foreign=$primary AND "; 
		}
		//removendo ultimo "AND"
		$query = substr($query, 0, -4);
		
		//filtros
		if(isset($filters)){
			$query .= " WHERE ";
			foreach($filters as $field=>$value){
				$query .= "$field=:$field AND ";
			}
			//removendo ultimo "AND"...
			$query = substr($query, 0, -4);
		}

		//se a consulta precisar de algo mais..
		$query .= $query_extra;
		
//echo $query;

		//preparando consulta
		$statement = $pdo->prepare($query);
	
		//substituindo os parametros pelos reais valores dos filtros, caso haja...
		if(isset($filters)){
			//filtrando valores para serem inseridos, tecnica segura para evitar SQL Injection...	
			foreach ($filters as $key => $value) {
				$value = filter_var($value);

				$statement->bindValue(":$key", $value, PDO::PARAM_STR);
			}
		}

		//executando consulta
		$statement->execute();

		//preparando resultado
		$data = "";
		if($statement->rowCount()){
			while($result = $statement->fetchAll(PDO::FETCH_ASSOC)){
				$data = $result;
			}
			//retornando resultado da busca
			return $data;
		}else{
			return false;
		}

	}//fim do select_join


	public static function query($query){
		$pdo = parent::get_instance();
		$q = $pdo->query($query);
		if($q->execute()){
			return $q;
		}else{
			return false;
		}
	}
}

?>