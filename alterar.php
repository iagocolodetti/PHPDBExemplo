<!DOCTYPE html>
<!--    iagocolodetti   -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP DB Exemplo - Alterar/Atualizar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid center">
            <div class="row justify-content-center">
                <div class="form-group text-center">
                    <h4>Alterar/Atualizar</h4>
                </div>
            </div>
            <?php
                error_reporting(E_ERROR | E_PARSE); // Para não mostrar erros/avisos do próprio PHP

                require_once 'Contato.php';
                require_once 'ContatoDAO.php';

                $id = isset($_POST["id"]) ? $_POST["id"] : "";
                $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
                $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
                $email = isset($_POST["email"]) ? $_POST["email"] : "";

                $cdao = new ContatoDAO();
                
                if ($id != null) {
                    print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                    if ($nome != "" || $telefone != "" || $email != "") {
                        $contato = new Contato($id, $nome, $telefone, $email);
                        $alterar = $cdao->alterar($contato);
                        if (!$alterar) {
                            printf("<div class=\"alert alert-success\" role=\"alert\">Contato de ID '%s' alterado/atualizado.</div>", $id);
                            $id = "";
                            $nome = "";
                            $telefone = "";
                            $email = "";
                        } elseif ($alterar == "erroUP") {
                            printf("<div class=\"alert alert-secondary\" role=\"alert\">Não existe contato com ID '%s'.</div>", $id);
                        } elseif ($alterar == "erroCONN") {
                            print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível alterar/atualizar o contato. Erro de Conexão.</div>");
                        } elseif ($alterar == "erroSQL") {
                            print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível alterar/atualizar o contato. Erro de SQL.</div>");
                        }
                    } else { 
                        print("<div class=\"alert alert-secondary\" role=\"alert\">Nenhum campo foi preenchido.</div>");
                    }
                    print("</div></div><br>");
                }
                
                print("<form action=\"alterar.php\" method=\"POST\">");
                printf("<div class=\"row justify-content-center\">
                            <div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">
                                <h5><a href=\"index.html\" class=\"badge badge-pill badge-secondary text-center\">Voltar</a></h5><br>
                                <div class=\"form-group text-center\">
                                    <label for=\"id\">ID</label>
                                    <input type=\"number\" min=\"0\" class=\"form-control text-center\" name=\"id\" id=\"id\" value=\"%s\" required/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <label for=\"nome\">Novo Nome</label>
                                    <input type=\"text\" class=\"form-control text-center\" name=\"nome\" id=\"nome\" value=\"%s\"/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <label for=\"telefone\">Novo Telefone</label>
                                    <input type=\"text\" class=\"form-control text-center\" name=\"telefone\" id=\"telefone\" value=\"%s\"/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <label for=\"email\">Novo Email</label>
                                    <input type=\"email\" class=\"form-control text-center\" name=\"email\" id=\"email\" value=\"%s\"/>
                                </div>
                                <div class=\"form-group text-center\">
                                    <input type=\"submit\" class=\"btn btn-primary text-center\" value=\"Alterar/Atualizar\"/>
                                </div>
                            </div>
                        </div>", $id, $nome, $telefone, $email);
                print("</form>");
                
                $contatos = $cdao->buscarTodos();
                print("<div class=\"row justify-content-center\"><div class=\"form-group col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center\">");
                if ($contatos != null) {
                    print("<div class=\"table-responsive\"><table class=\"table table-bordered table-sm\"><thead><tr><th>ID</th><th>NOME</th><th>TELEFONE</th><th>EMAIL</th></tr></thead><tbody>");
                    foreach ($contatos as $contato) {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $contato->getID(), $contato->getNome(), $contato->getTelefone(), $contato->getEmail());
                    }
                    print("</tbody></table></div>");
                } elseif ($contatos == null) {
                    print("<div class=\"alert alert-secondary\" role=\"alert\">Não existem contatos no banco de dados.</div>");
                } elseif ($contatos == "erroCON") {
                    print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de Conexão.</div>");
                } elseif ($contatos == "erroSQL") {
                    print("<div class=\"alert alert-danger\" role=\"alert\">Não foi possível adicionar o contato. Erro de SQL.</div>");
                }
                print("</div></div>");
            ?>
        </div>
    </body>
</html>
