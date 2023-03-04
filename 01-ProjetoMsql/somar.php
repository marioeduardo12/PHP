<?php

    $numero1 = $_POST["numero1"]; //declaração de variaveis(obs: dentro dos colchetes estão sendo passados o NAME do formulario)
    $numero2 = $_POST["numero2"]; //O $_post serve para recuperar o dado enviado pelo formulario para processamento no beck-end

    $valido = true; //variavel boleana para verificação dos numeros estejam fora do especificado(no caso ja esta partindo do principio de que sempre sera true, ou seja, e para controle e inserir no banco de dados, vai verificar se ela pode ser posta no banco ou não)

    $numero1 = intval($numero1);//aqui estamos convertendo string para inteiro


    //Validação dos números no formulario
    if ($numero1 <= 0){
        echo "Numero 1 e invalido<br>";
        $valido = false; /*valido false é variavel boleana para verificar se e
        valido o numero de acordo com o IF acima e se pode ser posta no banco o valor processado*/
    }
    //Validação dos números no formulario
    if ($numero2 <= 0){
        echo "Numero 2 e invalido!<br>";
        $valido = false;/*valido false é variavel boleana para verificar se e
        valido o numero de acordo com o IF acima e se pode ser posta no banco o valor processado*/
    }

    $con = new mysqli("localhost"/* local */, "root"/*usuario */, ""/*senha*/, "devweb2" /*nome do banco*/);
    /* declarar banco(criando uma conexão com o banco)*/
    // o $con e para criar a conexão do banco, seria connection em inglês
    // mysqli serve como classe

    if ($valido) {//caso os numeros digitados forem true esse codigo sera executado, agora se for false esse codigo nao sera executado

        
        $stmt = $con->prepare("INSERT INTO soma(numero1, numero2, resultado) VALUES (?,?,?)");
        //o comando prepare ele serve pra preparar ele é um metodo, que no caso o con está chamando com a seta, e o stmt e pra chamar a execução do banco de dados, ele nao foi executado ainda, após o prepare vem a string que no caso é sql puro
        //o stmt é uma variavel pra execução de um codigo

        $soma = $numero1 + $numero2; //executando a soma 

        $stmt-> bind_param("iii", $numero1, $numero2, $soma); ///o iii serve pra reprensentar a interrogação, e logo após vem variaveis que no caso é oque vai substituir a interrogação
        //a letra representa o inicio de um tipo por exemplo i pra variavel inteira, d para uma double ou s para uma string
        //bind_param é um metodo que serve para poder substituir a interrogação, a função dele é essa
        $stmt-> execute();
        //executando o stmt
        echo "<h1> Resultado armazenado com sucesso!</h1>";
        //esse echo serve para mostrar que o resultado foi armazenado, caso seja true e funcione os numeros colocados, ou seja o resultado foi pro banco
        $stmt -> close();
        //o close serve para fechar a execução do stmt

    }

    $stmt = $con->prepare("SELECT * FROM soma ORDER BY id");
    //esse stmt é a mesma coisa mas dentro dos parenteses é select, nao estou inserindo algo e sim selecionando
    //e como nao estou passando nenhuma interrogação, nao precisa de bind_param
    $stmt->execute();
    //e como nao tem bind_param ja pode executar
    $result = $stmt->get_result();
    //aqui esta recuperando os resultados usando metodo getresult ao stmt instanciando a variavel $result
    echo "<hr>";

    while($row = $result->fetch_array()) { //variavel row vai assumir as linhas digitadas, ou seja, armazena-las e isso acontece, por causa do metodo fetch_array, assim, vai enviar os dados pro row armazenar até acabar todas as linhas existentes, ai sim armazenando um resutado null
        //while vai servir para mostrar no html todos os resultados que ja foram apresentados antes(processamento), assim, mostrando na pagina
        echo "<h1>", $row["numero1"], " + ", $row["numero2"], "=", $row["resultado"], "</h1>";
        //aqui o  row vai pegar o a primeira coluna, somar com a segunda e dar o resultado, mostrando tudo isso la no front-end
    }

    $stmt ->close();

    $result ->close();

    $con->close();
    
    ?>