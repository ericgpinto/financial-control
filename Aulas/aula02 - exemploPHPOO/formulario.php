<!DOCTYPE html>
<html> 
	<head>
		<title>Formulário de cadastro</title>

		<style type="text/css">
		
			body { font-family: arial; }
			fieldset { width: 330px; margin: auto; border: 1px dashed #666699; }
			legend { font-size: 14px; font-weight: bold; color: #666699; padding: 10px; }
			label { font-size: 12px; display: inline-block; width: 120px; }
			input { margin-bottom: 20px; border: 1px solid #999; width: 200px; }
			input[type="radio"] { display: inline; width: 10px;  }
			input[type="submit"] { width: 120px; margin-left: 33%; margin-top: 20px; background-color: #666699; color: #ffffff; font-size: 14px; }
			.inline { display: inline; width: 50px; margin-right: 20px; }
			#dadospj, #dadospf { display: none; }

		</style>

	</head>
	<body>

		<fieldset>
			<legend>CADASTRO</legend>

			<form action="cadastrar.php" method="post">
				
				<input name="tipo" id="tipoPF" value="PF" type="radio" required>
				<label for="tipoPF" class="inline">Pessoa Física</label>

				<input name="tipo" id="tipoPJ" value="PJ" type="radio"  required>
				<label for="tipoPJ" class="inline">Pessoa Jurídica</label><br>

				<label for="id">Identificador:</label>
				<input name="id" id="id" type="text" required><br>

				<label for="nome">Nome:</label>
				<input name="nome" id="nome" type="text" required><br>

				<!-- type do tipo "email" valida sintaxe -->
				<label for="email">Email:</label>
				<input name="email" id="email" type="email" required><br>

				<label for="senha">Senha:</label>
				<input name="senha" id="senha" type="password" required><br>

				<div id="dadospj">
					<label for="cpf">CPF:</label>
					<input name="cpf" id="cpf" type="text"><br>
					<label for="datanasc">Data de Nascimento:</label>
					<input name="datanasc" id="datanasc" type="text"><br>
				</div>

				<div id="dadospf">
					<label for="cnpj">CNPJ:</label>
					<input name="cnpj" id="cnpj" type="text"><br>
					<label for="razaosocial">Razão Social:</label>
					<input name="razaosocial" id="razaosocial" type="text"><br>
				</div>

				<input name="acao" type="submit" value="Cadastrar">
			
			</form>

		</fieldset>

		<script type="text/javascript">

			document.getElementById("tipoPF").addEventListener("click", function () {
				document.getElementById("dadospj").style.display = "block";
				document.getElementById("dadospf").style.display = "none";
			});

			document.getElementById("tipoPJ").addEventListener("click", function () {
				document.getElementById("dadospf").style.display = "block";
				document.getElementById("dadospj").style.display = "none";
			});

		</script>


	</body>
</html>