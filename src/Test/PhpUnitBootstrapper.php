<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @copyright 2018 Bert Hekman
 */
class PhpUnitBootstrapper
{
    /** @var self */
    private static $instance;

    /** @var KernelInterface */
    private $kernel;

    /** @var Application */
    private $application;

    /** @var Filesystem */
    private $filesystem;

    /** @var string[] */
    private $databaseFileList = ['test.db'];

    /** @var string */
    private $backupExtension = 'bk';

    public static function getInstance(): PhpUnitBootstrapper
    {
        if ( ! static::$instance) {
            throw new \LogicException('No instance of PhpUnitBootstrapper has been created');
        }

        return static::$instance;
    }

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->kernel->boot();

        $this->application = new Application($kernel);
        $this->application->setAutoExit(false);

        $this->filesystem = new Filesystem();

        static::$instance = $this;
    }

    public function executeCommand(string $command, array $optionList = [], bool $quiet = true)
    {
        $optionList['--env'] = $this->kernel->getEnvironment();
        $optionList['--quiet'] = $quiet;
        $optionList = array_merge(['command' => $command], $optionList);

        $error = $this->application->run(new ArrayInput($optionList));

        if ($error != 0) {
            throw new \RuntimeException('Bootstrap command "' . $command . '" failed', $error);
        }
    }

    public function deleteDatabase()
    {
        foreach ($this->databaseFileList as $file) {
            foreach ([$file, $file . '.' . $this->backupExtension] as $filename) {
                if (file_exists($this->kernel->getCacheDir() . '/' . $filename)) {
                    unlink($this->kernel->getCacheDir() . '/' . $filename);
                }
            }
        }
    }

    public function backupDatabase()
    {
        foreach ($this->databaseFileList as $file) {
            copy(
                $this->kernel->getCacheDir() . '/' . $file,
                $this->kernel->getCacheDir() . '/' . $file . '.' . $this->backupExtension
            );
        }
    }

    public function restoreDatabase()
    {
        foreach ($this->databaseFileList as $file) {
            copy(
                $this->kernel->getCacheDir() . '/' . $file . '.' . $this->backupExtension,
                $this->kernel->getCacheDir() . '/' . $file
            );
        }
    }

    public function cleanUpCacheAndLog()
    {
        $this->filesystem->remove([
            $this->kernel->getCacheDir(),
            $this->kernel->getLogDir(),
        ]);
    }

    public function getKernel(): KernelInterface
    {
        return $this->kernel;
    }

    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * @return string[]
     */
    public function getDatabaseFileList(): array
    {
        return $this->databaseFileList;
    }

    /**
     * @param string[] $databaseFileList
     */
    public function setDatabaseFileList(array $databaseFileList)
    {
        $this->databaseFileList = $databaseFileList;
    }

    public function getBackupExtension(): string
    {
        return $this->backupExtension;
    }

    public function setBackupExtension(string $backupExtension)
    {
        $this->backupExtension = $backupExtension;
    }
}
