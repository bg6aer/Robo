<?php
use AspectMock\Test as test;

class NpmTest extends \Codeception\TestCase\Test
{
    use \Robo\Task\Npm;

    /**
     * @var \AspectMock\Proxy\ClassProxy
     */
    protected $baseNpm;

    protected function _before()
    {
        $this->baseNpm = test::double('Robo\Task\BaseNpmTask', [
            'getOutput' => new \Symfony\Component\Console\Output\NullOutput()
        ]);
    }
    // tests
    public function testNpmInstall()
    {
        $npm = test::double('Robo\Task\NpmInstallTask', ['executeCommand' => null]);
        $this->taskNpmInstall('npm')->run();
        $npm->verifyInvoked('executeCommand', ['npm install']);
    }

    public function testNpmUpdate()
    {
        $npm = test::double('Robo\Task\NpmUpdateTask', ['executeCommand' => null]);
        $this->taskNpmUpdate('npm')->run();
        $npm->verifyInvoked('executeCommand', ['npm update']);
    }

    public function testNpmInstallCommand()
    {
        verify(
            $this->taskNpmInstall('npm')->getCommand()
        )->equals('npm install');

        verify(
            $this->taskNpmInstall('npm')->getCommand()
        )->equals('npm install');

        verify(
            $this->taskNpmInstall('npm')
                ->noDev()
                ->getCommand()
        )->equals('npm install --production');
    }

}