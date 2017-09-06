<?php

namespace EconomicPHPWrapper\Api;

use EconomicPHPWrapper\Models\User;

class UserResource extends Resource {

    public function all() : array {
        $users = $this->apiGet('/customers');;

        $return = [];

        foreach ($users as $user)
        {
            $return[] = new User();
        }

        return $return;
    }

    public function get($id) : User
    {
    }

    public function save($parameters)
    {

    }

    public function update($id)
    {

    }
    public function delete($id)
    {

    }
}