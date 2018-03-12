<?php
    require 'sys/DB.php';
    define('CONF',__DIR__.'/Config.json');
      
    use App\Sys\DB;
    
    //connection gdb
    
    $gdb=DB::getInstance();
    $gdb->beginTransaction();
    //Inserció usuaris
    $query_user= "INSERT INTO user VALUES(1,1,1,1,1)";
    $gdb->query($query_user);
    $gdb->execute();
    
    //Inserció Posts
    $query_posts= "INSERT INTO posts VALUES(2,2,2,2,2)";
    $gdb->query($query_posts);
    $gdb->execute();
    
    //Inserció Comentaris
    $query_comentari= "INSERT INTO comentarios VALUES(1,1,1,1)";
    $gdb->query($query_comentari);
    $gdb->execute();
    
    //Inserció d'etiquetes
    $query_tags= "INSERT INTO tags VALUES(1,1)";
    $gdb->query($query_tags);
    $gdb->execute();
    
    //Consulta general tots els posts
    $queryGetPosts= "Select * FROM posts;";
    $gdb->query($queryGetPosts);
    $gdb->execute();
    $datos = $gdb->resultSet();
    
    foreach($datos as $dato)
    {
          echo $dato['id'].' '.$dato['title'].' '.$dato['body'].' '.$dato['username'];
    }
    
    //Consulta general de posts per usuari
    $queryGetPostsByName= "Select * FROM posts WHERE username = '1';";
    $gdb->query($queryGetPostsByName);
    $gdb->execute();
    $datosByName = $gdb->resultSet();
    
    foreach($datos as $dato)
    {
          echo $dato['id'].' '.$dato['title'].' '.$dato['body'].' '.$dato['username'];
    }
    $gdb->endTransaction();

    /*$datos = $gdb->resultSet();
    
    foreach($datos as $dato)
    {
          echo $dato['username'];
    }*/
    
   