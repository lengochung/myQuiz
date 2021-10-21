<?php

    class Database {
        protected $db;

        function __construct() {

			$config = require Path_pro . '/config.php';

			$database = $config['database'];
			$host = $config['host'];
			$user = $config['user'];
			$password = $config['password'];

            $dsn = "mysql:host=$host;dbname=$database";

			try {
				$this->db = new PDO( $dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8"));
			} catch (PDOException $err) {
				exit('Failed connected PDO: ' . $err->getMessage() . ' on Model/database.php');
			}
        }

        function exec_fetch ($sql) {

			$query = $this->db->query($sql);

			$result = $query->fetch(PDO::FETCH_ASSOC);
			$query->closeCursor();
			return $result;
		}

		function exec_fetchAll ($sql) {

			$query = $this->db->query($sql);

			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$query->closeCursor();
			return $result;
		}

		function exec_fetchColumn ($sql) {

			$query = $this->db->query($sql);

			$result = $query->fetchColumn();
			$query->closeCursor();
			return $result;
		}
    }