<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example storring request",
 *     description="Some simple request createa as example",
 * )
 */
class BookStoreRequest
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of key for storring",
     *     example="random",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="Description for storring",
     *     example="awesome",
     * )
     *
     * @var string
     */
    public $description;
}
