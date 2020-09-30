<!DOCTYPE html>
<html>
<head>
	<title>Practica 1</title>

	<style type="text/css"> 

		header{
			position:relative;
			margin:auto;
			text-align:center;
			padding:5px;	
        }
            
            nav{
                position:relative;
                margin:auto;
                width:100%;
                height:auto;
                background:black;
            }

            nav ul{
                position:relative;
                margin:auto;
                width:50%;
                text-align: center;
            }

            nav ul li{
                display:inline-block;
                width:24%;
                line-height: 50px;
                list-style: none;
            }

            nav ul li a{
                color:white;
                text-decoration: none;
            }

            section{
                position:relative;
                padding:20px;
            }

	</style>
</head>
<body>
            <header><h1>Bievenidos </h1></header>

            <?php
                //Incluir el menu de navegacion
                include "navegacion.php";
            ?>

            <section >

                <!--Contenedor donde se muestran las opciones del sistema -->
                <?php
                    //Mostrar opciones
                    $mvc = new MvcController();
                    $mvc -> enlacesPaginasController();
                ?>

            </section>

</body>
</html>