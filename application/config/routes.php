<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */

$route['default_controller'] = 'LoginController';

/* Grupo Login - Hilquias Chitazo */
$route['login'] = 'LoginController';
$route['autenticar'] = 'LoginController/autenticar';
$route['sair'] = 'LoginController/terminarsessao';


/*
 * MÓDULO SITE
 */
//Grupo Sistema=>Licenca - Hilquias Chitazo */
$route['site/painel'] = 'Sistema/SiteController/painel';
$route['site/painel/(:num)'] = 'Sistema/SiteController/painel';
$route['site/cadastrar'] = 'Sistema/SiteController/cadastrar';
$route['site/listar'] = 'Sistema/SiteController/listar';
$route['site/listar/(:num)'] = 'Sistema/SiteController/listar';
$route['site/editar/(:num)'] = 'Sistema/SiteController/editar/$1';
$route['site/actualizar'] = 'Sistema/SiteController/actualizar';
$route['site/eliminar/(:num)'] = 'Sistema/SiteController/eliminar/$1';


/*
 * MÓDULO LICENCA
 */
//Grupo Sistema=>Licenca - Hilquias Chitazo */
$route['licenca/nova'] = 'Sistema/LicencaController/nova';
$route['licenca/nova/(:num)'] = 'Sistema/LicencaController/nova';
$route['licenca/cadastrar'] = 'Sistema/LicencaController/cadastrar';
$route['licenca/listar'] = 'Sistema/LicencaController/listar';
$route['licenca/listar/(:num)'] = 'Sistema/LicencaController/listar';
$route['licenca/editar/(:num)'] = 'Sistema/LicencaController/editar/$1';
$route['licenca/actualizar'] = 'Sistema/LicencaController/actualizar';
$route['licenca/eliminar/(:num)'] = 'Sistema/LicencaController/eliminar/$1';
~$route['licenca/validar'] = 'Sistema/LicencaController/validar';
$route['licenca/email'] = 'Sistema/LicencaController/email';


/*
 * MÓDULO PAINEL  
 */
/* Grupo Sistema - Hilquias Chitazo */
$route['getdados'] = 'Sistema/LicencaController/getdados';
$route['painelcontrole'] = 'Sistema/HomeController';
$route['home'] = 'Sistema/HomeController';
$route['home/contchat'] = 'Sistema/HomeController/contchat';
$route['home/conttarefa'] = 'Sistema/HomeController/conttarefa';
$route['home/contevento'] = 'Sistema/HomeController/contevento';
$route['home/realtime_receita'] = 'Sistema/HomeController/realtime_receita';


/*
 * MÓDULO CALENDARIO
 */

/* Grupo Sistema=>Calendário=>Tipo de Evento- Hilquias Chitazo */
$route['calendario/nova'] = 'Sistema/CalendarioController/nova';
$route['calendario/nova/(:num)'] = 'Sistema/CalendarioController/nova';
$route['calendario/cadastrar'] = 'Sistema/CalendarioController/cadastrar';
$route['calendario/listar'] = 'Sistema/CalendarioController/listar';
$route['calendario/calendario'] = 'Sistema/CalendarioController/calendario';
$route['calendario/listar/(:num)'] = 'Sistema/CalendarioController/listar';
$route['calendario/editar/(:num)'] = 'Sistema/CalendarioController/editar/$1';
$route['calendario/actualizar'] = 'Sistema/CalendarioController/actualizar';
$route['calendario/eliminar/(:num)'] = 'Sistema/CalendarioController/eliminar/$1';
$route['calendario/getcalendario'] = 'Sistema/CalendarioController/getcalendario';
$route['calendario/calendario'] = 'Sistema/CalendarioController/calendario';

/*
 * MÓDULO ATENDIMENTO
 */
/* Grupo Sistema=>Atendimento=>Agenda- Hilquias Chitazo */
$route['atendimento/nova'] = 'Sistema/AtendimentoController/nova';
$route['atendimento/nova/(:num)'] = 'Sistema/AtendimentoController/nova';
$route['atendimento/atender/(:num)'] = 'Sistema/AtendimentoController/atender/$1';
$route['atendimento/cadastrar'] = 'Sistema/AtendimentoController/cadastrar';
$route['atendimento/listar'] = 'Sistema/AtendimentoController/listar';
$route['atendimento/listar/(:num)'] = 'Sistema/AtendimentoController/listar';
$route['atendimento/editar/(:num)'] = 'Sistema/AtendimentoController/editar/$1';
$route['atendimento/actualizar'] = 'Sistema/AtendimentoController/actualizar';
$route['atendimento/eliminar/(:num)'] = 'Sistema/AtendimentoController/eliminar/$1';
$route['atendimento/procurar'] = 'Sistema/AtendimentoController/procurar';
$route['atendimento/transacao/(:num)'] = 'Sistema/AtendimentoController/transacao/$1';
$route['atendimento/calendario'] = 'Sistema/AtendimentoController/calendario';

/*
 * MÓDULO CLÍNICO
 */

$route['clinico/abrirfile/(:any)/(:any)'] = 'Sistema/ClinicoController/abrirfile/$1/$2';
$route['clinico/paciente'] = 'Sistema/ClinicoController/listarpaciente';

$route['clinico/dadosclinico/(:num)'] = 'Sistema/ClinicoController/dadosclinico/$1';

$route['clinico/fichaclinica/(:num)'] = 'Sistema/ClinicoController/fichaclinica/$1';
$route['clinico/cadastrarfichaclinica'] = 'Sistema/ClinicoController/cadastrarfichaclinica';
$route['clinico/actualizarfichaclinica'] = 'Sistema/ClinicoController/actualizarfichaclinica';
$route['clinico/eliminarfichaclinica/(:num)'] = 'Sistema/ClinicoController/eliminarfichaclinica/$1';
$route['clinico/getfichaclinica'] = 'Sistema/ClinicoController/getfichaclinica';
$route['clinico/imprimirfichaclinica/(:num)'] = 'Sistema/ClinicoController/imprimirfichaclinica/$1';

$route['clinico/pedidoexame/(:num)'] = 'Sistema/ClinicoController/pedidoexame/$1';
$route['clinico/cadastrarpedidoexame'] = 'Sistema/ClinicoController/cadastrarpedidoexame';
$route['clinico/eliminarpedidoexame/(:num)/(:num)'] = 'Sistema/ClinicoController/eliminarpedidoexame/$1/$2';
$route['clinico/listarpedidoexame'] = 'Sistema/ClinicoController/listarpedidoexame';
$route['clinico/mostrarpedidoexame/(:num)'] = 'Sistema/ClinicoController/mostrar_pedido_exame/$1';
$route['clinico/editarpedidoexame'] = 'Sistema/ClinicoController/editar_pedido_exame';
$route['clinico/imprimirpedidoexame/(:num)'] = 'Sistema/ClinicoController/imprimirpedidoexame/$1';
$route['clinico/imprimiritempedidoexame/(:num)'] = 'Sistema/ClinicoController/imprimir_item_pedidoexame/$1';

$route['clinico/elaborarexame/(:num)'] = 'Sistema/ClinicoController/elaborarexame/$1';
$route['clinico/editarresultadoexame/(:num)'] = 'Sistema/ClinicoController/editarresultadoexame/$1';
$route['clinico/actualizarresultadoexame'] = 'Sistema/ClinicoController/actualizarresultadoexame';
$route['clinico/cadastrarelaborarexame'] = 'Sistema/ClinicoController/cadastrarelaborarexame';
$route['clinico/listarresultadoexame'] = 'Sistema/ClinicoController/listarresultadoexame';
$route['clinico/listarresultadoexame/(:num)'] = 'Sistema/ClinicoController/listarresultadoexame';
$route['clinico/eliminarresultadoexame/(:num)'] = 'Sistema/ClinicoController/eliminarresultadoexame/$1';
$route['clinico/imprimirresultadoexame/(:num)'] = 'Sistema/ClinicoController/imprimirresultadoexame/$1';

$route['clinico/receita/(:num)'] = 'Sistema/ClinicoController/receita/$1';
$route['clinico/cadastrarreceita'] = 'Sistema/ClinicoController/cadastrarreceita';
$route['clinico/eliminarreceita/(:num)/(:num)'] = 'Sistema/ClinicoController/eliminarreceita/$1/$2';
$route['clinico/editarreceita/(:num)'] = 'Sistema/ClinicoController/editarreceita/$1';
$route['clinico/actualizarreceita'] = 'Sistema/ClinicoController/actualizarreceita';
$route['clinico/imprimirreceita/(:num)'] = 'Sistema/ClinicoController/imprimirreceita/$1';
$route['clinico/proximaconsulta'] = 'Sistema/ClinicoController/relactorioproximaconsulta';

$route['clinico/periodomenstrual/(:num)'] = 'Sistema/ClinicoController/periodomenstrual/$1';
$route['clinico/cadastrarperiodomenstrual'] = 'Sistema/ClinicoController/cadastrarperiodomenstrual';
$route['clinico/actualizarperiodomenstrual'] = 'Sistema/ClinicoController/actualizarperiodomenstrual';
$route['clinico/eliminarperiodomenstrual/(:num)'] = 'Sistema/ClinicoController/eliminarperiodomenstrual/$1';
$route['clinico/imprimirperiodomenstrual/(:num)'] = 'Sistema/ClinicoController/imprimirperiodomenstrual/$1';


$route['clinico/cpfiv/(:num)'] = 'Sistema/ClinicoController/cpfiv/$1';
$route['clinico/cadastrarcpfiv'] = 'Sistema/ClinicoController/cadastrarcpfiv';
$route['clinico/actualizarcpfiv'] = 'Sistema/ClinicoController/actualizarcpfiv';
$route['clinico/eliminarcpfiv/(:num)'] = 'Sistema/ClinicoController/eliminarcpfiv/$1';
$route['clinico/getcpfiv'] = 'Sistema/ClinicoController/getcpfiv';
$route['clinico/imprimircpfiv/(:num)'] = 'Sistema/ClinicoController/imprimircpfiv/$1';
$route['clinico/imprimircpfiv'] = 'Sistema/ClinicoController/imprimircpfiv';


$route['cardapio/nova'] = 'Sistema/CardapioController/nova';
$route['cardapio/nova/(:num)'] = 'Sistema/CardapioController/nova';
$route['cardapio/cadastrar'] = 'Sistema/CardapioController/cadastrar';
$route['cardapio/listar'] = 'Sistema/CardapioController/listar';
$route['cardapio/listar/(:num)'] = 'Sistema/CardapioController/listar';
$route['cardapio/editar/(:num)'] = 'Sistema/CardapioController/editar/$1';
$route['cardapio/actualizar'] = 'Sistema/CardapioController/actualizar';
$route['cardapio/eliminar/(:num)'] = 'Sistema/CardapioController/eliminar/$1';

/* Grupo Sistema=>Configurações=>Exame- Hilquias Chitazo */
$route['exame/nova'] = 'Sistema/ExameController/nova';
$route['exame/nova/(:num)'] = 'Sistema/ExameController/nova';
$route['exame/cadastrar'] = 'Sistema/ExameController/cadastrar';
$route['exame/insupditem'] = 'Sistema/ExameController/insupditem';
$route['exame/listar'] = 'Sistema/ExameController/listar';
$route['exame/listar/(:num)'] = 'Sistema/ExameController/listar';
$route['exame/editar/(:num)'] = 'Sistema/ExameController/editar/$1';
$route['exame/actualizar'] = 'Sistema/ExameController/actualizar';
$route['exame/eliminar/(:num)'] = 'Sistema/ExameController/eliminar/$1';

$route['grupoexame/nova'] = 'Sistema/GrupoExameController/nova';
$route['grupoexame/nova/(:num)'] = 'Sistema/GrupoExameController/nova';
$route['grupoexame/cadastrar'] = 'Sistema/GrupoExameController/cadastrar';
$route['grupoexame/listar'] = 'Sistema/GrupoExameController/listar';
$route['grupoexame/listar/(:num)'] = 'Sistema/GrupoExameController/listar';
$route['grupoexame/editar/(:num)'] = 'Sistema/GrupoExameController/editar/$1';
$route['grupoexame/actualizar'] = 'Sistema/GrupoExameController/actualizar';
$route['grupoexame/eliminar/(:num)'] = 'Sistema/GrupoExameController/eliminar/$1';

/* Grupo Sistema=>Atendimento=>Agenda- Hilquias Chitazo */
$route['agenda/nova'] = 'Sistema/AgendaController/nova';
$route['agenda/nova/(:num)'] = 'Sistema/AgendaController/nova';
$route['agenda/cadastrar'] = 'Sistema/AgendaController/cadastrar';
$route['agenda/listar'] = 'Sistema/AgendaController/listar';
$route['agenda/listar/(:num)'] = 'Sistema/AgendaController/listar';
$route['agenda/notificar/(:num)'] = 'Sistema/AgendaController/notificar/$1';
$route['agenda/editar/(:num)'] = 'Sistema/AgendaController/editar/$1';
$route['agenda/actualizar'] = 'Sistema/AgendaController/actualizar';
$route['agenda/eliminar/(:num)'] = 'Sistema/AgendaController/eliminar/$1';
$route['agenda/procurar'] = 'Sistema/AgendaController/procurar';
$route['agenda/transacao/(:num)'] = 'Sistema/AgendaController/transacao/$1';
$route['agenda/calendario'] = 'Sistema/AgendaController/calendario';
$route['agenda/estado/(:num)/(:num)'] = 'Sistema/AgendaController/estado/$1/$2';
$route['agenda/getagenda'] = 'Sistema/AgendaController/getagenda';
/*
 * MÓDULO SERVICO
 */

/* Grupo Sistema=>Configurações=>Departamento- Hilquias Chitazo */
$route['produto/nova'] = 'Sistema/ProdutoController/nova';
$route['produto/nova/(:num)'] = 'Sistema/ProdutoController/nova';
$route['produto/cadastrar'] = 'Sistema/ProdutoController/cadastrar';
$route['produto/listar'] = 'Sistema/ProdutoController/listar';
$route['produto/listar/(:num)'] = 'Sistema/ProdutoController/listar';
$route['produto/editar/(:num)'] = 'Sistema/ProdutoController/editar/$1';
$route['produto/actualizar'] = 'Sistema/ProdutoController/actualizar';
$route['produto/eliminar/(:num)'] = 'Sistema/ProdutoController/eliminar/$1';
$route['produto/procurar'] = 'Sistema/ProdutoController/procurar';
$route['produto/transacao/(:num)'] = 'Sistema/ProdutoController/transacao/$1';

/* Grupo Sistema=>Configurações=>Serviço- Hilquias Chitazo */
$route['servico/nova'] = 'Sistema/ServicoController/nova';
$route['servico/nova/(:num)'] = 'Sistema/ServicoController/nova';
$route['servico/cadastrar'] = 'Sistema/ServicoController/cadastrar';
$route['servico/listar'] = 'Sistema/ServicoController/listar';
$route['servico/listar/(:num)'] = 'Sistema/ServicoController/listar';
$route['servico/editar/(:num)'] = 'Sistema/ServicoController/editar/$1';
$route['servico/actualizar'] = 'Sistema/ServicoController/actualizar';
$route['servico/eliminar/(:num)'] = 'Sistema/ServicoController/eliminar/$1';


/*
 * MÓDULO PESSOAL
 */
/* Grupo Sistema=>Pessoal=>Funcionario- Hilquias Chitazo */
$route['funcionario/nova/(:num)'] = 'Sistema/FuncionarioController/nova';
$route['funcionario/cadastrar'] = 'Sistema/FuncionarioController/cadastrar';
$route['funcionario/listar'] = 'Sistema/FuncionarioController/listar';
$route['funcionario/listar/(:num)'] = 'Sistema/FuncionarioController/listar';
$route['funcionario/editar/(:num)'] = 'Sistema/FuncionarioController/editar/$1';
$route['funcionario/actualizar'] = 'Sistema/FuncionarioController/actualizar';
$route['funcionario/eliminar/(:num)'] = 'Sistema/FuncionarioController/eliminar/$1';
$route['funcionario/passe'] = 'Sistema/RelactorioController/relactoriopasse';

/* Grupo Sistema=>Pessoal=>Salario- Hilquias Chitazo */
$route['salario/nova'] = 'Sistema/SalarioController/nova';
$route['salario/getsalario'] = 'Sistema/SalarioController/getsalario';
$route['salario/getitem'] = 'Sistema/SalarioController/getitem';
$route['salario/cadastrar'] = 'Sistema/SalarioController/cadastrar';
$route['salario/listar'] = 'Sistema/SalarioController/listar';
$route['salario/listar/(:num)'] = 'Sistema/SalarioController/listar';
$route['salario/eliminar/(:num)'] = 'Sistema/SalarioController/eliminar/$1';
$route['salario/imprimir/(:num)'] = 'Sistema/SalarioController/imprimir/$1';


/* Grupo Sistema=>Pessoal=>Feria- Hilquias Chitazo */
$route['feria/nova'] = 'Sistema/FeriaController/nova';
$route['feria/nova/(:num)'] = 'Sistema/FeriaController/nova';
$route['feria/cadastrar'] = 'Sistema/FeriaController/cadastrar';
$route['feria/listar'] = 'Sistema/FeriaController/listar';
$route['feria/listar/(:num)'] = 'Sistema/FeriaController/listar';
$route['feria/editar/(:num)'] = 'Sistema/FeriaController/editar/$1';
$route['feria/actualizar'] = 'Sistema/FeriaController/actualizar';
$route['feria/eliminar/(:num)'] = 'Sistema/FeriaController/eliminar/$1';

$route['feria/calendario'] = 'Sistema/FeriaController/calendario';
$route['feria/estado/(:num)/(:num)'] = 'Sistema/FeriaController/estado/$1/$2';
$route['feria/getferia'] = 'Sistema/FeriaController/getferia';


/* Grupo Sistema=>Pessoal=>Presenca- Hilquias Chitazo */
$route['presenca/nova'] = 'Sistema/PresencaController/nova';
$route['presenca/nova/(:num)'] = 'Sistema/PresencaController/nova';
$route['presenca/cadastrar'] = 'Sistema/PresencaController/cadastrar';
$route['presenca/listar'] = 'Sistema/PresencaController/listar';
$route['presenca/listar/(:num)'] = 'Sistema/PresencaController/listar';
$route['presenca/editar/(:num)'] = 'Sistema/PresencaController/editar/$1';
$route['presenca/actualizar'] = 'Sistema/PresencaController/actualizar';
$route['presenca/eliminar/(:num)'] = 'Sistema/PresencaController/eliminar/$1';


/*
 * MÓDULO PACIENTE
 */
/* Grupo Sistema=>Paciente=>Paciente- Hilquias Chitazo */
$route['paciente/nova'] = 'Sistema/PacienteController/nova';
$route['paciente/nova/(:num)'] = 'Sistema/PacienteController/nova';
$route['paciente/cadastrar'] = 'Sistema/PacienteController/cadastrar';
$route['paciente/listar'] = 'Sistema/PacienteController/listar';
$route['paciente/listar/(:num)'] = 'Sistema/PacienteController/listar';
$route['paciente/editar/(:num)'] = 'Sistema/PacienteController/editar/$1';
$route['paciente/actualizar'] = 'Sistema/PacienteController/actualizar';
$route['paciente/eliminar/(:num)'] = 'Sistema/PacienteController/eliminar/$1';


/*
 * MÓDULO CLIENTE
 */
/* Grupo Sistema=>Cliente=>Cliente- Hilquias Chitazo */
$route['cliente/nova'] = 'Sistema/ClienteController/nova';
$route['cliente/nova/(:num)'] = 'Sistema/ClienteController/nova';
$route['cliente/cadastrar'] = 'Sistema/ClienteController/cadastrar';
$route['cliente/listar'] = 'Sistema/ClienteController/listar';
$route['cliente/listar/(:num)'] = 'Sistema/ClienteController/listar';
$route['cliente/editar/(:num)'] = 'Sistema/ClienteController/editar/$1';
$route['cliente/actualizar'] = 'Sistema/ClienteController/actualizar';
$route['cliente/eliminar/(:num)'] = 'Sistema/ClienteController/eliminar/$1';


/*
 * MÓDULO ESTATISTICA
 */
/* Grupo Sistema=>Estatistica=>Grafico- Hilquias Chitazo */
$route['estatistica/grafico'] = 'Sistema/EstatisticaController/grafico';
$route['estatistica/listagem'] = 'Sistema/EstatisticaController/listagem';

/*
 * MÓDULO RELACTÓRIO
 */
/* Grupo Sistema=>Estatistica=>Grafico- Hilquias Chitazo */
$route['relactorio/pagamentoperiodo'] = 'Sistema/RelactorioController/relactoriopagamentoperiodo';
$route['relactorio/proforma'] = 'Sistema/RelactorioController/relactorioproforma';
$route['relactorio/pagamento'] = 'Sistema/RelactorioController/relactoriopagamento';
$route['relactorio/venda'] = 'Sistema/RelactorioController/relactoriovenda';
$route['relactorio/compra'] = 'Sistema/RelactorioController/relactoriocompra';
$route['relactorio/salario'] = 'Sistema/RelactorioController/relactoriosalario';
$route['relactorio/geral'] = 'Sistema/RelactorioController/relactoriogeral';



/*
 * MÓDULO FINANCAS
 */
/* Grupo Sistema=>Financas=>Propina- Hilquias Chitazo */
$route['factura/nova'] = 'Sistema/FacturaController/nova';
$route['factura/facturacliente/(:num)'] = 'Sistema/FacturaController/facturacliente/$1';
$route['factura/facturavenda'] = 'Sistema/FacturaController/facturavenda';
$route['factura/facturaproforma/(:num)'] = 'Sistema/FacturaController/facturaproforma/$1';
$route['factura/facturapagamento/(:num)'] = 'Sistema/FacturaController/facturapagamento/$1';
$route['factura/facturacompra'] = 'Sistema/FacturaController/facturacompra';
$route['factura/getservico'] = 'Sistema/FacturaController/getservico';
$route['factura/getproduto'] = 'Sistema/FacturaController/getproduto';
$route['factura/pagardivida/(:num)'] = 'Sistema/FacturaController/pagardivida/$1';


//Proforma
$route['factura/cadastrarproforma'] = 'Sistema/FacturaController/cadastrarproforma';
$route['factura/listarproforma'] = 'Sistema/FacturaController/listarproforma';
$route['factura/listarproforma'] = 'Sistema/FacturaController/listarproforma';
$route['factura/listarproforma/(:num)'] = 'Sistema/FacturaController/listarproforma';
$route['factura/listarproforma/(:num)'] = 'Sistema/FacturaController/listarproforma';
$route['factura/eliminarproforma/(:num)'] = 'Sistema/FacturaController/eliminarproforma/$1';
$route['factura/imprimirproforma/(:num)'] = 'Sistema/FacturaController/imprimirproforma/$1';

//Pagamento
$route['factura/cadastrarpagamento'] = 'Sistema/FacturaController/cadastrarpagamento';
$route['factura/listarpagamento'] = 'Sistema/FacturaController/listarpagamento';
$route['factura/listarpagamento'] = 'Sistema/FacturaController/listarpagamento';
$route['factura/listarpagamento/(:num)'] = 'Sistema/FacturaController/listarpagamento';
$route['factura/listarpagamento/(:num)'] = 'Sistema/FacturaController/listarpagamento';
$route['factura/eliminarpagamento/(:num)'] = 'Sistema/FacturaController/eliminarpagamento/$1';
$route['factura/imprimirpagamento/(:num)'] = 'Sistema/FacturaController/imprimirpagamento/$1';

//Venda
$route['factura/cadastrarvenda'] = 'Sistema/FacturaController/cadastrarvenda';
$route['factura/listarvenda'] = 'Sistema/FacturaController/listarvenda';
$route['factura/listarvenda/(:num)'] = 'Sistema/FacturaController/listarvenda';
$route['factura/eliminarvenda/(:num)'] = 'Sistema/FacturaController/eliminarvenda/$1';
$route['factura/imprimirvenda/(:num)'] = 'Sistema/FacturaController/imprimirvenda/$1';
//Compra
$route['factura/cadastrarcompra'] = 'Sistema/FacturaController/cadastrarcompra';
$route['factura/listarcompra'] = 'Sistema/FacturaController/listarcompra';
$route['factura/listarcompra/(:num)'] = 'Sistema/FacturaController/listarcompra';
$route['factura/eliminarcompra/(:num)'] = 'Sistema/FacturaController/eliminarcompra/$1';
$route['factura/imprimircompra/(:num)'] = 'Sistema/FacturaController/imprimircompra/$1';

//Stoque
$route['produto/getstoque'] = 'Sistema/FacturaController/getstoque';
$route['produto/stoque'] = 'Sistema/FacturaController/stoque';


/*
 * MÓDULO IMPRESSÃO
 */
/* Grupo Sistema=>Financas=>Propina- Hilquias Chitazo */
$route['imprimir'] = 'Sistema/ImprimirController';

/*
 * MÓDULO GESTOR DE TAREFAS
 */
/* Grupo Sistema=>Gestor de Tarefa=>Tarefa- Hilquias Chitazo */
$route['tarefa/nova'] = 'Sistema/TarefaController/nova';
$route['tarefa/nova/(:num)'] = 'Sistema/TarefaController/nova';
$route['tarefa/cadastrar'] = 'Sistema/TarefaController/cadastrar';
$route['tarefa/listar'] = 'Sistema/TarefaController/listar';
$route['tarefa/listar/(:num)'] = 'Sistema/TarefaController/listar';
$route['tarefa/editar/(:num)'] = 'Sistema/TarefaController/editar/$1';
$route['tarefa/actualizar'] = 'Sistema/TarefaController/actualizar';
$route['tarefa/eliminar/(:num)'] = 'Sistema/TarefaController/eliminar/$1';
$route['tarefa/detalhe/(:num)'] = 'Sistema/TarefaController/detalhe/$1';
$route['tarefa/percentagem/(:num)'] = 'Sistema/TarefaController/percentagem/$1';
$route['tarefa/actualizarnivel'] = 'Sistema/TarefaController/actualizarnivel';

/*
 * MÓDULO GESTOR DE EVENTOS
 */
/* Grupo Sistema=>Eventos=>Tipo de Evento- Hilquias Chitazo */
$route['tipoevento/nova'] = 'Sistema/TipoeventoController/nova';
$route['tipoevento/nova/(:num)'] = 'Sistema/TipoeventoController/nova';
$route['tipoevento/cadastrar'] = 'Sistema/TipoeventoController/cadastrar';
$route['tipoevento/listar'] = 'Sistema/TipoeventoController/listar';
$route['tipoevento/listar/(:num)'] = 'Sistema/TipoeventoController/listar';
$route['tipoevento/editar/(:num)'] = 'Sistema/TipoeventoController/editar/$1';
$route['tipoevento/actualizar'] = 'Sistema/TipoeventoController/actualizar';
$route['tipoevento/eliminar/(:num)'] = 'Sistema/TipoeventoController/eliminar/$1';
$route['tipoevento/procurar'] = 'Sistema/TipoeventoController/procurar';
$route['tipoevento/transacao/(:num)'] = 'Sistema/TipoeventoController/transacao/$1';

/* Grupo Sistema=>Eventos=>Tipo de Evento- Hilquias Chitazo */
$route['evento/nova'] = 'Sistema/EventoController/nova';
$route['evento/nova/(:num)'] = 'Sistema/EventoController/nova';
$route['evento/cadastrar'] = 'Sistema/EventoController/cadastrar';
$route['evento/listar'] = 'Sistema/EventoController/listar';
$route['evento/listar/(:num)'] = 'Sistema/EventoController/listar';
$route['evento/editar/(:num)'] = 'Sistema/EventoController/editar/$1';
$route['evento/actualizar'] = 'Sistema/EventoController/actualizar';
$route['evento/eliminar/(:num)'] = 'Sistema/EventoController/eliminar/$1';
$route['evento/procurar'] = 'Sistema/EventoController/procurar';
$route['evento/transacao/(:num)'] = 'Sistema/EventoController/transacao/$1';


/*
 * MÓDULO COMUNICAÇÃO E INFORMAÇÃO
 */
/* Grupo Sistema=>Comunicacao/informacao=>noticia- Hilquias Chitazo */
$route['noticia/nova'] = 'Sistema/NoticiaController/nova';
$route['noticia/nova/(:num)'] = 'Sistema/NoticiaController/nova';
$route['noticia/cadastrar'] = 'Sistema/NoticiaController/cadastrar';
$route['noticia/listar'] = 'Sistema/NoticiaController/listar';
$route['noticia/listar/(:num)'] = 'Sistema/NoticiaController/listar';
$route['noticia/editar/(:num)'] = 'Sistema/NoticiaController/editar/$1';
$route['noticia/actualizar'] = 'Sistema/NoticiaController/actualizar';
$route['noticia/eliminar/(:num)'] = 'Sistema/NoticiaController/eliminar/$1';
$route['noticia/procurar'] = 'Sistema/NoticiaController/procurar';
$route['noticia/transacao/(:num)'] = 'Sistema/NoticiaController/transacao/$1';
$route['noticia/importar'] = 'Sistema/NoticiaController/importar';
$route['noticia/exportar'] = 'Sistema/NoticiaController/exportar';




/*
 * MÓDULO MENSAGENS/SMS
 */
/* Grupo Sistema=>Mensagem=>Correio- Hilquias Chitazo */

$route['correio/caixa'] = 'Sistema/CorreioController/caixa';
$route['correio/caixa/(:num)'] = 'Sistema/CorreioController/caixa';
$route['correio/email'] = 'Sistema/CorreioController/email';
$route['correio/emailsuporte'] = 'Sistema/CorreioController/emailsuporte';
$route['correio/emailmassa'] = 'Sistema/CorreioController/emailmassa';
$route['correio/ver/(:num)'] = 'Sistema/CorreioController/ver/$1';
$route['correio/cadastrar'] = 'Sistema/CorreioController/cadastrar';
$route['correio/emaillicenca'] = 'Sistema/CorreioController/emaillicenca';
$route['correio/cadastraremailmassa'] = 'Sistema/CorreioController/cadastraremailmassa';
$route['correio/eliminar/(:num)'] = 'Sistema/CorreioController/eliminar/$1';



/* Grupo Sistema=>Mensagem=>Mensagem- Hilquias Chitazo */
$route['mensagem/agente'] = 'Sistema/MensagemController/agente';
$route['mensagem/nova/(:num)'] = 'Sistema/MensagemController/nova/$1';
$route['mensagem/cadastrar'] = 'Sistema/MensagemController/cadastrar';
$route['mensagem/listar'] = 'Sistema/MensagemController/listar';
$route['mensagem/listar/(:num)'] = 'Sistema/MensagemController/listar';
$route['mensagem/editar/(:num)'] = 'Sistema/MensagemController/editar/$1';
$route['mensagem/actualizar'] = 'Sistema/MensagemController/actualizar';
$route['mensagem/eliminar/(:num)'] = 'Sistema/MensagemController/eliminar/$1';
$route['mensagem/procurar'] = 'Sistema/MensagemController/procurar';
$route['mensagem/transacao/(:num)'] = 'Sistema/MensagemController/transacao/$1';




/*
 * MÓDULO CONFIGURAÇOES
 */
/* Grupo Sistema=>Configurações=>Instituicao- Hilquias Chitazo 28.01.2019 */
$route['instituicao/nova'] = 'Sistema/InstituicaoController/nova';
$route['instituicao/nova/(:num)'] = 'Sistema/InstituicaoController/nova';
$route['instituicao/cadastrar'] = 'Sistema/InstituicaoController/cadastrar';
$route['instituicao/listar'] = 'Sistema/InstituicaoController/listar';
$route['instituicao/listar/(:num)'] = 'Sistema/InstituicaoController/listar';
$route['instituicao/editar/(:num)'] = 'Sistema/InstituicaoController/editar';
$route['instituicao/actualizar'] = 'Sistema/InstituicaoController/actualizar';
$route['instituicao/eliminar/(:num)'] = 'Sistema/InstituicaoController/eliminar';
$route['instituicao/estado/(:num)'] = 'Sistema/InstituicaoController/estado';

/* Grupo Sistema=>Configurações=>Departamento- Hilquias Chitazo */
$route['departamento/nova'] = 'Sistema/DepartamentoController/nova';
$route['departamento/nova/(:num)'] = 'Sistema/DepartamentoController/nova';
$route['departamento/cadastrar'] = 'Sistema/DepartamentoController/cadastrar';
$route['departamento/listar'] = 'Sistema/DepartamentoController/listar';
$route['departamento/listar/(:num)'] = 'Sistema/DepartamentoController/listar';
$route['departamento/editar/(:num)'] = 'Sistema/DepartamentoController/editar/$1';
$route['departamento/actualizar'] = 'Sistema/DepartamentoController/actualizar';
$route['departamento/eliminar/(:num)'] = 'Sistema/DepartamentoController/eliminar/$1';
$route['departamento/procurar'] = 'Sistema/DepartamentoController/procurar';
$route['departamento/transacao/(:num)'] = 'Sistema/DepartamentoController/transacao/$1';

/* Grupo Sistema=>Configurações=>Cargo- Hilquias Chitazo */
$route['cargo/nova'] = 'Sistema/CargoController/nova';
$route['cargo/nova/(:num)'] = 'Sistema/CargoController/nova';
$route['cargo/cadastrar'] = 'Sistema/CargoController/cadastrar';
$route['cargo/listar'] = 'Sistema/CargoController/listar';
$route['cargo/listar/(:num)'] = 'Sistema/CargoController/listar';
$route['cargo/editar/(:num)'] = 'Sistema/CargoController/editar/$1';
$route['cargo/actualizar'] = 'Sistema/CargoController/actualizar';
$route['cargo/eliminar/(:num)'] = 'Sistema/CargoController/eliminar/$1';

/* Grupo Sistema=>Configurações=>Fornecedor- Hilquias Chitazo */
$route['fornecedor/nova'] = 'Sistema/FornecedorController/nova';
$route['fornecedor/nova/(:num)'] = 'Sistema/FornecedorController/nova';
$route['fornecedor/cadastrar'] = 'Sistema/FornecedorController/cadastrar';
$route['fornecedor/listar'] = 'Sistema/FornecedorController/listar';
$route['fornecedor/listar/(:num)'] = 'Sistema/FornecedorController/listar';
$route['fornecedor/editar/(:num)'] = 'Sistema/FornecedorController/editar/$1';
$route['fornecedor/actualizar'] = 'Sistema/FornecedorController/actualizar';
$route['fornecedor/eliminar/(:num)'] = 'Sistema/FornecedorController/eliminar/$1';
$route['fornecedor/procurar'] = 'Sistema/FornecedorController/procurar';
$route['fornecedor/transacao/(:num)'] = 'Sistema/FornecedorController/transacao/$1';

/* Grupo Sistema=>Configurações=>Sub_Desc- Hilquias Chitazo */
$route['sub_desc/nova'] = 'Sistema/Sub_DescController/nova';
$route['sub_desc/nova/(:num)'] = 'Sistema/Sub_DescController/nova';
$route['sub_desc/cadastrar'] = 'Sistema/Sub_DescController/cadastrar';
$route['sub_desc/listar'] = 'Sistema/Sub_DescController/listar';
$route['sub_desc/listar/(:num)'] = 'Sistema/Sub_DescController/listar';
$route['sub_desc/editar/(:num)'] = 'Sistema/Sub_DescController/editar/$1';
$route['sub_desc/actualizar'] = 'Sistema/Sub_DescController/actualizar';
$route['sub_desc/eliminar/(:num)'] = 'Sistema/Sub_DescController/eliminar/$1';
$route['sub_desc/procurar'] = 'Sistema/Sub_DescController/procurar';
$route['sub_desc/transacao/(:num)'] = 'Sistema/Sub_DescController/transacao/$1';

/* Grupo Sistema=>Configurações=>Utilizador- Hilquias Chitazo */
$route['alterar'] = 'Sistema/UtilizadorController/alterarPass';
$route['new'] = 'Sistema/UtilizadorController/newPass';
$route['utilizador/nova'] = 'Sistema/UtilizadorController/nova';
$route['utilizador/nova/(:num)'] = 'Sistema/UtilizadorController/nova';
$route['utilizador/cadastrar'] = 'Sistema/UtilizadorController/cadastrar';
$route['utilizador/listar'] = 'Sistema/UtilizadorController/listar';
$route['utilizador/listarajax'] = 'Sistema/UtilizadorController/listarajax';
$route['utilizador/procurar'] = 'Sistema/UtilizadorController/procurar';
$route['utilizador/procurarAll'] = 'Sistema/UtilizadorController/procurarAll';
$route['utilizador/listar/(:num)'] = 'Sistema/UtilizadorController/listar';
$route['utilizador/editar/(:num)'] = 'Sistema/UtilizadorController/editar/$1';
$route['utilizador/redifinirsenha/(:num)'] = 'Sistema/UtilizadorController/redifinirSenha/$1';
$route['utilizador/actualizar'] = 'Sistema/UtilizadorController/actualizar';
$route['utilizador/eliminar/(:num)'] = 'Sistema/UtilizadorController/eliminar/$1';
$route['utilizador/imprimir/(:num)'] = 'Sistema/UtilizadorController/imprimir/$1';

/* Grupo Sistema=>Configurações=>Perfil- Hilquias Chitazo */
$route['perfil/nova'] = 'Sistema/PerfilController/nova';
$route['perfil/nova/(:num)'] = 'Sistema/PerfilController/nova';
$route['perfil/cadastrar'] = 'Sistema/PerfilController/cadastrar';
$route['perfil/listar'] = 'Sistema/PerfilController/listar';
$route['perfil/listar/(:num)'] = 'Sistema/PerfilController/listar';
$route['perfil/editar/(:num)'] = 'Sistema/PerfilController/editar/$1';
$route['perfil/actualizar'] = 'Sistema/PerfilController/actualizar';
$route['perfil/eliminar/(:num)'] = 'Sistema/PerfilController/eliminar/$1';
$route['perfil/procurar'] = 'Sistema/PerfilController/procurar';
$route['perfil/transacao/(:num)'] = 'Sistema/PerfilController/transacao/$1';

/* Grupo Sistema=>Configurações=>Modulo- Hilquias Chitazo */
$route['modulo/listar'] = 'Sistema/ModuloController/listar';
$route['modulo/listar/(:num)'] = 'Sistema/ModuloController/listar';
$route['modulo/activar/(:num)'] = 'Sistema/ModuloController/activar/$1';
$route['modulo/desactivar/(:num)'] = 'Sistema/ModuloController/desactivar/$1';
$route['modulo/procurar'] = 'Sistema/ModuloController/procurar';
$route['modulo/transacao/(:num)'] = 'Sistema/ModuloController/transacao/$1';

/* Grupo Sistema=>Configurações=>Associar- Hilquias Chitazo */
$route['associar/nova'] = 'Sistema/AssociarController/nova';
$route['associar/nova/(:num)'] = 'Sistema/AssociarController/nova';
$route['associar/cadastrar'] = 'Sistema/AssociarController/cadastrar';
$route['associar/listar'] = 'Sistema/AssociarController/listar';
$route['associar/listar/(:num)'] = 'Sistema/AssociarController/listar';
$route['associar/editar/(:num)'] = 'Sistema/AssociarController/editar/$1';
$route['associar/actualizar'] = 'Sistema/AssociarController/actualizar';
$route['associar/eliminar/(:num)'] = 'Sistema/AssociarController/eliminar/$1';
$route['associar/procurar'] = 'Sistema/AssociarController/procurar';
$route['associar/transacao/(:num)'] = 'Sistema/AssociarController/transacao/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
