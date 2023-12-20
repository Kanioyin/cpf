<?php
namespace App\Model;

use App\Service\Config;

class impreza
{
    private ?int $id = null;
    private ?string $subject = null;
    private ?string $content = null;
    private ?string $date = null; // new

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): impreza
    {
        $this->id = $id;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): impreza
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): impreza
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): impreza
    {
        $this->date = $date;
        echo $date;
        return $this;
    }

    public static function fromArray($array): impreza
    {
        $event = new self();
        $event->fill($array);

        return $event;
    }

    public function fill($array): impreza
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['subject'])) {
            $this->setSubject($array['subject']);
        }
        if (isset($array['content'])) {
            $this->setContent($array['content']);
        }
        if (isset($array['date'])) {
            $this->setDate($array['date']);
        }
        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM impreza';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $events = [];
        $eventsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($eventsArray as $eventArray) {
            $events[] = self::fromArray($eventArray);
        }

        return $events;
    }

    public static function find($id): ?impreza
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM impreza WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $eventArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $eventArray) {
            return null;
        }
        $impreza = impreza::fromArray($eventArray);

        return $impreza;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO impreza (subject, content, date) VALUES (:subject, :content, :date)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'subject' => $this->getSubject(),
                'content' => $this->getContent(),
                'date' => $this->getDate(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE impreza SET subject = :subject, content = :content , date = :date WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':subject' => $this->getSubject(),
                ':content' => $this->getContent(),
                ':date' => $this->getDate(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM impreza WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setSubject(null);
        $this->setContent(null);
        $this->setDate(null);
    }
}
