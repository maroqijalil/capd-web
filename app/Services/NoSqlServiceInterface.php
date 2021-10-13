<?php

namespace App\Services;

interface NoSqlServiceInterface
{
  public function create($collection, array $document);

  public function update($collection, $id, array $document);

  public function delete($collection, $id);

  public function find($collection, array $criteria);

  public function login($collection, array $criteria);

  public function logout($collection, array $criteria);
}
