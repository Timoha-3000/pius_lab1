<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

    use Symfony\Component\Validator\Validation;
    use App\Model\User;
    use App\Model\Comment;

    function validUser(User $user)
    {
        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
        $violations = $validator->validate($user);
        
        if (count($violations) > 0) {
            echo nl2br("\n\n") . 'Error.log : ' . nl2br("\n");
            echo "Invalid user  " . $user->getName() . nl2br("\n");
            foreach ($violations as $violation) {
                echo $violation->getMessage() . nl2br("\n");
            }
            echo 'end Error.log' . nl2br("\n\n");
        } else {
            echo "Valid user  " . $user->getName() . nl2br("\n");
        }
    }

    $user1 = new User(1, 'Kostya Molotov', 'Kostya@example.com', 'pass123456');
    $user2 = new User(2, 'Misha Serpov', 'Misha@example.com', '123pass456');
    $user3 = new User(-1, 'Invalid ID', 'invalid.email', 'shrt');
    
    echo 'User created at: ' . $user1->getName() . "\t" . $user1->getCreatedAt()->format('Y-m-d H:i:s') . PHP_EOL . nl2br("\n");
    echo 'User created at: ' . $user2->getName() . "\t" . $user2->getCreatedAt()->format('Y-m-d H:i:s') . PHP_EOL . nl2br("\n");
    echo 'User created at: ' . $user3->getName() . "\t" . $user3->getCreatedAt()->format('Y-m-d H:i:s') . PHP_EOL . nl2br("\n");

    validUser($user1);
    validUser($user2);
    validUser($user3);

    $comment1 = new Comment($user1, "my comment 1");
    $comment2 = new Comment($user2, "my comment 2");
    $comment3 = new Comment($user2, "my comment 3");
    $comments = [$comment1, $comment2, $comment3];

    $time = new DateTime('28.03.2022 00:34:24');
    foreach ($comments as $comment) {
        if ($comment->getUser()->getCreatedAt() > $time) {
            echo $comment->getText() . '<br>';
        }
    }