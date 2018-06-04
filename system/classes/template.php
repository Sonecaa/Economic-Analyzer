<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 02/03/2018
 * Time: 11:23
 */

class Template
{

    function header()
    {
        echo "<!doctype html>
<html lang='en'>
<head>
	<meta charset='utf-8' />
	<link rel='apple-touch-icon' sizes='76x76' href='/economic-analyzer/system/assets/img/apple-icon.png'>
	<link rel='icon' type='image/png' sizes='96x96' href='/economic-analyzer/system/assets/img/favicon.png'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

	<title>EconomiC Analyzer</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name='viewport' content='width=device-width' />

    <!-- Bootstrap core CSS     -->
    <link href='/economic-analyzer/system/assets/css/bootstrap.min.css' rel='stylesheet' />

    <!-- Animation library for notifications   -->
    <link href='/economic-analyzer/system/assets/css/animate.min.css' rel='stylesheet'/>

    <!--  Paper Dashboard core CSS    -->
    <link href='/economic-analyzer/system/assets/css/paper-dashboard.css' rel='stylesheet'/>

    <!--  Fonts and icons     -->
    <link href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href='/economic-analyzer/system/assets/css/themify-icons.css' rel='stylesheet'>

</head>
<body>";

    }

    function footer()
    {
        echo " <footer class=\"footer\">
            <div class=\"container-fluid\">
                <nav class=\"pull-left\">
                    <ul>

                        <li>
                            <a href=\"http://www.viannajr.edu.br\" target='_blank'>
                                Instituto Vianna Júnior
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class=\"copyright pull-right\">
                    &copy; <script>document.write(new Date().getFullYear())</script>, template made with <i class=\"fa fa-heart heart\"></i> by <a href=\"http://www.creative-tim.com\" target='_blank'>Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>
</body>

    <!--   Core JS Files   -->
    <script src=\"/economic-analyzer/system/assets/js/jquery-1.10.2.js\" type=\"text/javascript\"></script>
	<script src=\"/economic-analyzer/system/assets/js/bootstrap.min.js\" type=\"text/javascript\"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src=\"/economic-analyzer/system/assets/js/bootstrap-checkbox-radio.js\"></script>

</html>";

    }

    function sidebar()
    {
        echo "<div class=\"wrapper\">
        <div class=\"sidebar\" data-background-color=\"white\" data-active-color=\"danger\">

        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color=\"white | black\"
            Tip 2: you can change the color of the active button using the data-active-color=\"primary | info | success | warning | danger\"
        -->

        <div class=\"sidebar-wrapper\">
            <div class=\"logo\">
                <img src=\"/economic-analyzer/system/assets/img/logo.png\" height=\"150\" width=\"200\">
                <h4>EconomiC Analyzer</h4>
            </div>

            <ul class=\"nav\">
                <li class=\"active\">
                    <a href=\"/economic-analyzer/system/dashboard.php\">
                        <i class=\"ti-panel\"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href=\"/economic-analyzer/tbbeneficiarieses\">
                        <i class=\"ti-user\"></i>
                        <p>Beneficiaries</p>
                    </a>
                </li>
                <li>
                    <a href=\"/economic-analyzer/tbprograms\">
                        <i class=\"ti-view-list-alt\"></i>
                        <p>Programs</p>
                    </a>
                </li>
                 <li>
                    <a href=\"/economic-analyzer/tbregions\">
                        <i class=\"ti-map-alt\"></i>
                        <p>Regiões</p>
                    </a>
                </li>
                 <li>
                    <a href=\"/economic-analyzer/tbstats\">
                        <i class=\"ti-ink-pen\"></i>
                        <p>Estados</p>
                    </a>
                </li>
                 <li>
                    <a href=\"/economic-analyzer/tbcities\">
                        <i class=\"ti-location-pin\"></i>
                        <p>Cidades</p>
                    </a>
                </li>
                 <li>
                    <a href=\"/economic-analyzer/tbpaymentses\">
                        <i class=\"ti-money\"></i>
                        <p>Pagamentos</p>
                    </a>
                </li>
                 <li class=\"nav-item dropdown\">
                    <a href=\"/economic-analyzer/system/relatorios.php\">                        
                        <p>Relatorios</p>
                        <i class=\"ti-angle-down\"></i>
                    </a>                     
                </li>
                 
            </ul>
        </div>
    </div>";
    }

    function mainpanel()
    {

        echo "<div class=\"main-panel\" >
        <nav class=\"navbar navbar-default\">
            <div class=\"container-fluid\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar bar1\"></span>
                        <span class=\"icon-bar bar2\"></span>
                        <span class=\"icon-bar bar3\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\">General Information</a>
                </div>
                <div class=\"collapse navbar-collapse\">
                    <ul class=\"nav navbar-nav navbar-right\">
                        <!--li>
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                <i class=\"ti-panel\"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li class=\"dropdown\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                <i class=\"ti-bell\"></i>
                                <p class=\"notification\">5</p>
                                <p>Notifications</p>
                                <b class=\"caret\"></b>
                            </a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"#\">Notification 1</a></li>
                                <li><a href=\"#\">Notification 2</a></li>
                                <li><a href=\"#\">Notification 3</a></li>
                                <li><a href=\"#\">Notification 4</a></li>
                                <li><a href=\"#\">Another notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href=\"#\">
                                <i class=\"ti-settings\"></i>
                                <p>Settings</p>
                            </a>
                        </li-->
                    </ul>

                </div>
            </div>
        </nav>";

    }

}