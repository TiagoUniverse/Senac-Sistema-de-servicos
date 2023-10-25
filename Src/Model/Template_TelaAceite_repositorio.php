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
 * ║  │ @description: Repositorio da classe 'Template_TelaAceite'                                                   │  ║
 * ║  │ @class: Template_TelaAceite_repositorio                                                                     │  ║
 * ║  │ @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 25/10/23                                                                                             │  ║
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

class Template_TelaAceite_repositorio
{

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para cadastrar um novo Template de Email                                                              │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function cadastro($descricao, $idTemplate_Email, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Insert INTO Template_TelaAceite (descricao, idTemplate_Email)
            Values (:descricao , :idTemplate_Email) ");

            $stmt->execute(array(
                ":descricao" => $descricao,
                ":idTemplate_Email" => $idTemplate_Email
            ));

            return true;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }



    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para consultar um template de email que acabou de ser criado                                          │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function consultar_templateCriado($descricao, $idServicos, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Select * from Template_Email where status = 'ATIVO' and descricao = :descricao and idServicos = :idServicos  ");

    //         $stmt->execute(array(
    //             ":descricao" => $descricao,
    //             ":idServicos" => $idServicos
    //         ));

    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    //             $id = $linha['id'];
    //             $descricao = $linha['descricao'];
    //             $created = $linha['created'];
    //             $updated = $linha['updated'];
    //             $idStatus_TemplateEmail = $linha['idStatus_TemplateEmail'];
    //             $idServico = $linha['idServico'];
    //             $ordem_emails = $linha['ordem_emails'];

    //             $Template_Email = array($id, $descricao, $created, $updated, $idStatus_TemplateEmail, $idServico, $ordem_emails);
    //         }
    //         return $Template_Email;
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }
}
