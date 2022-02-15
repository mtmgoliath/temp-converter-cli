<?php

// tests/Command/ConvertToCelsiusCommmandTest.php
namespace App\Tests\Command;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;

class ConverToFahrenheitCommmandTest extends KernelTestCase
{
    public function testExecute()
    {
        //initialize test app kernel
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        //find command and create tester object
        $command = $application->find('tempConv:to-Fahrenheit');
        $commandTester = new CommandTester($command);

        //Testing Positive number input
        $commandTester->execute([
            // pass arguments to the helper
            'temperature' => '0',

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ]);

        $commandTester->assertCommandIsSuccessful();
        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('32°F', $output);

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
        $this->assertStringContainsString('-58°F', $output);

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