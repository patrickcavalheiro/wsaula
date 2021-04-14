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

    public function usuario_get(){
        //o primeiro parametro do load model é o nome do model que queremos chamar
        //o segundo parametro "um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('usuario_model', 'um');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->um->get_one($id);
        } else {
            $retorno = $this->um->get_all();
        }
                
        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function usuario_post(){
        if ((!$this->post('email')) || (!$this->post('senha'))){
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //recebemos os dados via post
        $dados = [
            'email' => $this->post('email'),
            'senha' => $this->post('senha')
        ];

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        //mandamos inserir na base através do metodo insert do usuario_model
        if($this->um->insert($dados)) {
            $this->response([
                'status' => true,
                'message' => 'Usuário inserido com sucesso'
            ], 200); //200 OK
        } else {
            $this->response([
                'status' => false,
                'error' => 'Falha ao inserir usuário'
            ], 400); //400 bad request
        }
        
    }

    public function usuario_put(){
        $id = $this->get('id');
        if ((!$this->put('email')) || (!$this->put('senha')) || $id <= 0){
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //recebemos os dados via post
        $dados = [
            'email' => $this->put('email'),
            'senha' => $this->put('senha')
        ];

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        if ($this->um->update($id, $dados)) {
            $this->response([
                'status' => true,
                'message' => 'Usuário alterado com sucesso'
            ], 200); //200 OK
        } else {
            $this->response([
                'status' => false,
                'error' => 'Falha ao alterar usuário'
            ], 400); //400 bad request
        }
    }

    public function usuario_delete() {
        $id = $this->get('id');
        if ($id <= 0){
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        if ($this->um->delete($id)) {
            $this->response([
                'status' => true,
                'message' => 'Usuário deletado com sucesso'
            ], 200); //200 OK
        } else {
            $this->response([
                'status' => false,
                'error' => 'Falha ao deletar usuário'
            ], 400); //400 bad request
        }
    }


}

/* End of file Api.php */
