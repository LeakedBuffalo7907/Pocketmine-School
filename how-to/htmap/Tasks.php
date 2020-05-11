<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pocketmine Plugin School</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/25239cedf1.js" crossorigin="anonymous"></script>

  <link href="../css/custom.css" rel="stylesheet" type="text/css">
  <link href="../../css/ultra.css" rel="stylesheet" type="text/css">
  <link href="../../css/tomorrow-night-eighties.css" rel="stylesheet" type="text/css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148602502-2"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-148602502-2');
  </script>
</head>

<body>

<nav>
  <a class="mobile-nav"><i class="fas fa-bars"></i></a>
  <div class="navtitle">Pocketmine School</div>
  <a href="../../index.html">Home</a>
</nav>

<?php $currentPage = 'Tasks'; ?>
<?php include('sidebar.php'); ?>

<div id="Tasks" class="sidemain">
    <h3>Tasks</h3>
    <hr>
    <h4>Creating a Simple Plugin Task</h4>
    <p>We'll take our last plugin and adding a simple task to it that tells the user when 10 seconds has past.</p>
    <p>First, go to your "Main.php" folder and create a new folder called "tasks".</p>
    <p>Create a new file called "MyTask.php".</p>
    <p>And put those contents inside of it.</p>
    <pre>
        <code>
&lt;?php // As always when you start a PHP file

namespace ExampleName\tasks; // Use the same namespace as in your first file but add a \tasks who symbolise that this file is in the subfolder "tasks"

use pocketmine\scheduler\Task; // This is the class that your task will extends to be a plugin task
use ExampleName\Main; // This will allow us to use our main class. It is a required argument for a plugin task.
            
class MyTask extends Task { // Remember that your task must have the same name as your file !

// First we need a __construct function which is used when you create a class to set default variables, ect...
    public function __construct(Main $main, string $playername) { // The arguments you define here depends on what do you want to do exept for your base.
       $this->main = $main; //You can retrieve your main class at anytime and use it's methods on your class by using $this->getOwner()
       $this->playername = $playername; // So we can retreive the player for later.
    }

// Then we'll create an onRun funtion wich will be called when the time has past to the execution of the task
    public function onRun(int $tick) { // $tick is the current server tick when the task executes
        $player = $this->getOwner()->getServer()->getPlayer($this->playername()); // This retreive the main class with $this->getOwner() then asks the server for the player with the name $this->playername
        if($player instanceof Player) { // Basicly checks if the player we retreive is online.
            $player->sendMessage("10 seconds has past!"); // Sends him a message !
        }
    }
// Then we create a getOwner function to return the Main class
    public function getOwner() :Main {
        return $this->main;
    }
}
        </code>
    </pre>
    <p>That's it you created a task ! Now we'll see how to execute it.</p>
    <p>First we will make it execute 1 time, but delayed</p>
    <p>In your main class, where you did your "test" command.</p>
    <pre>
        <code>
    $task = new tasks\MyTask($this, $sender->getName()); // Create the new class Task by calling
    $this->getScheduler()->scheduleDelayedTask($task, 10*20); // Counted in ticks (1 second = 20 ticks)
        </code>
    </pre>
    <p>So the player will receive a message 10 seconds after he executed the command /test !</p>
    <p>But now, what if we want the player to receive a message each 10 seconds?</p>
    <p>Well, there's a special function for that! We don't even need to change the task!</p>
    <pre>
        <code>
    $task = new tasks\MyTask($this, $sender->getName()); // Create the new class Task by calling
    $this->getScheduler()->scheduleRepeatingTask($task, 10*20); // Counted in ticks (1 second = 20 ticks)
        </code>
    </pre>
    <p>Don't forget to import pocketmine\scheduler\TaskScheduler </p>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../js/custom.js"></script>
<script src="../../js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

</body>
</html>