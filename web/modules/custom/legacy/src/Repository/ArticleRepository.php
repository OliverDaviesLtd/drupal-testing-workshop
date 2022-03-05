<?php

declare(strict_types=1);

namespace Drupal\legacy\Repository;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

final class ArticleRepository {

  private EntityStorageInterface $nodeStorage;

  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
  ) {
    $this->nodeStorage = $entityTypeManager->getStorage('node');
  }

  public function findAll(): array {
    return $this->nodeStorage->loadByProperties([
      'type' => 'article',
    ]);
  }

  public function findOneById(int $id): ?NodeInterface {
    return $this->nodeStorage->load($id);
  }

}
