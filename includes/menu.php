<!doctype html>

<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
<?php

if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: inicio.php"); exit;
}
?>
<head>


    <meta charset="UTF-8">
    <title>Menu Empório das Tortas</title>
 


    <script type="text/javascript">


        function onload_pagina(){
            var acessoUser="<?php echo $_SESSION['UsuarioAcesso']; ?>";

            if (acessoUser == "Vendas") {

                changePermissaoMenuVendas();
            }
            if (acessoUser == "Producao"){
              changePermissaoMenuProducao();
            }
        }


        function changePermissaoMenuVendas() {
            var escUsuario = document.getElementById('controlUser');
            var escCliente = document.getElementById('controlCliente');
            var escProduto = document.getElementById('controlProduct');
            var escTipoProd = document.getElementById('controlTipoProduct');
            var escCtg_Ficha = document.getElementById('ctg_Ficha');
            var escMficha_tecnica = document.getElementById('mficha_tecnica');
            var escMregistro_saida = document.getElementById('mregistro_saida');
            var escMproduto_final = document.getElementById('mproduto_final');
            var escM_cad_ing = document.getElementById('m_cad_ing');
            var escM_realizar_compra = document.getElementById('m_realizar_compra');
            var escRelEstoque = document.getElementById('relEstoque');
            var escRelFicha = document.getElementById('relficha');
            escCtg_Ficha.style.display = "none";
            escMficha_tecnica.style.display = "none";
            escMregistro_saida.style.display = "none";
            escMproduto_final.style.display = "none";
            escM_cad_ing.style.display = "none";
            escM_realizar_compra.style.display = "none";
            escUsuario.style.display = "none";
            escCliente.style.display = "none";
            escProduto.style.display = "none";
            escTipoProd.style.display = "none";
            escRelEstoque.style.display = "none";
            escRelFicha.style.display = "none";

        }
        function changePermissaoMenuProducao () {
            var escVendas = document.getElementById('realizarVenda');
            var escEstoqueLoja = document.getElementById('EstoqueLoja');
            var escRelVendas = document.getElementById('relVendas');
            var escUsuario = document.getElementById('controlUser');
            var escCliente = document.getElementById('controlCliente');
            var escProduto = document.getElementById('controlProduct');
            var escTipoProd = document.getElementById('controlTipoProduct');
            escVendas.style.display = "none";
            escEstoqueLoja.style.display = "none";
            escRelVendas.style.display = "none";
            escUsuario.style.display = "none";
            escCliente.style.display = "none";
            escProduto.style.display = "none";
            escTipoProd.style.display = "none";
        }
    </script>
    <style>
        .estoque{
            display: none;
        }
    </style>


</head>

<body onload="onload_pagina();">
<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->

          <!-- search form (Optional) -->

          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MENU DE NAVEGAÇÃO</li>
            <!-- Optionally, you can add icons to the links -->
              <li class="active treeview">
                <a href="inicio.php">
                  <i class="fa fa-home"></i> <span>Inicio</span></i>
                </a>
              </li>
              <li id="Venda" class="active treeview">
                <a href="vendas.php">
                  <i class="fa fa-tags"></i> <span>Vendas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="" id="EstoqueLoja"><a href="entrada_produto.php"><i class="fa fa-circle-o"></i> Entrada de Produtos </a></li>
                  <li id="realizarVenda" ><a href="realizar_venda.php"><i class="fa fa-circle-o"></i> Realizar Venda</a></li>
                </ul>
              </li>
              <li id="realizarEncomendas" class="active treeview">
                <a href="encomendas.php">
                  <i class="fa fa-calendar"></i> <span>Encomendas</span></i>
                </a>
              </li>
              <li id="ficha" class="active treeview">
                <a href="vizualizar_ficha_tecnica.php">
                  <i class="fa fa-folder-open"></i> <span>Ficha Técnica</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul  class="treeview-menu">
                  <li id="ctg_Ficha" class=""><a href="categoria_ficha_tecnica.php"><i class="fa fa-circle-o"></i> Categorias da Ficha Técnica </a></li>
                  <li id="mficha_tecnica" class=""><a href="ficha_tecnica.php"><i class="fa fa-circle-o"></i> Ficha Técnica </a></li>
                  <li id="mproduto_final" class=""><a href="produto_final.php"><i class="fa fa-circle-o"></i> Produto Final </a></li>
                  <li id="mregistro_saida" class=""><a href="registro_saida.php"><i class="fa fa-circle-o"></i> Registro de Saída </a></li>
                </ul>
              </li>
              <li id="MenuEstoque" class="active treeview">
                <a href="vizualizar_estoque.php">
                  <i class="fa fa-cubes"></i> <span>Estoque </span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul id="EscEstoque" class="treeview-menu">
               
                  <li id="m_cad_ing" class=""><a href="estoque.php"><i class="fa fa-circle-o"></i> Cadastrar Ingrediente </a></li>
                  <li id="m_realizar_compra" class=""><a href="cadastrar_nova_compra.php"><i class="fa fa-circle-o"></i> Realizar Nova Compra </a></li>
                </ul>
              </li>
              <li class="active treeview">
                <a href="relatorio.php">
                  <i class="fa fa-bar-chart"></i> <span>Relatorio</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li id="relEncomendas" class=""><a href="exibir_relatorio_encomendas.php"><i class="fa fa-circle-o"></i> Encomendas </a></li>
                  <li id="relVendas" class=""><a href="exibir_relatorio_vendas.php"><i class="fa fa-circle-o"></i> Vendas </a></li>
                  <li id="relPerdas" class=""><a href="exibir_relatorio_perdas.php"><i class="fa fa-circle-o"></i> Perdas </a></li>
                  <li id="relEstoque" class=""><a href="exibir_relatorio_estoque.php"><i class="fa fa-circle-o"></i> Estoque </a></li>
                  <li id="relficha" class=""><a href="exibir_relatorio_ficha_tecnica.php"><i class="fa fa-circle-o"></i> Ficha Técnica </a></li>
                </ul>
              </li>
              <li id="admin" class="active treeview">
                <a href="#">
                  <i class="fa fa-user"></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li id="controlUser" class=""><a href="usuarios.php"><i class="fa fa-circle-o"></i> Usuário </a></li>
                  <li id="controlTipoProduct"class=""><a href="tipo_produto.php"><i class="fa fa-circle-o"></i> Tipo de Produtos </a></li>
                  <li id="controlProduct" class=""><a href="produtos.php"><i class="fa fa-circle-o"></i> Produtos </a></li>
                  <li id="controlCliente" class=""><a href="cliente.php"><i class="fa fa-circle-o"></i> Cliente </a></li>
                </ul>
              </li>
              <li id="alterPassword" class="active treeview">
                <a href="alterarsenha.php">
                  <i class="fa fa-lock"></i> <span>Alterar Senha</span> </i>
                </a>
              </li>
              <li id="manualUser" class="active treeview">
                  <a href="manual/inicio.html">
                  <i class="fa fa-book"></i> <span>Manual do Usuário</span></i>
                </a>
              </li>


          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

    </body>

</html>
