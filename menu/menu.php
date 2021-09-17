<div class="container2">
    <ul id="accordion" class="accordion">
    
        <li>
            <fig>
            <div onclick="sair('/SCL/')" class="zonainicio"><i class="fas fa-home"></i>Início</div>
            </fig>
            <div class="listinha"></div>
        </li>
        <li>
            <fig>
            <div class="link"></i><span id="avatarid"><img src="/SCL/assets/img/<?PHP echo $_SESSION['avatar'];?>" alt="Avatar" class="avatar"> &nbsp;<?PHP echo $_SESSION['nome_1'];?><span><i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="/SCL/conf/">Configurações</a></li>
                <?PHP 
                if($_SESSION['tipo'] == 'Admin'){
                    echo "<li><a href='/SCL/conf/admin.php'>Gerenciamento Administrativo</a></li>";
                    echo "<li><a href='/SCL/conf/comandos.php'>Comandos Zabbix</a></li>";
                }
                if($_SESSION['tipo'] == 'telecom' or $_SESSION['tipo'] == 'Admin'){
                    echo "<li><a href='/SCL/escala/'>Plantão Telecom</a></li>";
                } 
                ?>
                <li><a href="/SCL/logout.php">Logout</a></li>
            </ul>
            </fig>
            <div class="listinha"></div>
        </li>
        <?PHP 
        $path5 = $_SERVER['DOCUMENT_ROOT'];
        $path5 .= "/SCL/menu/grafico.php";

        if($_SESSION['grafAcess'] == 1 or $_SESSION['tipo'] == 'Admin'){
            include($path5);
        }
        ?>
        <?PHP 
        $path5 = $_SERVER['DOCUMENT_ROOT'];
        $path5 .= "/SCL/menu/disp.php";

        if($_SESSION['admDisp'] == 1 or $_SESSION['tipo'] == 'Admin'){
            include($path5);
        }
        ?>
        <?PHP 
        $path4 = $_SERVER['DOCUMENT_ROOT'];
        $path4 .= "/SCL/menu/banco.php";

        if($_SESSION['telecom'] == 1 or $_SESSION['tipo'] == 'Admin'){
            include($path4);
        }
        ?>
        <li>
            <fig>
            <div onclick="sair('http://10.5.90.139:3000/')" class="zonainicio"><i class="fab fa-elementor"></i>Link Grafana</div>
            </fig>
            <div class="listinha"></div>
        </li>
        <?PHP 
        $path3 = $_SERVER['DOCUMENT_ROOT'];
        $path3 .= "/SCL/menu/cadastroOS.php";
        $path2 = $_SERVER['DOCUMENT_ROOT'];
        $path2 .= "/SCL/menu/zabbix.php";
        

        if($_SESSION['telecom'] == 1 or $_SESSION['tipo'] == 'Admin'){
            include($path3);
        }

        if($_SESSION['telecom'] == 1 or $_SESSION['tipo'] == 'Admin'){
            include($path2);
        }
        ?>
        
    </ul>
</div>