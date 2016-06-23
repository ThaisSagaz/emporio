<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
         // Destrói a sessão por segurança
         session_destroy();
         // Redireciona o visitante de volta pro login
         header("Location: index.php"); exit;
        }

require '../conexao/database.php';

?>
<div class="container">

    			<div class="span10 offset1">
    				<div class="row">

<span class="help-inline"></span>
				<span class="help-inline"></span>
								<h3>Cadastrar categorias da Ficha Técnica</h3<
							<span class="help-inline"></span>
							<span class="help-inline"></span>
							<span class="help-inline"></span>
		    		</div>

	    			<form class="form-horizontal" action="../DAO/Cadastrar_categoria_ficha_tecnica_DAO.php" method="post">
					  <div class="control-group">
							<label class="control-label">Nome da Categoria:</label> <span> </span> <span> </span>

							<span class="help-inline"></span>
						      	<input name="categoria" type="text" required="required" placeholder="Ex.: Decoração" value="">

						      		<span class="help-inline"></span>

						    </div></br>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-success">Criar</button>
								<a class="btn btn-default" href="../categoria_ficha_tecnica.php">Voltar</a>
							</div>
						</form>
</div>