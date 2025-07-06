<?php declare(strict_types=1);

namespace App\Structures;

class SeoContentStructure
{
    public function generate(): string
    {
        $structure = new \stdClass();

        $structure->title = 'SEO Title';
        $structure->meta_description = 'Meta description for the course.';
        $structure->keywords = ['keyword1', 'keyword2', 'keyword3'];
        $structure->og_title = 'Open Graph Title';
        $structure->og_description = 'Open Graph Description';
        $structure->twitter_title = 'Twitter Title';
        $structure->twitter_description = 'Twitter Description';
        $structure->faq = [
            $this->createFaq('What is this course about?', 'This course covers ...'),
            $this->createFaq('Who is this course for?', 'This course is for ...'),
        ];

        return json_encode($structure, JSON_PRETTY_PRINT);
    }

    private function createFaq(string $question, string $answer): \stdClass
    {
        $faq = new \stdClass();
        $faq->question = $question;
        $faq->answer = $answer;
        return $faq;
    }
}
