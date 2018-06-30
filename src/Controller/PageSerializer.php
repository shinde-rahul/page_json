<?php

namespace Drupal\page_json\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Access\AccessResult;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Page JSON module routes.
 */
class PageSerializer extends ControllerBase {

  /**
   * The serialization class to use.
   *
   * @var \Symfony\Component\Serializer\SerializerInterface
   */
  protected $serializer;

  /**
   * Drupal's config factory class.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * EntitySerializer constructor.
   *
   * @param \Symfony\Component\Serializer\SerializerInterface $serializer_interface
   *   Dependency.
   */
  public function __construct(SerializerInterface $serializer_interface, ConfigFactory $config_factory) {
    $this->serializer = $serializer_interface;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('serializer'),
      $container->get('config.factory')
    );
  }

  /**
   * Access check for the page serializer route.
   *
   * @param  String $siteapikey
   *   The string containing the site api key
   * @param  Node $node
   *   The Nodeobject
   * @return mixed
   *   An access result.
   */
  public function checkAccess($siteapikey, Node $node) {
    if ($siteapikey != $this->configFactory->get('page_json.settings')->get('siteapikey')
        || $node->getType() != 'page') {
      throw new AccessDeniedHttpException('Access Denied!!!');
    }

    $account = $this->currentUser();

    // Check if the user has the proper permissions.
    if ($node->access('access content', $account) === FALSE) {
      return AccessResult::forbidden('Access Denied!!!');
    }
    return AccessResult::allowed();
  }

  /**
   * @param  String $siteapikey
   *   The string containing the site api key
   * @param  Node $node
   *   The Nodeobject
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   Response object contains serialized reference data.
   */
  public function getJSON($siteapikey, Node $node) {
    $serialized_node = $this->serializer->serialize($node, 'json');
    $response = new Response($serialized_node);
    return $response;
  }

}
