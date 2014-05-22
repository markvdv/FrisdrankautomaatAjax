<?php

namespace Src\Exceptions;

use Exception;

class GeenGeldException extends Exception implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
