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

   

    
}
