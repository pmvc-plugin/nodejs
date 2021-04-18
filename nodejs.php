<?php

namespace PMVC\PlugIn\nodejs;

use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\nodejs';

const NODEJS = 'nodejs';
use InvalidArgumentException;

class nodejs extends PlugIn
{
    public function init()
    {
        if (!$this[NODEJS]) {
            $this->_initNodePath();
        } else {
            if (!\PMVC\realPath($this[NODEJS])) {
                throw new InvalidArgumentException(
                    'NodeJs path was not found. [' . $this[NODEJS] . ']'
                );
            }
        }
    }

    public function getNodeJs()
    {
        if (empty($this[NODEJS])) {
            throw new InvalidArgumentException(
                'NodeJs path was missing. [' . $this[NODEJS] . ']'
            );
        }
        return $this[NODEJS];
    }

    private function _initNodePath()
    {
        $alpinePath = '/usr/bin/node';
        $vendorPath = __DIR__ . '/../../bin/node';
        if (\PMVC\realPath($alpinePath)) {
            $this[NODEJS] = $alpinePath;
        } elseif (\PMVC\realPath($vendorPath)) {
            $this[NODEJS] = $vendorPath;
        }
    }
}
