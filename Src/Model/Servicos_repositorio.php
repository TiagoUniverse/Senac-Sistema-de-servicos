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
 * ║  │ @class: Servicos_repositorio                                                                                │  ║
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

// Restante do seu código aqui


class Area_conhecimento_repositorio
{

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para consultar o id de uma área de conhecimento específica                                            │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function consultaId_ByNome($nome, $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Area_conhecimento Where nome = :nome ");

            $stmt->execute(array(
                ':nome' => $nome
            ));

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                return $linha['id'];
            }
            return false;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    

    /*
    * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
    * │  Função para listar todas as áreas do conhecimento disponíveis                                                │
    * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
    */
    function listar_Areas( $pdo)
    {
        try {
            $stmt = $pdo->prepare("Select * from Area_conhecimento ");

            $stmt->execute();

            $nomesAreas = array();
            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $nomesAreas[] = $linha['nome'];
            }
            return $nomesAreas;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}
