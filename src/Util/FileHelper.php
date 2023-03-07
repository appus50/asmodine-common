<?php

namespace Asmodine\CommonBundle\Util;

use Asmodine\CommonBundle\Exception\FileException;
use Asmodine\CommonBundle\Exception\ReachException;

/**
 * Class FileHelper.
 */
class FileHelper
{
    const EXT_CSV = 'csv';
    const EXT_XML = 'xml';

    const ARCHIVE_FORMAT_NONE = '';
    const ARCHIVE_FORMAT_GZ = 'gzip';
    const ARCHIVE_FORMAT_ZIP = 'zip';

    /**
     * @var string
     */
    private $filePath;

    /**
     * FileUtils constructor.
     *
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath ?? '';
    }

    /**
     * Saves the data to a file.
     *
     * @param string $string
     *
     * @throws FileException
     *
     * @return FileHelper
     */
    public function save(string $string): self
    {
        $file = fopen($this->filePath, 'w+');
        if (!$file) {
            throw new FileException($this->filePath, 'fopen w+');
        }
        $fputs = fwrite($file, $string);

        $fclose = fclose($file);
        if (false === $fputs) {
            throw new FileException($this->filePath, 'fputs');
        }
        if (false === $fclose) {
            throw new FileException($this->filePath, 'fclose');
        }

        return $this;
    }

    /**
     * Unarchive File.
     *
     * @param string $archive
     * @param bool   $deleteOldFile
     *
     * @throws FileException
     * @throws ReachException
     *
     * @return FileHelper
     */
    public function unarchive(string $archive, bool $deleteOldFile = false): self
    {
        if (self::ARCHIVE_FORMAT_NONE === $archive) {
            return $this;
        }
        if (self::ARCHIVE_FORMAT_GZ === $archive) {
            return $this->gunzip($deleteOldFile);
        }

        if (self::ARCHIVE_FORMAT_ZIP === $archive) {
            return $this->unzip1File($deleteOldFile);
        }

        throw new ReachException();
    }

    /**
     * Gunzip File.
     *
     * @param bool $deleteCompressFile
     *
     * @return FileHelper
     */
    public function gunzip(bool $deleteCompressFile = false): self
    {
        $newFileName = preg_replace(['/.gz$/', '/.gzip$/'], ['', ''], $this->getRealpath());
        $buffer_size = 8192;
        $file = gzopen($this->getRealpath(), 'rb');
        $out_file = fopen($newFileName, 'w');

        while (!gzeof($file)) {
            fwrite($out_file, gzread($file, $buffer_size));
        }

        fclose($out_file);
        gzclose($file);

        if ($deleteCompressFile) {
            unlink($this->getRealpath());
        }

        $this->filePath = $newFileName;

        return $this;
    }

    /**
     * Unzip 1 File.
     *
     * @param bool $deleteCompressFile
     *
     * @throws FileException
     * @throws ReachException
     *
     * @return FileHelper
     */
    public function unzip1File(bool $deleteCompressFile = false): self
    {
        $newFileName = preg_replace(['/.zip$/'], [''], $this->getRealpath());
        $zip = new \ZipArchive();
        if ($zip->open($this->getRealpath())) {
            if ($zip->numFiles > 1) {
                throw new ReachException();
            }

            $fp = $zip->getStream($zip->getNameIndex(0));
            $ofp = fopen($newFileName, 'w');

            if (!$fp) {
                throw new FileException($this->getRealpath(), 'extract:'.$zip->getNameIndex(0));
            }
            while (!feof($fp)) {
                fwrite($ofp, fread($fp, 8192));
            }
            fclose($fp);
            fclose($ofp);
            $zip->close();

            if ($deleteCompressFile) {
                unlink($this->getRealpath());
            }

            $this->filePath = $newFileName;

            return $this;
        }
        throw new ReachException();
    }

    /**
     * @see realpath()
     *
     * @return bool|string
     */
    public function getRealpath()
    {
        return realpath($this->filePath);
    }

    /**
     * @see basename()
     *
     * @return string
     */
    public function getFilename(): string
    {
        return basename($this->getRealpath());
    }

    /**
     * @see file_exists()
     *
     * @return bool true if file exist
     */
    public function exists(): bool
    {
        return file_exists($this->filePath);
    }

    /**
     * Parse a csv file.
     *
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @param int    $nbLines
     *
     * @throws FileException
     *
     * @return array
     */
    public function getCSVDatas(string $delimiter, string $enclosure, string $escape, int $nbLines = 100000)
    {
        if (!file_exists($this->filePath)) {
            throw new FileException($this->filePath, 'file_exists');
        }
        $rows = [];
        if (false === ($handle = fopen($this->getRealpath(), 'r'))) {
            throw new FileException($this->filePath, 'fopen r');
        }

        while (false !== ($values = fgetcsv($handle, null, $delimiter, $enclosure, $escape)) && \count($rows) < $nbLines) {
            $values = array_map('trim', $values);
            $rows[] = $values;
        }
        fclose($handle);

        return $rows;
    }

    /**
     * Parse Attr of XML file.
     *
     * @param int $nbLines
     *
     * @return array ['root' => string, 'rows' => array]
     */
    public function getXMLTags(int $nbLines = 100000): array
    {
        $reader = new \XMLReader();
        $reader->open($this->filePath);
        $line = '';
        $rows = [];
        $i = 0;
        while ($reader->read() && $i < $nbLines) {
            if (1 === $reader->depth) {
                $line = $reader->name;
            }
            if (2 === $reader->depth) {
                $rows[] = $reader->name;
            }
            if (0 === $i % 1000) {
                $rows = array_unique($rows);
            }
            ++$i;
        }
        $reader->close();

        return [
            'root' => $line,
            'rows' => array_values(array_unique($rows)),
        ];
    }
}
