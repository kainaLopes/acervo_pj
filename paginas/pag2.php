<?php 
  //BUSCA OS DADOS
  //IRAR ACESSAR ARQUIVO CLASSEINSER.INC E ACESSAR A CLASSE inser
  require_once '../classeinser.inc';
  $p = new inser("pj_acervo_kaina","localhost","kaina","C0007");
?>

<!DOCTYPE html>
<html>
<head>
	<title>projeto.acervo.com</title>
  <link rel="stylesheet" type="text/css" href="../estilo/estilo1.css">
   <link rel="stylesheet" type="text/css" href="../estilo/estilo2.css">
	 
</head>
<body>
          <div class="MenuDois">

          <a id="bot" href="../index.php"> 
            <img class="minilivro" src="../imagem/minilivros2.jpg" height="60"/>  Cadastrar
          </a>

          <a id ="bot" href="./pag2.php">
            <img class="minilivro" src="../imagem/minilivros3.jpg" height="60"/>Listar Livros
          </a>

          <a id ="bot" href="./buscar.php">
            <img class="minilivro" src="../imagem/minilivros4.jpg" height="60"/>Buscar Livros
          </a>
          </div>

<?php  

 if(isset($_POST['idedi'])){

    if (isset($_GET['id_up']) && !empty($_GET['id_up'])) 
   {
          $id_up = addslashes($_GET['id_up']);
          $idedi = addslashes($_POST['idedi']);
          $titulo = addslashes($_POST['titulo']);
          $autor = addslashes($_POST['autor']);
          $ano = addslashes($_POST['ano']);
          $preco = addslashes($_POST['preco']);
          $quantidade = addslashes($_POST['quantidade']);
          $tipo = addslashes($_POST['tipo']);

          //se alguma variavel estiver vazia, exibir mensagem de erro
          if (!empty($idedi)&& !empty($titulo)&& !empty($autor)&& !empty($ano)&& !empty($preco)&& !empty($quantidade)&& !empty($tipo)) 
          //se tiver tudo certo, ace
              {
                  $p->atualizardados($id_up, $idedi,$titulo,$autor,$ano,$preco,$quantidade,$tipo);
                  header("location:pag2.php");
              }
          else
          {
            echo "<p id='centro'>Preencha todos os campos </br> Necessario Editora e Tipo Novamente</p>";
          }
    }
 }
//Verificar se clicou para atualizar
  if(isset($_GET['id_up']))
  {
    $idup = addslashes($_GET['id_up']);
    $res= $p->buscardadosacervo($idup);
  }

?>

<section id="direita">

  <table>
    <tr id="titulo">
		<td>Editora</td>
		<td>Titulo</td>
		<td>Autor</td>
		<td>Ano</td>
		<td>preco</td>
		<td>Quantidade</td>
		<td colspan="2">Tipo</td>
	</tr>

    <tr >

<?php // BUSCA DADOS E EXIBE NA PAGINA

      $dados = $p-> buscarDados();
      if (count($dados)>0) //se tem pessoas no banco de dados
      {
        for ($i=0; $i < count($dados); $i++) 
        { 
              echo "<tr>";
              foreach ($dados[$i] as $k => $v) 
              {
                      if (($k =="tipo" ))
                      {
                          switch ($v) 
                          {
                              case '1':
                                   echo "<td>Romance</td>";
                              break;

                              case '2':
                                   echo "<td>Animacao</td>";
                              break;

                              case '3':
                                   echo "<td>Terror</td>";
                              break;

                              case '4':
                                   echo "<td>Acao</td>";
                              break;
							  
							  case '4':
                                   echo "<td>Comedia</td>";
                              break;

                          }


                        }else if (($k =="idEditora" ))   
                              {     
                                
                                $dadeditora = $p ->buscarNedit($v);
                             //   $dadeditora [0]['nome']
                                echo "<td>".$dadeditora [0]['nome']."</td>";
     
                      } else if (($k !="id" ))   //NAO EXIBIR O ID
                              {     
                                echo "<td>".$v."</td>";
                               }
                                
              }
?> 

      <td>    <!-- BOTÃO EDITAR E EXCLUIR   -->

            <a id="bot" href="pag2.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a> <!-- SE CLICAR EM EDITAR, VARIAVEL RES LINHA 20 BUSCA ESSA INFORMACAO -->

            <a id="bot" href="pag2.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>

      </td>


<?php
      echo "</tr>";
    }

  }
  else //O banco esta vazio
  {
    echo "<p id='centro'> Cadastratre!!!: <a href='index.php'>Cadastrar </p> </a>";  
  }
  
?>

      </table>
</section>

<?php

       if(isset($res)){ //SE CLICAR EM EDITAR - EXECUTAR CODIGO HTML ABAIXO

  ?>

    <div id= "centro">
        <p>Alterar dados</p>
      <form method="POST">

        <label > Editora</label>

                  <select name="idedi">
                  <option></option>
          <?php 

                    $dado = $p-> buscarPval();
                    $dados = $p-> buscarPuser();
                    if (count($dados)>0) //se tem pessoas no banco de dados
                    {
                      for ($i=0; $i < count($dado); $i++) 
                      { 

                         for ($i=0; $i < count($dados); $i++) 
                           { 
     
                               foreach ($dado[$i] as $s => $e) 
                              {
                                   foreach ($dados[$i] as $k => $v) 
                                  { 

                                   echo"<option value='$e' > $v </option>";

                                   }
                              }
                           }
                      }
                    }     
                ?>
              </select>
          <label >Titulo</label>
          <input type="text"
			id="titulo" 
			name="titulo"
			placeholder="Digite o Titulo do livro"
			value="<?php if(isset($res)){echo $res['titulo'];}?>">

          <label >  Autor Livro </label>
          <input type="text" 
			id="autor" 
			name="autor"
			placeholder="Digite o nome do autor"
			value="<?php if(isset($res)){echo $res['autor'];}?>">

          < <label >Ano Publicacao</label>
          <input type="text" 
			class="form-control"
			id="ano" 
			name="ano"
			placeholder="Digite o ano ex.:2012"
			value="<?php if(isset($res)){echo $res['ano'];}?>">

          <label >Valor do Livro</label>
          <input type="text" 
			class="form-control"
			id="valor" 
			name="valor"
			placeholder="Valor do Livro ex.:1.99"
			value="<?php if(isset($res)){echo $res['preco'];}?>">

          <label >Quantidade de Livros</label>
          <input type="text" 
			class="form-control"
			id="quantidade" 
			name="quantidade"
			placeholder="Digite a Quantidade"
			value="<?php if(isset($res)){echo $res['quantidade'];}?>">

          <label>Tipo</label>
          <select name="tipo">

            <option selected>Selecione uma opcao</option>
			<option value="1">Romance</option>
			<option value="2">Animacao</option>
			<option value="3">Terror</option>
			<option value="4">Acao</option>
			<option value="5">Comedia</option>

          </select>


          <input type="submit" value="ATUALIZAR">
      </form>
    </div>

<?php
      }
?>

</body>
</html>


<?php 
//Enviando comando para excluir
  if (isset($_GET['id'])) 
  {
    $id_p = addslashes($_GET['id']);
    $p->excluir($id_p);
    header("location: pag2.php");
  }
?>