<?php

    namespace App\Entity;

    use App\DB\Database;
    use PDO;

    class User
    {
        /**
         * @var integer
         */
        public $id;
        /**
         * @var integer
         */
        public $nome;

        /**
         * @var string
         */
        public $email;

        /**
         * @var string
         */
        public $password;

        public static function getUsers()
        {
            return (new Database('user'))->select()->fetchAll(PDO:: FETCH_CLASS);
        }

        public function getUser($email)
        {
            return (new Database('user'))->select("email= '{$email}'")
                ->fetchObject(self::class);
        }

        public function getUserById($id)
        {
            return (new Database('user'))->select("id= {$id}")
                ->fetchObject(self::class);
        }

        public function deleteUser($id)
        {
            return (new Database('user'))->delete("id= {$id}")
                ->fetchObject(self::class);
        }

        public function updateUser($id)
        {
            return (new Database('user'))->update("id={$id}", [
                'nome' => $this->nome,
                'email' => $this->email,
                'password' => md5($this->password)
            ]);
        }

        public function insertUser()
        {
            /*
             *  inserir o usuario
             */

            $objDB = new Database('user');

            $this->id = $objDB->insertion([
                'nome' => $this->nome,
                'email' => $this->email,
                'password' => md5($this->password)
            ]);

            return $this->id;
        }

        public function signIn($data)
        {
            $email = $data["email"];
            $senha = md5($data["senha"]);
            echo $senha;
            return (new Database('user'))->select("email = '{$email}' AND password = '{$senha}'")
                ->fetchObject(self::class);
        }
    }