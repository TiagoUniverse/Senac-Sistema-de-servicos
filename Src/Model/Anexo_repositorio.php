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
 * ║  │ @description: Repositorio da classe 'Anexo_repositorio'                                                     │  ║
 * ║  │ @class: Anexo_repositorio                                                                                   │  ║
 * ║  │ @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 26/10/23                                                                                             │  ║
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

class Anexo_repositorio
{

   /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para registrar um arquivo de projeto novo                                                             │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function cadastro($nomeFantasia, $nome, $tipoArquivo, $diretorio, $idTemplate_Email, $idStatus_Anexo, $pdo)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO [Anexo]
            ([nomeFantasia] , [nome] , [tipoArquivo], [diretorio] , [idTemplate_Email] , [idStatus_Anexo])  
                VALUES 
            (:nomeFantasia , :nome , :tipoArquivo , :diretorio , :idTemplate_Email , :idStatus_Anexo);	");

            $stmt->execute(array(
                ":nomeFantasia" => $nomeFantasia,
                ":nome" => $nome,
                ":tipoArquivo" => $tipoArquivo,
                ":diretorio" => $diretorio,
                ":idTemplate_Email" => $idTemplate_Email,
                ":idStatus_Anexo" => $idStatus_Anexo
            ));

            return true;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para excluir todos os arquivos de um grupo. Ou seja, coloca o status como IANTIVO [28/08]             │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function deletarProjetosGrupo($idTemplate_Email, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Update [Anexo]
    //         SET
    //         updated = GETDATE(),
    //             status = 'INATIVO'
    //         Where idTemplate_Emails = :idTemplate_Email	");

    //         $stmt->execute(array(
    //             ":idTemplate_Email" => $idTemplate_Email
    //         ));

    //         return true;
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para excluir um arquivo específico do grupo [01/09]                                                   │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function deletar_Arquivo($idArquivo, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Update [Anexo]
    //         SET
    //         updated = GETDATE(),
    //             status = 'INATIVO'
    //         Where id = :idArquivo	");

    //         $stmt->execute(array(
    //             ":idArquivo" => $idArquivo
    //         ));

    //         return true;
    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para verificar se um arquivo foi excludio   [01/09]                                                   │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function consultar_exclusao_arquivo($idArquivo, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare("Select * from Anexo where id= :idArquivo");

    //         $stmt->execute(array(
    //             ":idArquivo" => $idArquivo
    //         ));

    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
    //             if ($linha['status'] == "ATIVO"){
    //                 return true;
    //             } else{
    //                 return false;
    //             }
    //         }
    //         return false;

    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para consultar todos os arquivos de um grupo. [01/09/23]                                              │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function consultarArquivosGrupo($idTemplate_Email, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare(" Select * from Anexo where idTemplate_Emails = :idTemplate_Emails and status='ATIVO'	");

    //         $stmt->execute(array(
    //             ":idTemplate_Emails" => $idTemplate_Email
    //         ));


    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
    //             $idArquivo = $linha['id'];
    //             $nome = $linha['nomeFantasia'];
    //             $nomeNovo = $linha['nome'];
    //             $tipoArquivo = $linha['tipoArquivo'];
    //             $status = $linha['status'];
    //             $created = $linha['created'];
    //             $diretorio = $linha['diretorio'];

    //             // Converte a data para um objeto DateTime
    //             $dataHora = \DateTime::createFromFormat('Y-m-d H:i:s.u', $created);

    //             // Formata a data e hora no formato brasileiro
    //             $dataHoraFormatada = $dataHora->format('d/m/Y H:i:s');


    //             $Arquivos_array[] = array($idArquivo, $nome, $nomeNovo, $tipoArquivo, $status, $created , $dataHoraFormatada, $diretorio);
                
    //         }

    //         return $Arquivos_array;

    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

    // /*
    // * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    // * │  Função para verificar se um arquivo já existe [04/09/23]                                                     │
    // * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    // */
    // function verificar_Arquivo($nomeArquivo, $idTemplate_Emails, $pdo)
    // {
    //     try {
    //         $stmt = $pdo->prepare(" Select * from Anexo where status='ATIVO' and nomeFantasia = :nomeArquivo and idTemplate_Emails = :idTemplate_Emails	");

    //         $stmt->execute(array(
    //             ":nomeArquivo" => $nomeArquivo,
    //             ":idTemplate_Emails" => $idTemplate_Emails
    //         ));


    //         while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
    //             return true;
                
    //         }
    //         return false;

    //     } catch (PDOException $err) {
    //         echo $err->getMessage();
    //     }
    // }

   

    
}
