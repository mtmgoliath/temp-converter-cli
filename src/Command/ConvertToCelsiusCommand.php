<?php
// src/Command/ConvertToCelsiusCommand.php
namespace App\Command;;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertToCelsiusCommand extends Command
{
    // the name of the command (the part after 'bin/console')
    protected static $defaultName = 'tempConv:to-Celsius'; // should make shorthand :to-F  //'app:create-user';

    // the command description shown when running 'php bin/console list'
    protected  static $defaultDescription = 'Convert temperature from Fahrenheit to Celsius and print to console.';

    protected string $helpText = 'Please provide the temperature in digits. If a negative number (ie -1) input must be preceded with -- (ie -- -1)';

    protected function configure(): void
    {
        // configure arguments from input
        $this->addArgument('temperature', InputArgument::REQUIRED, 'The temperature in degrees Fahrenheit.');
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
            return Command::INVALID; // status code 2
        }

        //continue with maths 
        $result = ($inputTemp - 32) * (5/9);
        $outputText = ''. strval($result) .'°C';
        $output->write($outputText);

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;
    }
}