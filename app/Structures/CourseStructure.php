<?php declare(strict_types=1);

namespace App\Structures;

class CourseStructure
{
    public function generate(): string
    {
        $structure = new \stdClass();

        $structure->chapters = [
            $this->createChapter('Chapter 1', [
                $this->createItem('Lesson 1', 'Description 1'),
                $this->createItem('Lesson 2', 'Description 2'),
                $this->createItem('Lesson 3', 'Description 3'),
            ]),
            $this->createChapter('Chapter 2', [
                $this->createItem('Lesson 1', 'Description 1'),
                $this->createItem('Lesson 2', 'Description 2'),
                $this->createItem('Lesson 3', 'Description 3'),
            ]),
            $this->createChapter('Chapter 3', [
                $this->createItem('Lesson 1', 'Description 1'),
                $this->createItem('Lesson 2', 'Description 2'),
                $this->createItem('Lesson 3', 'Description 3'),
            ]),
        ];

        return json_encode($structure, JSON_PRETTY_PRINT);
    }

    private function createChapter(string $title, array $items): \stdClass
    {
        $chapter = new \stdClass();
        $chapter->title = $title;
        $chapter->items = $items;

        return $chapter;
    }

    private function createItem(string $title, string $description): \stdClass
    {
        $item = new \stdClass();
        $item->title = $title;
        $item->description = $description;

        return $item;
    }
}
