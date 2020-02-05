<?php

class Model_config extends CI_model
{

    public function getConfig()
    {
        return  $this->db->get('sys_config');
    }
}