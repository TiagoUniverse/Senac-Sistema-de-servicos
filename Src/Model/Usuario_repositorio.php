<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               Sistema de Serviços                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ NOTA: Todas as informações contidas neste documento são propriedade do SENAC PERNAMBUCO e seus fornecedores,│  ║
 * ║  │ caso existam. Os conceitos intelectuais e técnicos contidos são propriedade do SENAC PERNAMBUCO e seus      │  ║
 * ║  │ fornecedores e podem estar cobertos pelas patentes nacionais, e estão protegidas por segredo comercial ou   │  ║
 * ║  │ lei de direitos autorais. Divulgação desta informação ou reprodução deste material é estritamente proibido, │  ║
 * ║  │ a menos que seja obtida permissão prévia por escrito do SENAC PERNAMBUCO.                                   │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Repositorio da classe 'Servicos'                                                              │  ║
 * ║  │ @class: Usuario_repositorio                                                                                 │  ║
 * ║  │ @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 18/10/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 * ║                                                     UPGRADES                                                      ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ 1. @date:                                                                                                   │  ║
 * ║  │    @description:                                                                                            │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║                                                                                                                   ║
 * ╚═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╝
 */

namespace model;

use PDOException;

use \PDO;

class Usuario_repositorio
{

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para consultar o fundador de um serviço                                                               │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function consulta_fundador($idUsuario, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Usuario where id = :id and status = 'ATIVO'  ");

            $stmt->execute(array(
                ":id" => $idUsuario
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                return $linha['nome'];
            }
            return false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para efetuar o login no sistema                                                                       |
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // public function login($email, $senha, $pdo)
    // {
    //     try {

    //         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             // valid address
    //             // echo "E-mail correto";
    //             //Meu servidor: "desktop-f2g3ks7\sqlexpress"
    //             //Servidor do Senac: SQLSERVER

    //             $servername = "SQLSERVER";
    //             $dbname = "Placement";
    //             $username = "tiagolopes";
    //             $pwd = "gti2022";
    //             try {
    //                 $pdo = new PDO("sqlsrv:server=$servername ; Database=$dbname", "$username", "$pwd");
    //                 // echo "Conectado com sucesso!";
    //                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             } catch (Exception $e) {
    //                 die(print_r($e->getMessage()));
    //             }


    //             $prepare = $pdo->prepare("Select email, senha from Usuario Where status = 1 and senha = HASHBYTES('sha1', :senha) and email = :email  ");
    //             $prepare->bindParam(":senha", $senha);
    //             $prepare->bindParam(":email", $email);
    //             $result = $prepare->execute();

    //             if ($result) {
    //                 // echo "Consulta com sucesso!";
    //             } else {
    //                 // echo "Falha na consulta";
    //             }

    //             if ($result) {
    //                 return true;
    //             }

    //             return false;
    //         } else {
    //             // invalid address
    //             //    echo "E-mail inválido!";
    //         }
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }


    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para verificar se o login deu sucesso                                                                 │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    public function login($email, $senha)
    {
        $declaracao = "
        Select * from Usuario
        Where
            senha = HASHBYTES('sha1', '{$senha}') and   email = '{$email}'  ";

        // echo $declaracao;

        $conexao = array("Database" => $_SESSION['DB_NAME'], "CharacterSet" => "UTF-8", "UID" =>  $_SESSION['DB_USER'], "PWD" => $_SESSION['DB_PASSWORD']);
        $link = sqlsrv_connect($_SESSION['SERVER'], $conexao);

        $stmt = sqlsrv_query($link, $declaracao);


        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt)) {
                //   echo "row:<br>"; var_dump($row); echo "<br><br>";
                return true;
            }
        } else {
            // echo "<br/>No Results were found."; 
            return false;
        }
    }

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para consultar o usuário que está logando através de suas informações de login                        │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function consultarByLogin($email, $senha, $pdo)
    {
        try {

            $declaracao = "
            Select * from Usuario
            Where
                senha = HASHBYTES('sha1', '{$senha}') and   email = '{$email}'  ";

            // echo $declaracao;

            $conexao = array("Database" => $_SESSION['DB_NAME'], "CharacterSet" => "UTF-8", "UID" =>  $_SESSION['DB_USER'], "PWD" => $_SESSION['DB_PASSWORD']);
            $link = sqlsrv_connect($_SESSION['SERVER'], $conexao);

            $stmt = sqlsrv_query($link, $declaracao);


            while ($linha = sqlsrv_fetch_array($stmt)) {
                $id = $linha['id'];
                $nome = $linha['nome'];
                $nomeSobrenome = $linha['nomeSobrenome'];
                $email = $linha['email'];
                $cpf = $linha['cpf'];
                $dataNascimento = $linha['dataNascimento'];
                $telefone = $linha['telefone'];
                $status = $linha['status'];
                $created = $linha['created'];
                $updated = $linha['updated'];
                $idUnidade = $linha['idUnidade'];
                $administrador = $linha['administrador'];

                $Usuario = array($id, $nome, $nomeSobrenome, $email, $cpf, $dataNascimento, $telefone, $status, $created, $updated, $idUnidade, $administrador);

                return $Usuario;
            }

            return false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    // function consultar_HASHBYTES_Senha($email, $senha, $pdo)
    // {
    //     try {
    //         $query = "SELECT * FROM Usuario WHERE senha = HASHBYTES('sha1', :senha)";
    //         $stmt = $pdo->prepare($query);
    //         $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    //         $stmt->execute();

    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    //             echo "entrei";
    //             return $linha['nome'];
    //         }
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }



}
