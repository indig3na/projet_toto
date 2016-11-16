
<?php 
include 'inc/config.php';
try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD);
  }
  catch (Exception $e){
    echo $e->getMessage();
}
 $sql = 'SELECT 
      location.loc_name, 
      training.tra_id,
      training.tra_start_date, 
      training.tra_end_date,
      count(*) as nb
      FROM
      training
        LEFT OUTER JOIN
      location ON training.location_loc_id = location.loc_id
        LEFT OUTER JOIN 
      student ON student.training_tra_id = training.tra_id
        GROUP BY  
      location.loc_name, 
      training.tra_id,
      training.tra_start_date, 
      training.tra_end_date
        ORDER BY
      training.tra_start_date ASC

';
 $pdoStatement = $pdo->query($sql);
 if ($pdoStatement===false){
  echo $pdo->errorInfo();
 }else{
   $sessionList = $pdoStatement->fetchAll();
 //  print_r($sessionList) ;
 }

?>

<div class="jumbotron">
	  <h1>Hey! Salut mon ami !!!</h1>
	  <p> Tou aimes les pôtates ?</p>
	  <p><a class="btn btn-primary btn-lg" href="https://www.youtube.com/watch?v=hJgQCbRsq-I" target="_blank" role="button">Learn more</a></p>
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Esch-Belval</div>
  <div class="panel-body">
	Lister ici les sessions de formation webforce3 par date pour Esch
  </div>
  <?php if (isset($sessionList) && sizeof($sessionList) > 0) : ?>
  <table class="table table-hover ">
    <thead>
      <tr>
        <td><strong>ID</strong></td>
        <td><strong>Début</strong></td>
        <td><strong>Fin</strong></td>
        <td><strong>Effectif</strong></td>
      </tr>
    </thead>
    <tbody>
<?php foreach ($sessionList as $currentSession) : ?>
      <tr>
        <td>
          <a href="list.php?training_tra_id=<?= $currentSession['tra_id'] ?>">
          <?= $currentSession['tra_id'] ?></a>
        </td>
        <td>
          <a href="list.php?training_tra_id=<?= $currentSession['tra_id'] ?>" ><?= $currentSession['tra_start_date'] ?></a>
        </td>
        <td>
          <a href="list.php?training_tra_id=<?= $currentSession['tra_id'] ?>" ><?= $currentSession['tra_end_date'] ?></a>
        </td>
         <td>
          <a href="list.php?training_tra_id=<?= $currentSession['tra_id'] ?>" ><?= $currentSession['nb'] ?></a>
        </td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
<?php else :?>
  aucune session!!!
<?php endif; ?>

</div>
