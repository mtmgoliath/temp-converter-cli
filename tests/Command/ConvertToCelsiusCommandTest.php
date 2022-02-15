<?php

// tests/Command/ConverToCelsiusCommmandTest.php
namespace App\Tests\Command;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ConverToCelsiusCommmandTest extends KernelTestCase
{
    public function testExecute()
    {
        //initialize test app kernel
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        //find command and create tester object
        $command = $application->find('tempConv:to-Celsius');
        $commandTester = new CommandTester($command);

        //Testing Positive number input
        $commandTester->execute([
            // pass arguments to the helper
            'temperature' => '32',

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ]);

        $commandTester->assertCommandIsSuccessful();
        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('0°C', $output);


        //Testing Negative Number input
        $commandTester->execute([
            // pass arguments to the helper
            'temperature' => '-50',

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ]);

        $commandTester->assertCommandIsSuccessful();
        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('-45.555555555556°C', $output);

        //Testing Non Numeric input
        $commandTester->execute([
            // pass arguments to the helper
            'temperature' => 'ten',

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ]);

        //It should throw invalid execption statusCode 2
        $statusCode = $commandTester->getStatusCode();
        $this->assertEquals(2, $statusCode);
        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Invalid input. Please provide the temperature in digits. If a negative number input must be preceded with -- ', $output);
    }
}