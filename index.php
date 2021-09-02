<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/index.css">
   <link rel="shortcut icon" href="img/ico_escolaA1.ico" type="image/x-icon">
   <style>
      body h1:nth-child(2n){
         /*color: #f01;
         text-shadow: 20px 20px 22px  #000;

          text-stroke-width: 2px; */
      }
   </style>

   <title>sistema escolar</title>

   <!-- chamando o php de conexao onde estão os dados do banco de dados e de conexao.
      chamando com require "" ou include
   -->
   <?php require "./conexao.php" ?>
   
</head>

<body>
   <div id="logo">
      <img src="img/logo.png" alt="logotipo">
   </div>
   
   <div id="caixa_login">
      

     <?php
         #vamos verificar se existe o arquivo
         if (file_exists("./conexao.php")) {
            echo "<p style='background: green; color: #fff; text-shadow: 2px 1px 1px #719724; font-size: 18px; text-align: center;'>sim existe o arquivo</p>";
         }
         else {
            echo "<p style='background: #F30; color: #f2ff2f; text-shadow: 2px 1px 1px #719724; font-size: 18px; text-align: center;'>não existe este arquivo</p>";
         }
     
     
         #PHP PARA TRATA DADOS DO POST DO FORMULARIO DE CONEXAO COM BANCO DE DADOS MYSQL
         #VER QUAL CAMPO VAZIO E INFORMA O USUÁRIO PRA PREENCHER
         if (isset($_POST['button'])) {

            $code = $_POST['code'];
            $password = $_POST['password'];

            if ($code == '') {
               echo "<h3 class='error'> por favor digite Nº cartao ou Código acesso </h3>";
            }

            else if ($password == '') {
               echo "<h3 class='error'> por favor digite a sua senha*  </h3>";
            }
            
            #SE NÃO TIVER DADOS LÁ VAMOS MOSTRA N
            else {
               # passando a consulta para uma variavel
               $sql = "SELECT * FROM login WHERE code = '$code' AND senha = '$password'";
               
               # recebendo a consulta do mysqli
               $result = mysqli_query($conexao, $sql);
               

               // tenmos problemas nesse IF aqui
               if (mysqli_num_rows($result) > 0) {
                  
                  while($res_1 = mysqli_fetch_assoc($result)){                
                     $status = $res_1['status'];
                     $code = $res_1['code'];
                     $senha = $res_1['senha'];
                     $nome = $res_1['nome'];
                     $painel = $res_1['painel']; 

                     if ($status == 'Inativo') {
                        echo "<h5>voce esta inativo, procura a administração</h5>";
                     } #end if status
                     else {
                        $session_start();
                        $_SESSION['code'] = $code;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['nome'] = $nome;
                        $_SESSION['painel'] = $painel;
                       
                     }#end else session start and _SESSION
                  
                  } # fim do while
               
               } #fim do if myqli num rows

               # o senao do SE de mysqli
               else { 
                  echo"<h3>sem dados, ou incorreto</h3>";
               } # fim do else do if do mysqli

            } #fim do else se nao tiver dados

         } #fim do if da busca de dados do POST isset() do button
         
      ?>

     <form action="" name="form" method="post" enctype="multipart/forma-data">
        <table>
           <tr>
              <td><h1>N° cartão ou código de acesso: </h1> </td>
           </tr>
           
           <tr>
              <td><input type="text" name="code"></td>
           </tr>
           
           <tr>
              <td>
                 <h1>senha: </h1>
              </td>
           </tr>
           
           <tr>
              <td><input type="password" name="password"></td>
           </tr>
           
           <tr>
              <td>
                 <input class="input" type="submit" name="button" value="Entrar"></td>
            </tr>
           
        </table>
     </form>
  </div>
   
   <script src="js/script.js"></script>
</body>
</html>