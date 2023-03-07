<?php

namespace Asmodine\CommonBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

/**
 * Class AppDbMigrateCommand.
 */
class DBMigrateCommand extends Command
{
    /**
     * @see Command::$defaultName
     *
     * @var string
     */
    protected static $defaultName = 'asmodine:db:migrate';

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * AppDbMigrateCommand constructor.
     *
     * @param string      $projectDir
     * @param string|null $name
     */
    public function __construct(string $projectDir, string $name = null)
    {
        parent::__construct($name);
        $dir = $projectDir.'/config/packages/doctrine_migrations/';
        $this->finder = new Finder();
        $this->finder->in($dir)->name('doctrine_migrations_*.yaml');
    }

    /**
     * Run Doctrine Migrations Command.
     *
     * @param string $commandName
     * @param string $configuration
     *
     * @throws \Exception
     *
     * @return int
     */
    public function runMigrationsCommand(string $commandName, string $configuration): int
    {
        $command = $this->getApplication()->find($commandName);
        preg_match('/doctrine_migrations_(.*)\.yaml$/', $configuration, $matches);
        $input = new ArrayInput(
            [
                'command' => $commandName,
                '--em' => $matches[1],
                '--configuration' => $configuration,
            ]
        );
        $this->io->comment('em='.$matches[1]);

        return $command->run($input, $this->output);
    }

    /**
     * @see Command::configure()
     */
    protected function configure()
    {
        $this->setDescription('Generate migrations or migrate databases')
            ->addOption('diff', null, InputOption::VALUE_NONE, 'bin/console doctrine:migrations:diff with all configuration files')
            ->addOption('migrate', null, InputOption::VALUE_NONE, 'bin/console doctrine:migrations:migrate with all configuration files');
    }

    /**
     * @see Command::execute()
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->io = new SymfonyStyle($input, $output);
        $commandName = null;

        if ($input->getOption('diff') && $input->getOption('migrate')) {
            $this->io->error('Choose between one of two options (diff or migrate). Not Both !');

            return;
        }

        if ($input->getOption('diff')) {
            $commandName = 'doctrine:migrations:diff';
        }

        if ($input->getOption('migrate')) {
            $commandName = 'doctrine:migrations:migrate';
        }

        if (null === $commandName) {
            $this->io->error('Choose between one of two options (diff or migrate).');

            return;
        }

        $this->io->section($commandName);
        array_map(
            function ($file) use ($commandName) {
                return $this->runMigrationsCommand($commandName, $file);
            },
            iterator_to_array($this->finder->files(), false)
        );
    }
}
