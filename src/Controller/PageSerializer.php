<?php

namespace Drupal\page_json\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Access\AccessResult;

use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\State\StateInterface;

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
   * The state keyvalue collection.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * EntitySerializer constructor.
   *
   * @param \Symfony\Component\Serializer\SerializerInterface $serializer_interface
   *   The serializer.
   * @param \Drupal\Core\State\StateInterface $state
   *   The state service.
   */
  public function __construct(SerializerInterface $serializer_interface, StateInterface $state) {
    $this->serializer = $serializer_interface;
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('serializer'),
      $container->get('state')
    );
  }

  /**
   * Access check for the page serializer route.
   *
   * @param string $siteapikey
   *   The string containing the site api key.
   * @param \Drupal\node\Entity\Node $node
   *   The node entity.
   *
   * @return mixed
   *   An access result.
   */
  public function checkAccess($siteapikey, Node $node) {
    if ($siteapikey != $this->state->get('page_json.siteapikey')
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
   * Get the JSON for given node.
   *
   * @param string $siteapikey
   *   The string containing the site api key.
   * @param \Drupal\node\Entity\Node $node
   *   The node entity.
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
