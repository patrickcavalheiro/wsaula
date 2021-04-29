<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Usuario extends RestController {

    public function index_get(){
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

    public function index_post(){
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

    public function index_put(){
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

    public function index_delete() {
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