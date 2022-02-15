<?php
// src/Command/ConvertToFahrenheitCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertToFahrenheitCommand extends Command
{
    // the name of the command (the part after 'bin/console')
    protected static $defaultName = 'tempConv:to-Fahrenheit';

    // the command description shown when running 'php bin/console list'
    protected static $defaultDescription = 'Convert temperature from Celsius to Fahrenheit and print to console';

    protected string $helpText = 'Please provide the temperature in digits. If a negative number (ie -1) input must be preceded with -- (ie -- -1)';

    protected function configure(): void
    {
        // configure arguments from input
        $this->addArgument('temperature', InputArgument::REQUIRED, 'The temperature in degrees Celsius.');
        // add help text
        $this->setHelp($this->helpText);

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       
        //Verify the input is valid
        $inputTemp = $input->getArgument('temperature');

        if(!is_numeric($inputTemp)){ 
            //Print type error with the input and some guidance to console
            $output->write('Invalid input. Please provide the temperature in digits. If a negative number input must be preceded with -- ');
            return Command::INVALID; 
        }

        //continue with maths
        $result = ($inputTemp * (9/5)) + 32;
        $outputText = ''. strval($result) .'°F';
        $output->write($outputText);

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;
    }
}