# projetoJerab
Desafio para o processo seletivo 
===============================================================================================================
Autor: Elian Cristian
===============================================================================================================
PLUGINS utilizados: mPDF
API KEy: GoogleMaps
SGBD: MySql
Modelo BD: ./modelo/
===============================================================================================================
Instrucoes para utilizacao
 - Alterar o arquivo do bd em ../config/db.php - adicionar o nome do banco, usuario e senha do PHPMyAdmin
 - Cadastrar um novo usuario para poder realizar o login: http://localhost/projeto/projetoJerab/basic/web/index.php?r=usuario
 - Pode ser que seja necessário registrar a aplicacao nas APIs do google, ver mais em: https://developers.google.com/maps/documentation/javascript/examples/
 - Instalar o mpdf, usando composer, ver mais em https://github.com/mpdf/mpdf


===============================================================================================================
Requisitos para desenvolvimento:

·        Sistema Web desenvolvido em Linguagem PHP;

·        Utilização do framework Yii2;

·        Layout visual agradável, utilizando bootstrap;

·        Utilizar banco de dados Postgres - PENDENTE;

·        Disponibilizar o projeto no github (código fonte e Modelo de Dados);

 

Requisitos do sistema:

·        Função de Login de usuário;

·        Função Cadastrar, Editar e Remover usuários;

·        Tela de Gestão de Usuários cadastrados;

·        Limitar a quantidade (10 usuários) para Cadastro de Usuários;

·        Gerar PDF da listagem de Usuários cadastrados;

·        Cadastro da localização da residência do Usuário (latitude / longitude) utilizando Google Maps;

·        Tela para Visualização no Mapa de todos os Usuários Cadastrados (latitude/longitude da residência);

·        Função ao clicar no Usuário (marcador) do Mapa, abrir detalhes dos dados cadastrados - PENDENTE.
===============================================================================================================