<?php
	
	
	namespace App\DB;
	
	use PDO;
	use PDOException;
	
	class Database
	{

		const HOST = "kutnpvrhom7lki7u.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
		const NAME = "aoqkgltmwwhupema";
		const USER = "uznooe4sj5k0iqcp";
		const PASS = "p15av0x3xh35qslv";

		private $table;
		/**
		 * Instancia de conexao do banco de dados
		 */
		private $connection;


        /**
         * @param string $table
         */
        public function __construct($table = null)
		{
			$this->table = $table;
			$this->setConnection();
		}
		
		private function setConnection()
		{
			try {
				$this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::NAME, self::USER, self::PASS);
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die('Erro ao conectar ao banco');
			}
		}

        public function t()
        {
            $d = new Database("user");
            echo "<pre>";
            var_dump($d);
            echo "</pre>";
		}
		
		public function insertion($data)
		{
			$fields = array_keys($data);
			$binds = array_pad([], count($fields), '?');

			$query = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUE (" . implode(',', $binds) . ")";

			$this->execute($query, array_values($data));

			return $this->connection->lastInsertId();
		}
		
		public function execute($query, $params = [])
		{
			try {
				$statement = $this->connection->prepare($query);
				$statement->execute($params);
				return $statement;
			} catch (PDOException $e) {
				die('Erro ao enviar dados ao banco: ' . $e->getMessage());
			}
		}
		
		public function select($where = null, $order = null, $limit = null, $fields = '*')
		{
			$where = strlen($where) ? "WHERE {$where}" : "";
			$order = strlen($order) ? "ORDER BY {$order}" : "";
			$limit = strlen($limit) ? "LIMIT {$limit}" : "";
			$query = "SELECT {$fields} FROM {$this->table} {$where} {$order} {$limit} ";
			return $this->execute($query);
		}
		
		public function update($where, $values)
		{
			$fields = array_keys($values);
			$query = "UPDATE {$this->table} SET " . implode('=?,', $fields) . "=? WHERE {$where}";
			$this->execute($query, array_values($values));
			
			return true;
		}
		
		public function delete($where)
		{
			$query = "DELETE FROM {$this->table} WHERE {$where}";
			$this->execute($query);
			
			return true;
		}
	}
