<?php
      class Controller
      {
        private $db_con = false;

        public function model($model)
        {
          require_once '../app/models/' .$model .'.php';
          return new $model();
        }

        public function view($view, $data)
        {
          require_once '../app/views/' .$view .'.php';
        }

        public function db_con()
        {
          if($this->db_con == false)
          {
            $database = new Database();
            $this->db_con = $database->db_con;
          }

          return $this->db_con;
        }
    }
