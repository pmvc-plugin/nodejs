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
            $nodejs = \PMVC\realPath($this[NODEJS]);
            if (!$nodejs) {
                throw new InvalidArgumentException(
                    'NodeJs path was not found. [' . $this[NODEJS] . ']'
                );
            } else {
                $this[NODEJS] = $nodejs;
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
        $alpinePath = \PMVC\realPath('/usr/bin/node');
        $vendorPath = \PMVC\realPath(__DIR__ . '/../../bin/node');
        if ($alpinePath) {
            $this[NODEJS] = $alpinePath;
        } elseif ($vendorPath) {
            $this[NODEJS] = $vendorPath;
        }
    }
}
