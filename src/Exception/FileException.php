<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class FileException.
 */
class FileException extends AbstractTranslateException
{
    /**
     * FileException constructor.
     *
     * @param string $filePath
     * @param string $action
     */
    public function __construct(string $filePath, string $action)
    {
        parent::__construct('file', ['%file_path%' => $filePath, '%action%' => $action]);
    }
}
