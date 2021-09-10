<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <?php 
      require "conexao.php";

      @session_start();

      

      $code = $_SESSION['code'];
      $senha = $_SESSION['senha'];
      $nome = $_SESSION['nome'];
      $painel = $_SESSION['painel'];
      
      if($code == ''){
         echo "<script language='javascript'>window.location='../index.php';</script>";	}
         
         else if($nome == ''){
         echo "<script language='javascript'>window.location='../index.php';</script>";
         
      } else if($senha == ''){
         echo "<script language='javascript'>window.location='../index.php';</script>";
      }
      
   ?>

</body>
</html>