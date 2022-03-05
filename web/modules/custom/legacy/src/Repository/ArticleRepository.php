<?php

declare(strict_types=1);

namespace Drupal\legacy\Repository;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\legacy\Model\Article;
use Drupal\legacy\Model\ArticleInterface;
use Drupal\node\NodeInterface;

final class ArticleRepository {

  private EntityStorageInterface $nodeStorage;

  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
  ) {
    $this->nodeStorage = $entityTypeManager->getStorage(entity_type_id: 'node');
  }

  public function findAll(): array {
    $nodes = $this->nodeStorage->loadByProperties(values: [
      'type' => 'article',
    ]);

    return array_values(
      array: array_map(
        array: $nodes,
        callback: fn (NodeInterface $node): ArticleInterface => Article::fromNode(node: $node),
      )
    );
  }

  public function findOneById(int $id): ?ArticleInterface {
    if (!$node = $this->nodeStorage->load(id: $id)) {
      return NULL;
    }

    return Article::fromNode(node: $node);
  }

}
