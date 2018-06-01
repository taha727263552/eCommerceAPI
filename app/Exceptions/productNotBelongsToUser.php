<?php

namespace App\Exceptions;

use Exception;

class productNotBelongsToUser extends Exception
{
    public function render()
    {
        return ['errors' => 'product not belongs to user'];
    }
}
