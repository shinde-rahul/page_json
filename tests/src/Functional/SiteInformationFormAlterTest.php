<?php

namespace Drupal\Tests\page_json\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group page_json
 */
class SiteInformationFormAlterTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['page_json'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test callback.
   */
  public function testSiteApiElementExist() {
    $this->drupalLogin($this->drupalCreateUser(['access administration pages', 'administer site configuration']));
    $this->drupalGet('admin/config/system/site-information');
    $this->assertSession()->elementExists('xpath', '//input[@name="site_api_key"]');
  }

}
