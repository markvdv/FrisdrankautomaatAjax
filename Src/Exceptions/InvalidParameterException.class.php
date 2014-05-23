<?php

namespace Src\Exceptions;

use Exception;

class InvalidParameterException extends Exception implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
