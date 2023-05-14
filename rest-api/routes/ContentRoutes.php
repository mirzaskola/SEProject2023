<?php

// get all
Flight::route('GET /content', function(){
    $data = Flight::contentService()->get_all_content();
    Flight::json($data);
});

// get one
Flight::route('GET /content/@id', function($id){
    $data = Flight::contentService()->get_content_by_id($id);
    Flight::json($data);
});
?>