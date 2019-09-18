<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulários</title>

        <style type="text/css">
                @import "css/geral.css";
        </style>
    </head>
    <body>
    
        <?php

        include 'class/Categoria.php';
        include 'class/Produto.php';

        echo "<h2>Categorias</h2>";

        $cat[] = new Categoria(1, "Periféricos");
        $cat[] = new Categoria(2, "Notebooks");
        $cat[] = new Categoria(3, "Computadores");
        $cat[] = new Categoria(4, "Impressoras");

        $tcat = "<table>"
               ."<tr>"
               ."<th>Código</th>"
               ."<th>Descrição</th>"
               ."</tr>";
        $i = 0;
        while($i < count($cat)) {
            $tcat .= "<tr>";
            $tcat .= "<td>".$cat[$i]->codigo."</td>";
            $tcat .= "<td>".$cat[$i]->nome."</td>";
            $tcat .= "</tr>";       
            $i++;
        }
        $tcat .= "</table>";

        echo $tcat;

        echo "<h2>Produtos</h2>";

        $prod[] = new Produto(1, "Mouse ótico Microsoft", 89.90, $cat[0]);
        $prod[] = new Produto(2, "Impressora HP Laser 1320", 850.00, $cat[3]);
        $prod[] = new Produto(3, "Macbook Pro", 4200.00, $cat[1]);
        $prod[] = new Produto(4, "Teclado sem fio Genius", 110.00, $cat[0]);
        $prod[] = new Produto(5, "Computador Lenovo", 2100.00, $cat[2]);

        $tprod = "<table>"
               . "<tr>"
               . "<th>Código</th>"
               . "<th>Descrição</th>"
               . "<th>Valor</th>"
               . "<th>Categoria</th>"
               . "</tr>";

        $total = 0;

        foreach ($prod as $p) {
            $tprod .= "<tr>";
            $tprod .= "<td>".$p->codigo."</td>";
            $tprod .= "<td>".$p->nome."</td>";
            $tprod .= "<td>".$p->valor."</td>";
            $tprod .= "<td>".$p->categoria->nome."</td>";
            $tprod .= "</tr>";
            $total = $total + $p->valor;
        }

        $media = $total/count($prod);

        $tprod .= "<tr><td colspan='4' class='total'><b>MÉDIA DE VALORES:</b> ".$media."</td></tr>";
        $tprod .= "</table>";

        echo $tprod;

        ?>
    </body>
</html>
