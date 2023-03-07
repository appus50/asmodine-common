<?php

namespace Asmodine\CommonBundle\Service;

use Asmodine\CommonBundle\Util\FileHelper;
use Buzz\Browser as Buzz;
use Psr\Log\LoggerInterface;

/**
 * Class BrowserHelper.
 */
class Browser
{
    /** @var string */
    public $projectDir;

    /** @var Buzz */
    private $browser;

    /** @var LoggerInterface */
    private $logger;

    /**
     * Browser constructor.
     *
     * @param Buzz            $browser
     * @param LoggerInterface $logger
     * @param string          $projectDir
     */
    public function __construct(Buzz $browser, LoggerInterface $logger, string $projectDir)
    {
        $this->browser = $browser;
        $this->logger = $logger;
        $this->projectDir = $projectDir;
    }

    /**
     * @param string $url
     * @param string $destFile
     *
     * @throws \Asmodine\CommonBundle\Exception\FileException
     *
     * @return FileHelper
     */
    public function download(string $url, string $destFile): FileHelper
    {
        $response = $this->browser->get($url);
        $file = new FileHelper($this->projectDir.'/var/file/'.$destFile);
        $datas = $response->getBody()->getContents();

        return $file->save($datas);
    }
}
