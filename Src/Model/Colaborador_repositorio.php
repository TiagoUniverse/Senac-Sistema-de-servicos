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
 * ║  │ @description: Repositorio da classe 'Colaborador'                                                           │  ║
 * ║  │ @class: Colaborador_repositorio                                                                             │  ║
 * ║  │ @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 27/10/23                                                                                             │  ║
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

class Colaborador_repositorio
{

   /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para cadastrar um nova solicitacao de colaborador                                                     │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function cadastro($nome, $cpf, $email_pessoal, $telefone, $idServicos,  $pdo)
    {
        try {
            $stmt = $pdo->prepare("Insert into Colaborador (nome, cpf, email_pessoal, telefone , idServicos) VALUES (:nome, :cpf, :email_pessoal, :telefone , :idServicos) ");

            $stmt->execute(array(
                ":nome" => $nome,
                ":cpf" => $cpf,
                ":email_pessoal" => $email_pessoal,
                ":telefone" => $telefone,
                ":idServicos" => $idServicos
            ));

            return true;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
   
    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para verificar se um cpf já foi cadastrado para um determinado serviço                                │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function existe_cpf($cpf, $idServicos,  $pdo)
    {
        try {
            $stmt = $pdo->prepare(" Select * from Colaborador where status = 'ATIVO' and idServicos = :idServicos and cpf = :cpf ");

            $stmt->execute(array(
                ":idServicos" => $idServicos,
                ":cpf" => $cpf
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                // encontrou
                return true;
            }

            return false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

}
