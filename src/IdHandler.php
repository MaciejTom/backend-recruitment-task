<?php

declare(strict_types=1);

namespace App;

class IdHandler
{
    private const MIN_ID_NUMBER = 0;
    private const MAX_ID_NUMBER = 1000;

    static function createId(): int
    {
        return rand(self::MIN_ID_NUMBER, self::MAX_ID_NUMBER);
    }
    static function createUniqId(array $usersArray): int
    {
        $newId = self::createId();
        foreach ($usersArray as $user) {
            if ($user['id'] === $newId) {
                self::createUniqId($usersArray);
            }
        }
        return $newId;
    }
}
