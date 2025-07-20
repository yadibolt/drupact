<?php

namespace Drupal\drupact\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Session\SessionManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Psr\Log\LoggerInterface;

/**
 * Provides a Rest Resource
 *
 * @RestResource(
 *   id = "drupact_api_example",
 *   label = @Translation("Example Endpoint"),
 *   uri_paths = {
 *     "canonical" = "/api/example",
 *   },
 * )
 */
class Example extends ResourceBase {
    protected $currentRequest;
    protected $currentUser;
    protected $sessionManager;
    protected $db;

    /**
     * Constructs a Drupal\rest\Plugin\ResourceBase object.
     *
     * @param array $configuration
     *   A configuration array containing information about the plugin instance.
     * @param string $plugin_id
     *   The plugin_id for the plugin instance.
     * @param mixed $plugin_definition
     *   The plugin implementation definition.
     * @param array $serializer_formats
     *   The available serialization formats.
     * @param \Psr\Log\LoggerInterface $logger
     *   A logger instance.
     * @param \Drupal\Core\Session\AccountProxyInterface $current_user
     *   A current user instance.
     * @param \Drupal\Core\Session\SessionManagerInterface $session_manager
     *    The session manager.
     * @param Symfony\Component\HttpFoundation\Request $current_request
     *   The current request
     * @param \Drupal\Core\Database\Connection $database
     *    Database Connection.
     */
    public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        array $serializer_formats,
        LoggerInterface $logger,
        AccountProxyInterface $current_user,
        SessionManagerInterface $session_manager,
        Request $current_request,
        Connection $database,
    ) {
        parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
        $this->currentRequest = $current_request;
        $this->currentUser = $current_user;
        $this->sessionManager = $session_manager;
        $this->db = $database;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->getParameter('serializer.formats'),
            $container->get('logger.factory')->get('ait-rest'),
            $container->get('current_user'),
            $container->get('session_manager'),
            $container->get('request_stack')->getCurrentRequest(),
            $container->get('database'),
        );
    }

    public function get() {
        $params = $this->currentRequest->query->all();
    }

    public function post() {
        $params = $this->currentRequest->query->all();
        $data = $this->currentRequest->getContent();
        $data = json_decode($data, TRUE);
    }

    public function patch() {
        $params = $this->currentRequest->query->all();
        $data = $this->currentRequest->getContent();
        $data = json_decode($data, TRUE);
    }

    public function delete() {
        $params = $this->currentRequest->query->all();
    }
}