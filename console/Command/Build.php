<?php
namespace Console\Command;

use Console\Builder;
use MilesChou\Bank\Bank;
use MilesChou\Bank\OpenData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{
    protected function configure()
    {
        $this->setName('build')
            ->setDescription('Build static file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $openData = new OpenData();

        // Get raw data
        $data = $openData->getData();

        // TODO build some static file
        // (new Builder())->build($data);

        $output->writeln('Build OK');
    }
}
