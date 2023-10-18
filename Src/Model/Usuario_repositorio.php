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

class Usuario_repositorio
{

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para listar todos os serviços já criados                                                              │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function listar_Servicos($pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Select * from Servicos where status = 'ATIVO' ");

    //         $stmt->execute();

    //         $lista_Servicos = array();
    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    //             $id = $linha['id'];
    //             $nome = $linha['nome'];
    //             $descricao = $linha['descricao'];
    //             $status = $linha['status'];
    //             $created = $linha['created'];
    //             $updated = $linha['updated'];
    //             $idUsuario = $linha['idUsuario'];

    //             $lista_Servicos[] = array($id, $nome, $descricao, $status, $created, $updated, $idUsuario);
            
    //         }
    //         return $lista_Servicos;
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para cadastrar um novo serviço                                                                        │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function cadastro($nome, $descricao, $idUsuario, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Insert into Servicos (nome, descricao, idUsuario) VALUES (:nome, :descricao, :idUsuario) ");

    //         $stmt->execute(array(
    //             ":nome" => $nome,
    //             ":descricao" => $descricao,
    //             ":idUsuario" => $idUsuario
    //         ));

    //         return true;
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }


    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para consultar um                                                               │
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

    
}
