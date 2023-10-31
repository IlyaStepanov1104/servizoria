<?php

class TextCallStatistic
{
    /**
     * @var bool Did he say hello?
     */
    private bool $hello = false;
    /**
     * @var bool Did he introduce himself?
     */
    private bool $introduced = false;
    /**
     * @var int How many times did he call the client by name?
     */
    private int $called = 0;

    public function getCalled(): int
    {
        return $this->called;
    }

    public function setCalled(int $called): void
    {
        $this->called = $called;
    }

    public function isIntroduced(): bool
    {
        return $this->introduced;
    }

    public function setIntroduced(bool $introduced): void
    {
        $this->introduced = $introduced;
    }

    public function isHello(): bool
    {
        return $this->hello;
    }

    public function setHello(bool $hello): void
    {
        $this->hello = $hello;
    }


    /**
     * @param $filePath - the path to the text file.
     * @throws Exception - if the file does not exist or cannot be read.
     */
    public function __construct($filePath)
    {
        if (!file_exists($filePath)) throw new Exception('File not found!');
        $file = fopen($filePath, 'r');
        if (!$file) throw new Exception('Can not open a file!');
        $text = fgets($file);
        $textExplode = preg_split('/[.?!]/', $text);
        foreach ($this->getHelloWords() as $word) {
            if (str_contains($textExplode[0], $word)) {
                $this->setHello(true);
                break;
            }
        }
        foreach ($this->getIntroducedWords() as $word) {
            if (isset($textExplode[1]) && str_contains($textExplode[1], $word)
                || isset($textExplode[2]) && str_contains($textExplode[2], $word)) {
                $this->setIntroduced(true);
                break;
            }
        }
        $this->setCalled(array_sum(array_map(fn($element) => substr_count($text, $element), $this->getNames())));
    }

//    TODO: edit to SELECT from Database
    private function getHelloWords(): array
    {
        return array(
            'Привет',
            'Здравствуйте',
            'Добрый день',
            'Добрый вечер',
            'Приветствую',
        );
    }

    private function getIntroducedWords(): array
    {
        return array(
            'Меня зовут',
            'Моё имя',
        );
    }

    private function getNames(): array
    {
        return array(
            'Михаил',
            'Олег',
            'Андрей',
            'Иван',
            'Мария',
            'Ксения',
            'Юлия',
            'Алексей',
            'Игорь',
            'Ярослав',
        );
    }
}