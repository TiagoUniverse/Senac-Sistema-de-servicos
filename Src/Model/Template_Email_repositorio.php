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
 * ║  │ @description: Repositorio da classe 'Template_Email'                                                        │  ║
 * ║  │ @class: Template_Email_repositorio                                                                          │  ║
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

class Template_Email_repositorio
{

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para cadastrar um novo Template de Email                                                              │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function cadastro($descricao, $ordem_emails, $idStatus_TemplateEmail, $idServicos, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Insert into Template_Email (descricao, ordem_emails, idStatus_TemplateEmail, idServicos)
            Values (:descricao , :ordem_emails, :idStatus_TemplateEmail , :idServicos ) ");

            $stmt->execute(array(
                ":descricao" => $descricao,
                ":ordem_emails" => $ordem_emails,
                ":idStatus_TemplateEmail" => $idStatus_TemplateEmail,
                ":idServicos" => $idServicos
            ));

            return true;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }



    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para consultar um template de email que acabou de ser criado                                          │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function consultar_templateCriado($descricao, $idServicos, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Template_Email where status = 'ATIVO' and descricao = :descricao and idServicos = :idServicos  ");

            $stmt->execute(array(
                ":descricao" => $descricao,
                ":idServicos" => $idServicos
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $descricao = $linha['descricao'];
                $created = $linha['created'];
                $updated = $linha['updated'];
                $idStatus_TemplateEmail = $linha['idStatus_TemplateEmail'];
                $idServico = $linha['idServicos'];
                $ordem_emails = $linha['ordem_emails'];

                $Template_Email = array($id, $descricao, $created, $updated, $idStatus_TemplateEmail, $idServico, $ordem_emails);
            }
            return $Template_Email;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
    
    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para buscar um template de email específico [31/10/23]                                                │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function consultar_ByIdServicos_OrdemEmail( $idServicos, $ordem_emails, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Template_Email where status = 'ATIVO' and idServicos = :idServicos and ordem_emails = :ordem_emails  ");

            $stmt->execute(array(
                ":idServicos" => $idServicos,
                ":ordem_emails" => $ordem_emails
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $id = $linha['id'];
                $descricao = $linha['descricao'];
                $created = $linha['created'];
                $updated = $linha['updated'];
                $idStatus_TemplateEmail = $linha['idStatus_TemplateEmail'];
                $idServico = $linha['idServicos'];
                $ordem_emails = $linha['ordem_emails'];

                $Template_Email = array($id, $descricao, $created, $updated, $idStatus_TemplateEmail, $idServico, $ordem_emails);
            }
            return $Template_Email;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}
