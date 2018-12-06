
<?php
function valida_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>
<?php

include("connecta.php");

if($_POST["action"] == "registroForUnity"){
	
	$idNome_R = trim($_POST["idNome"]);
	$email_R  = trim($_POST["email"]);
	$senha_R  = trim($_POST["senha"]);

	$queryVerificUserR = "SELECT * FROM pacienteZERO WHERE nome_Usuario = '$idNome_R'";
	$resultP = mysqli_query($conecta,$queryVerificUserR) or die ('Falhou '. mysqli_error());
	$quantidadeUser = mysqli_num_rows($resultP);

	$senhaCriptografada = password_hash($senha_R, PASSWORD_DEFAULT);

	if ($quantidadeUser == 0) {
		if(valida_email($email_R)){
			$sql = "INSERT INTO pacienteZERO (nome_Usuario, email_Usuario, senha_Usuario) VALUES ('$idNome_R', '$email_R', '$senhaCriptografada')";
			mysqli_query($conecta,$sql) or die ('Falhou '. mysqli_error());
			$msguser = "Usuario registrado com sucesso";
		}else{
			$msgemail ="email invalido";
		}
	}else{
		if(valida_email($email_R)== false){
			$msgemail ="email invalido";
		}
		$msguser = "usuario ja cadastrado";
	}
	echo $msguser."  ".$msgemail;


	

}

if($_POST["action"]== "LoginForUnity"){

	$idNome_L =trim($_POST["idNome"]);
	$senha_L  =trim($_POST["senha"]);

	$queryVerificUserL = "SELECT * FROM pacienteZERO WHERE nome_Usuario = '$idNome_L'";
	$resultP = mysqli_query($conecta,$queryVerificUserL) or die ('Falhou '. mysqli_error());
	$quantidadeUser = mysqli_num_rows($resultP);

	if($quantidadeUser == 1){
		$rows = mysqli_fetch_assoc($resultP);
		if (password_verify($senha_L,trim($rows['senha_Usuario']))) {
			echo"senha correta";
		}else{
			echo"senha incorreta";
		}
	}else{
		
		echo "Usuario não registrado";
	}
}

?>