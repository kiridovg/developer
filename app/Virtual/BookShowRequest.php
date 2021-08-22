<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example showing request",
 *     description="Some simple request createa as example",
 * )
 */
class BookShowRequest
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="Unique ID",
     *     example="1",
     * )
     *
     * @var int
     */
    public $id;
}
