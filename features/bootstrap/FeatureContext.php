<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var \Behat\Mink\Mink
     */
    private $mink;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->mink = new Mink(array(
            'browser' => new Session(
                new ChromeDriver(
                    'http://localhost:9222',
                    null,
                    'http://www.google.com'
                )
            )
        ));
    }

    /**
     * @Given I go to the homepage
     */
    public function iGoToTheHomepage()
    {
        $this->mink->getSession()->visit('http://ec2-35-158-224-169.eu-central-1.compute.amazonaws.com');
        return true;
    }

    /**
     * @Then I should see the string :arg1
     */
    public function iShouldSeeTheString($arg1)
    {
        $page = $this->mink->getSession()->getPage();
        $text = $page->find('h1')->getText();
        /** @var ChromeDriver $driver */
        $driver = $this->mink->getSession()->getDriver();

        if (!strstr($text, $arg1)) {
            $driver->captureScreenshot('./screenshots/page_error.png');
            throw new \InvalidArgumentException('String ' . $arg1 . ' not found on the page');
        }

        $driver->captureScreenshot('./screenshots/page_success.png');
    }
}
