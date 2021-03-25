<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {
    
    //o nome do método sempre vem acompanhado do tipo da requisição
    // ou seja, contato_get significa que é uma requisição do tipo "GET"
    // e o usuário vai requisitar apenas /rest/api/contato
    public function contato_get(){
        $retorno = [
            'status' => true, 
            'nome' => 'Patrick',
            'email' => 'patrick@gluk.com.br',
            'error' => ''
        ];

        //para enviar uma resposta, a gente chama o reponse
        //passando dois parametros: o corpo da resposta e o código de status
        $this->response($retorno, 200);
    }

    public function contato_post(){
        $retorno = [
            'status' => true,
            'nome' => 'Patrick POST',
            'email' => 'teste@teste.com',
            'error' => ''
        ];

        $this->response($retorno, 201);
    }


}

/* End of file Api.php */
