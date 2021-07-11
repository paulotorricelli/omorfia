<?php

namespace App\Controllers;

class Hash extends BaseController
{
    //GERA SENHA
    public function set($senha)
    {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        return $hash;
    }

    //VERIFICA SENHA
    public function valid($senha, $senhaDatabase)
    {
        if (password_verify($senha, $senhaDatabase)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
